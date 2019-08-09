# Symstragram

## Setup

1. Forker le projet
2. Cloner le projet en local
3. Copier `.env` en `.env.local` et configurer votre base de données
4. Installer les dépendances `composer install`
5. Créer la bdd `php bin/console doctrine:database:create`
6. Exécuter les migrations `php bin/console migrate`
7. Lancer le serveur `php bin/console server:run`