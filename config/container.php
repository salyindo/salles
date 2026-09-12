<?php



use App\Application;
use App\Controller\ReservationController;
use App\Controller\SalleController;
use App\Repository\ReservationRepository;
use App\Repository\ReservationRepositoryInterface;
use App\Repository\SalleRepository;
use App\Repository\SalleRepositoryInterface;
use App\Service\AnnulerReservationService;
use App\Service\CreerReservationService;
use App\Validation\ReservationValidator;
use App\Validation\SalleValidator;
use Illuminate\Database\Capsule\Manager as Capsule;
use FastRoute\Dispatcher;

use function DI\autowire;
use function DI\factory;

return [

    // Connexion Eloquent
    Capsule::class => factory(function (): Capsule {
        return require dirname(__DIR__) . '/config/database.php';
    }),

    // Interfaces → implémentations
    SalleRepositoryInterface::class => autowire(SalleRepository::class),

    ReservationRepositoryInterface::class => autowire(
        ReservationRepository::class
    ),

    // Validators
    SalleValidator::class => autowire(),

    ReservationValidator::class => autowire(),

    // Services
    CreerReservationService::class => autowire(),

    AnnulerReservationService::class => autowire(),

    // Controllers
    SalleController::class => autowire(),

    ReservationController::class => autowire(),

    // FastRoute Dispatcher
    Dispatcher::class => factory(function (): Dispatcher {
        $routes = require dirname(__DIR__) . '/routes/web.php';

        return FastRoute\simpleDispatcher($routes);
    }),

    // Application
    Application::class => autowire(),
];
