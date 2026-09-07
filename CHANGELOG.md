## Questions / Réponses

### 1. Quel est le rôle de Composer ?

Composer est le gestionnaire de dépendances de PHP. Il permet d'installer et de gérer les bibliothèques utilisées dans le projet, de gérer leurs versions et de charger automatiquement les classes grâce à l'autoloading.

### 2. Quelle différence existe entre `require` et `require-dev` ?

`require` contient les dépendances nécessaires au fonctionnement de l'application, y compris en production.

`require-dev` contient les dépendances utilisées uniquement pendant le développement et les tests, comme PHPUnit.

### 3. Pourquoi faut-il versionner `composer.lock` ?

`composer.lock` contient les versions exactes des dépendances installées. Il permet donc à tous les développeurs et aux environnements de déploiement d'utiliser les mêmes versions.

### 4. Pourquoi ne versionne-t-on pas `vendor/` ?

Le dossier `vendor/` contient les dépendances téléchargées par Composer. Il peut être recréé automatiquement avec la commande :

```bash
composer install
```

Il n'est donc pas nécessaire de le versionner avec Git. Il doit être ajouté au fichier `.gitignore`.

```gitignore
/vendor/
```





## [v0.1.0] - Étape 1 : Initialisation de Composer

### Rôle de Composer

Composer est le gestionnaire de dépendances de PHP. Il permet d'installer, de gérer les versions et de charger automatiquement les bibliothèques nécessaires au projet.

### Différence entre require et require-dev

* `require` contient les dépendances nécessaires au fonctionnement de l'application.
* `require-dev` contient les dépendances utilisées uniquement pour le développement et les tests.

### Pourquoi versionner composer.lock ?

Le fichier `composer.lock` contient les versions exactes des dépendances installées. Il permet donc à tous les environnements d'utiliser les mêmes versions.

### Pourquoi ne pas versionner vendor/ ?

Le dossier `vendor/` contient les bibliothèques installées par Composer. Il est généré automatiquement à partir de `composer.json` et `composer.lock` avec la commande :

```bash
composer install
```

Il est donc inutile de le versionner dans Git. Le dossier `vendor/` est ajouté au `.gitignore`.
