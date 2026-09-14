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

Les deux commandes peuvent aussi être exécutées avec le script `commande` :

```bash
./commande
```

Avec Docker, utilise le réseau du conteneur PHP :

```bash
docker compose exec php ./commande
```

Lancer l'application :

```bash
php -S localhost:8000 -t public
```

Avec Docker, la base est créée et les cinq salles initiales sont ajoutées automatiquement au démarrage :

```bash
docker compose up --build
```

L'application est alors accessible sur http://localhost:8080.

Pour arrêter les conteneurs :

```bash
docker compose down
```

Pour supprimer aussi les données MySQL :

```bash
docker compose down -v
```

## Versionnement

Les étapes pédagogiques sont conservées dans les branches `feature/01-composer` à
`feature/12-tests`, avec les tags `v0.0.0` à `v0.11.0`. La version finale est
livrée avec la branche `release/1.0.0` et le tag `v1.0.0`.

## Publication Docker Hub

Remplacer `mon-compte` par le nom du compte Docker Hub connecté :

```bash
docker login
docker build -t mon-compte/reservation-salles:1.0.0 -f docker/php/Dockerfile .
docker tag mon-compte/reservation-salles:1.0.0 mon-compte/reservation-salles:latest
docker push mon-compte/reservation-salles:1.0.0
docker push mon-compte/reservation-salles:latest
```

## Base MySQL Aiven

Dans Aiven, créer un service **MySQL**, activer l'accès public, puis récupérer
les paramètres dans **Overview > Connection information**. Les variables à
définir dans Render sont `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` et
`DB_PASSWORD`.

Aiven fournit aussi un certificat CA dans **CA Certificate**. Le télécharger
dans le projet sous `config/aiven-ca.pem`, puis définir :

```env
DB_SSL_CA=/var/www/html/config/aiven-ca.pem
```

Le fichier `config/aiven-ca.pem` est un certificat public, mais le mot de passe
Aiven doit rester uniquement dans les variables secrètes de Render.

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
