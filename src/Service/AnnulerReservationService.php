<?php

namespace App\Service;

use App\Exception\ReservationIntrouvableException;
use App\Model\Reservation;
use App\Repository\ReservationRepositoryInterface;

class AnnulerReservationService
{
    public function __construct(
        private ReservationRepositoryInterface $reservationRepository
    ) {
    }

    public function execute(int $reservationId): Reservation
    {
        $reservation = $this->reservationRepository->find($reservationId);

        if ($reservation === null) {
            throw new ReservationIntrouvableException(
                'La réservation est introuvable.'
            );
        }

        return $this->reservationRepository->cancel($reservation);
    }
}
