# Reservation de salles universitaires

Application PHP orientee objet de gestion des salles et des reservations.

## Prerequis

- PHP 8.3 ou Docker
- Composer
- MySQL 8

## Installation

```bash
composer install
cp .env.example .env
```

Renseigner les acces MySQL dans `.env`, puis creer les tables et les donnees initiales :

```bash
php database/migrate.php
php database/seed.php
```

Lancer l'application :

```bash
php -S localhost:8000 -t public
```

Avec Docker :

```bash
docker compose up --build
```

L'application est alors accessible sur http://localhost:8080.

## Tests

```bash
vendor/bin/phpunit
```

Les tests unitaires du service de reservation utilisent des repositories en memoire et ne necessitent pas MySQL.

## Organisation

- `public/index.php` est le Front Controller.
- `routes/web.php` declare les routes FastRoute.
- `src/Controller` traite les requetes HTTP.
- `src/Validation` valide les donnees entrantes.
- `src/DTO` transporte les donnees typees vers les services.
- `src/Repository` isole l'acces a Eloquent.
- `src/Service` porte les regles metier des reservations.
- `templates` contient les vues PHP echappees.
