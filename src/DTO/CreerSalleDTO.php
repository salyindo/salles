<?php

namespace App\DTO;

class CreerSalleDTO
{
    public function __construct(
        public string $nom,
        public string $batiment,
        public int $capacite,
        public string $type,
        public bool $active
    ) {
    }
}