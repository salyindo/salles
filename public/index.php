<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$capsule = require_once __DIR__ . '/../config/database.php';

try {
    $capsule->getConnection()->getPdo();

    echo "Connexion à MySQL réussie !";
} catch (\PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}