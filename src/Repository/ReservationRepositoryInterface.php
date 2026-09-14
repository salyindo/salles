<?php

namespace App\Repository;

use App\Model\Reservation;
use DateTimeImmutable;

interface ReservationRepositoryInterface
{
    public function all(): array;

    public function bySalle(int $salleId): array;

    public function find(int $id): ?Reservation;

    public function findConflict(
        int $salleId,
        DateTimeImmutable $dateDebut,
        DateTimeImmutable $dateFin
    ): ?Reservation;

    public function save(Reservation $reservation): Reservation;

    public function cancel(Reservation $reservation): Reservation;
}