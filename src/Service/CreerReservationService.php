<?php

namespace App\Service;

use App\DTO\CreerReservationDTO;
use App\Exception\SalleIndisponibleException;
use App\Repository\SalleRepositoryInterface;
use App\Repository\ReservationRepositoryInterface;
use App\Model\Reservation;
use DateTimeImmutable;

class CreerReservationService
{
    public function __construct(
        private SalleRepositoryInterface $salleRepository,
        private ReservationRepositoryInterface $reservationRepository
    ) {
    }

    public function execute(CreerReservationDTO $dto): Reservation
    {
        // 1. Retrouver la salle
        $salle = $this->salleRepository->find($dto->salleId);

        if ($salle === null) {
            throw new SalleIndisponibleException(
                'La salle demandée n\'existe pas.'
            );
        }

        // 2. Vérifier que la salle est active
        if (!$salle->active) {
            throw new SalleIndisponibleException(
                'La salle n\'est pas active.'
            );
        }

        // 3. Vérifier que le début précède la fin
        if ($dto->dateDebut >= $dto->dateFin) {
            throw new \InvalidArgumentException(
                'La date de début doit précéder la date de fin.'
            );
        }

        // 4. Vérifier que la durée ne dépasse pas quatre heures
        $duree = $dto->dateFin->getTimestamp()
            - $dto->dateDebut->getTimestamp();

        if ($duree > 4 * 60 * 60) {
            throw new \InvalidArgumentException(
                'La réservation ne peut pas dépasser 4 heures.'
            );
        }

        // 5. Vérifier que la date est future
        $maintenant = new DateTimeImmutable();

        if ($dto->dateDebut <= $maintenant) {
            throw new \InvalidArgumentException(
                'La réservation doit être dans le futur.'
            );
        }

        // 6. Rechercher les chevauchements
        $conflit = $this->reservationRepository->findConflict(
            $dto->salleId,
            $dto->dateDebut,
            $dto->dateFin
        );

        if ($conflit !== null) {
            throw new SalleIndisponibleException(
                'La salle est déjà réservée sur cette période.'
            );
        }

        // 7. Créer la réservation
        $reservation = new Reservation();

        $reservation->salle_id = $dto->salleId;
        $reservation->responsable = $dto->responsable;
        $reservation->email = $dto->email;
        $reservation->motif = $dto->motif;
        $reservation->date_debut = $dto->dateDebut;
        $reservation->date_fin = $dto->dateFin;
        $reservation->statut = 'confirmée';

        // 8. Enregistrer
        return $this->reservationRepository->save($reservation);
    }
}
