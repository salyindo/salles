<?php

namespace App\Repository;

use App\Model\Reservation;
use DateTimeImmutable;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function all(): array
    {
        return Reservation::all()->all();
    }

    public function find(int $id): ?Reservation
    {
        return Reservation::find($id);
    }

    public function findConflict(
        int $salleId,
        DateTimeImmutable $dateDebut,
        DateTimeImmutable $dateFin
    ): ?Reservation {
        return Reservation::where('salle_id', $salleId)
            ->where('statut', 'confirmée')
            ->where('date_debut', '<', $dateFin)
            ->where('date_fin', '>', $dateDebut)
            ->first();
    }

    public function save(Reservation $reservation): Reservation
    {
        $reservation->save();

        return $reservation;
    }

    public function cancel(Reservation $reservation): Reservation
    {
        $reservation->statut = 'annulée';
        $reservation->save();

        return $reservation;
    }
}