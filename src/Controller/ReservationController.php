<?php

namespace App\Controller;

use App\DTO\CreerReservationDTO;
use App\Repository\ReservationRepositoryInterface;
use App\Repository\SalleRepositoryInterface;
use App\Service\AnnulerReservationService;
use App\Service\CreerReservationService;
use App\Validation\ReservationValidator;
use DateTimeImmutable;

class ReservationController
{
    public function __construct(
        private ReservationRepositoryInterface $reservationRepository,
        private SalleRepositoryInterface $salleRepository,
        private ReservationValidator $validator,
        private CreerReservationService $creerReservationService,
        private AnnulerReservationService $annulerReservationService
    ) {
    }

    public function index(): void
    {
        $reservations = $this->reservationRepository->all();

        require __DIR__ . '/../../templates/reservation/index.php';
    }

    public function show(int $id): void
    {
        $reservation = $this->reservationRepository->find($id);

        if ($reservation === null) {
            http_response_code(404);
            require __DIR__ . '/../../templates/error/404.php';
            return;
        }

        require __DIR__ . '/../../templates/reservation/show.php';
    }

    public function create(): void
    {
        $salles = $this->salleRepository->all();
        $errors = [];
        $data = [];

        require __DIR__ . '/../../templates/reservation/form.php';
    }

    public function store(): void
    {
        $data = [
            'salle_id' => isset($_POST['salle_id'])
                ? (int) $_POST['salle_id']
                : 0,
            'responsable' => $_POST['responsable'] ?? '',
            'email' => $_POST['email'] ?? '',
            'motif' => $_POST['motif'] ?? '',
            'date_debut' => $_POST['date_debut'] ?? '',
            'date_fin' => $_POST['date_fin'] ?? '',
        ];

        $result = $this->validator->validate($data);

        if (!$result->isValid()) {
            $errors = $result->errors();
            $salles = $this->salleRepository->all();

            require __DIR__ . '/../../templates/reservation/form.php';
            return;
        }

        try {
            $dto = new CreerReservationDTO(
                $data['salle_id'],
                $data['responsable'],
                $data['email'],
                $data['motif'],
                new DateTimeImmutable($data['date_debut']),
                new DateTimeImmutable($data['date_fin'])
            );

            $this->creerReservationService->execute($dto);

            header('Location: /reservations');
            exit;

        } catch (\Exception $e) {
            $errors['general'] = $e->getMessage();
            $salles = $this->salleRepository->all();

            require __DIR__ . '/../../templates/reservation/form.php';
        }
    }

    public function cancel(int $id): void
    {
        try {
            $this->annulerReservationService->execute($id);

            header('Location: /reservations');
            exit;

        } catch (\Exception $e) {
            http_response_code(404);
            require __DIR__ . '/../../templates/error/404.php';
        }
    }
}
