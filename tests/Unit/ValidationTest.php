<?php

namespace Tests\Unit;

use App\Validation\ReservationValidator;
use App\Validation\SalleValidator;
use PHPUnit\Framework\TestCase;

final class ValidationTest extends TestCase
{
    public function testRefuseUneAdresseEmailInvalide(): void
    {
        $data = $this->reservationData();
        $data['email'] = 'adresse-invalide';

        self::assertArrayHasKey('email', (new ReservationValidator())
            ->validate($data)->errors());
    }

    public function testRefuseUnResponsableVide(): void
    {
        $data = $this->reservationData();
        $data['responsable'] = '';

        self::assertArrayHasKey('responsable', (new ReservationValidator())
            ->validate($data)->errors());
    }

    public function testRefuseUneCapaciteNegative(): void
    {
        $data = $this->salleData();
        $data['capacite'] = -1;

        self::assertArrayHasKey('capacite', (new SalleValidator())
            ->validate($data)->errors());
    }

    public function testRefuseUnTypeInconnu(): void
    {
        $data = $this->salleData();
        $data['type'] = 'autre';

        self::assertArrayHasKey('type', (new SalleValidator())
            ->validate($data)->errors());
    }

    public function testRefuseUneDateIncorrecte(): void
    {
        $data = $this->reservationData();
        $data['date_debut'] = 'date incorrecte';

        self::assertArrayHasKey('date_debut', (new ReservationValidator())
            ->validate($data)->errors());
    }

    private function reservationData(): array
    {
        return [
            'salle_id' => 1,
            'responsable' => 'Awa Ndiaye',
            'email' => 'awa@example.com',
            'motif' => 'Cours de programmation',
            'date_debut' => '2030-01-01T10:00',
            'date_fin' => '2030-01-01T12:00',
        ];
    }

    private function salleData(): array
    {
        return [
            'nom' => 'Salle B12',
            'batiment' => 'Batiment B',
            'capacite' => 40,
            'type' => 'cours',
            'active' => true,
        ];
    }
}