<?php

namespace App\Validation;

use Respect\Validation\Validator as v;

class SalleValidator implements ValidatorInterface
{
    public function validate(array $data): ValidationResult
    {
        $errors = [];

        if (!v::stringType()->notEmpty()->length(2, 100)->validate($data['nom'] ?? null)) {
            $errors['nom'] = 'Le nom est obligatoire et doit contenir entre 2 et 100 caractères.';
        }

        if (!v::stringType()->notEmpty()->length(2, 100)->validate($data['batiment'] ?? null)) {
            $errors['batiment'] = 'Le bâtiment est obligatoire et doit contenir entre 2 et 100 caractères.';
        }

        if (!v::intVal()->between(1, 1000)->validate($data['capacite'] ?? null)) {
            $errors['capacite'] = 'La capacité doit être un entier compris entre 1 et 1000.';
        }

        if (!v::in([
            'cours',
            'informatique',
            'laboratoire',
            'amphitheatre',
            'reunion'
        ])->validate($data['type'] ?? null)) {
            $errors['type'] = 'Le type de salle est invalide.';
        }

        if (!v::boolType()->validate($data['active'] ?? null)) {
            $errors['active'] = 'Le champ active doit être un booléen.';
        }

        return new ValidationResult(
            empty($errors),
            $errors,
            $data
        );
    }
}