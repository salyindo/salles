<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$connection = [
    'driver'    => $_ENV['DB_DRIVER'],
    'host'      => $_ENV['DB_HOST'],
    'port'      => $_ENV['DB_PORT'],
    'database'  => $_ENV['DB_DATABASE'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
];

if (!empty($_ENV['DB_SSL_CA'])) {
    $connection['options'] = [
        PDO::MYSQL_ATTR_SSL_CA => $_ENV['DB_SSL_CA'],
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
    ];
}

$capsule->addConnection($connection);

$capsule->setAsGlobal();

$capsule->bootEloquent();

return $capsule;