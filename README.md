# Application de Gestion des Événements (app_gestion_evenements)

Cette application a été développée dans le but de gérer des événements pour une organisation régionale. Les utilisateurs peuvent créer, modifier, et supprimer des événements. De plus, ils peuvent s'inscrire à des événements.

## Technologies

Framework: Symfony (dernière version)
Base de données: MySQL/PostgreSQL (à configurer selon vos préférences)
Front-end: Bootstrap 
Authentification: Composant Security de Symfony
Fixtures: Librairie Faker

## Fonctionnalités

Authentification : Gestion complète des utilisateurs (inscription, connexion, déconnexion).
Gestion des événements : Les utilisateurs peuvent créer, modifier, et supprimer des événements.
Inscription aux événements : Les utilisateurs peuvent s'inscrire à des événements.
Vue "Mes événements" : Pour voir uniquement les événements auxquels un utilisateur est inscrit.
Affichage et filtres : Les événements sont affichés par ordre chronologique, avec une option de filtrage par date.

## Mise en route

Voici les étapes pour mettre en place le projet sur votre machine :

### 1. Clonez ce dépôt sur votre machine locale:
```
git clone https://github.com/valentin705/app_gestion_evenements.git
```

### 2. Installez les dépendances du projet avec Composer:
```
composer install
```

### 3. Configuration de la base de données

Installez et configurez votre serveur de base de données (par exemple, MySQL ou PostgreSQL). Assurez-vous qu'il est en cours d'exécution.

Configurez les informations de votre base de données en créant un fichier .env.local en vous basant sur .env ou configurez directement dans .env.prod si nécessaire.

### 4. Création de la base de données et application des migrations
```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. (Optionnel) Charger des données fictives

Si vous souhaitez charger des données fictives pour tester l'application, exécutez :
```
php bin/console doctrine:fixtures:load
```

### 6.  Installer le Symfony CLI

Si vous n'avez pas déjà le Symfony CLI installé, suivez les instructions sur le site officiel pour l'installer.

### 7. Démarrer le serveur
```
symfony serve -d
```

Naviguez ensuite vers http://localhost:8000 dans votre navigateur pour accéder à l'application.


