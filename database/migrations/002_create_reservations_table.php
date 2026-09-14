<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$schema = Capsule::schema();

if ($schema->hasTable('reservations')) {
    return;
}

$schema->create('reservations', function ($table) {
    $table->id();

    $table->foreignId('salle_id')
        ->constrained('salles');

    $table->string('responsable');
    $table->string('email');
    $table->string('motif');
    $table->dateTime('date_debut');
    $table->dateTime('date_fin');

    $table->enum('statut', [
        'confirmée',
        'annulée'
    ]);

    $table->timestamps();
});
