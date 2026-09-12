<?php

namespace Tests\Unit;

use App\DTO\CreerReservationDTO;
use App\Exception\SalleIndisponibleException;
use App\Model\Reservation;
use App\Model\Salle;
use App\Repository\ReservationRepositoryInterface;
use App\Repository\SalleRepositoryInterface;
use App\Service\CreerReservationService;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CreerReservationServiceTest extends TestCase
{
    public function testCreeUneReservationValide(): void
    {
        $reservations = new InMemoryReservationRepository();
        $service = $this->service(new Salle(), $reservations);

        $reservation = $service->execute($this->dto());

        self::assertSame('confirmée', $reservation->statut);
        self::assertCount(1, $reservations->saved);
    }

    public function testRefuseUneSalleInactive(): void
    {
        $salle = new Salle();
        $salle->active = false;

        $this->expectException(SalleIndisponibleException::class);
        $this->service($salle, new InMemoryReservationRepository())
            ->execute($this->dto());
    }

    public function testRefuseUneSalleInexistante(): void
    {
        $this->expectException(SalleIndisponibleException::class);

        $this->service(null, new InMemoryReservationRepository())
            ->execute($this->dto());
    }

    public function testRefuseUneDateInvalide(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->service(new Salle(), new InMemoryReservationRepository())
            ->execute($this->dto('+2 hours', '+1 hour'));
    }

    public function testRefuseUneDureeSuperieureAQuatreHeures(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->service(new Salle(), new InMemoryReservationRepository())
            ->execute($this->dto('+1 hour', '+6 hours'));
    }

    public function testRefuseUneDatePassee(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->service(new Salle(), new InMemoryReservationRepository())
            ->execute($this->dto('-2 hours', '-1 hour'));
    }

    public function testRefuseUnConflit(): void
    {
        $reservations = new InMemoryReservationRepository();
        $reservations->conflict = new Reservation();

        $this->expectException(SalleIndisponibleException::class);
        $this->service(new Salle(), $reservations)->execute($this->dto());
    }

    public function testAccepteUneReservationVoisine(): void
    {
        $reservations = new InMemoryReservationRepository();
        $reservations->conflict = null;

        $reservation = $this->service(new Salle(), $reservations)
            ->execute($this->dto());

        self::assertSame('confirmée', $reservation->statut);
    }

    private function service(
        ?Salle $salle,
        InMemoryReservationRepository $reservations
    ): CreerReservationService {
        return new CreerReservationService(
            new InMemorySalleRepository($salle),
            $reservations
        );
    }

    private function dto(
        string $debut = '+1 day',
        string $fin = '+1 day +2 hours'
    ): CreerReservationDTO {
        return new CreerReservationDTO(
            1,
            'Awa Ndiaye',
            'awa@example.com',
            'Cours d architecture logicielle',
            new DateTimeImmutable($debut),
            new DateTimeImmutable($fin)
        );
    }
}

final class InMemorySalleRepository implements SalleRepositoryInterface
{
    public function __construct(private ?Salle $salle)
    {
    }

    public function all(): array
    {
        return $this->salle === null ? [] : [$this->salle];
    }

    public function find(int $id): ?Salle
    {
        return $id === 1 ? $this->salle : null;
    }

    public function save(Salle $salle): Salle
    {
        return $salle;
    }
}

final class InMemoryReservationRepository implements ReservationRepositoryInterface
{
    public ?Reservation $conflict = null;

    /** @var list<Reservation> */
    public array $saved = [];

    public function all(): array
    {
        return $this->saved;
    }

    public function find(int $id): ?Reservation
    {
        return null;
    }

    public function findConflict(
        int $salleId,
        DateTimeImmutable $dateDebut,
        DateTimeImmutable $dateFin
    ): ?Reservation {
        return $this->conflict;
    }

    public function save(Reservation $reservation): Reservation
    {
        $this->saved[] = $reservation;

        return $reservation;
    }

    public function cancel(Reservation $reservation): Reservation
    {
        return $reservation;
    }
}