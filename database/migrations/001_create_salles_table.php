<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('salles', function ($table) {
    $table->id();
    $table->string('nom');
    $table->string('batiment');
    $table->integer('capacite');
    $table->enum('type', [
        'cours',
        'informatique',
        'laboratoire',
        'amphitheatre',
        'reunion'
    ]);
    $table->boolean('active')->default(true);
    $table->timestamps();
});