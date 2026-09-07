<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

require __DIR__ . '/../config/database.php';

Capsule::table('salles')->insert([
    [
        'nom' => 'Salle A101',
        'batiment' => 'Bâtiment A',
        'capacite' => 30,
        'type' => 'cours',
        'active' => true,
    ],
    [
        'nom' => 'Salle Informatique B202',
        'batiment' => 'Bâtiment B',
        'capacite' => 25,
        'type' => 'informatique',
        'active' => true,
    ],
    [
        'nom' => 'Amphithéâtre C',
        'batiment' => 'Bâtiment C',
        'capacite' => 150,
        'type' => 'amphitheatre',
        'active' => true,
    ],
]);