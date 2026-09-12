<?php

declare(strict_types=1);

use App\Application;
use DI\ContainerBuilder;
use Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';



$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


require dirname(__DIR__) . '/config/database.php';



$builder = new ContainerBuilder();

$builder->addDefinitions(
    dirname(__DIR__) . '/config/container.php'
);

$container = $builder->build();



$application = $container->get(Application::class);

$application->run();