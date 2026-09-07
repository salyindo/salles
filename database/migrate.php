<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$capsule = require __DIR__ . '/../config/database.php';

require_once __DIR__ . '/migrations/002_create_reservations_table.php';

echo "Migration exécutée avec succès !" . PHP_EOL;