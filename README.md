# Project 3 - MAKE SENSE - Symfony

## Présentation
Voici un outil de gestion de prises de décisions développé pour la plateforme interne de l'association MAKE SENSE. 
Cet outil permet d'y retrouver un suivi des décisions en cours et passées.
Authentification sécurisée, gestions des users, CRUD, navigation...

## Prérequis
Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :
PHP 
Composer
Yarn
MySQL 
Bootstrap

## Installation
Suivez les étapes ci-dessous pour installer et configurer le projet :

1/ Clonez le dépôt Git :
git clone https://github.com/nom-utilisateur/nom-projet.git

2/ Accédez au répertoire du projet :
cd nom du projet

3 / Installez les dépendances PHP avec Composer :
composer install

4/ Configurez les variables d'environnement :
.env.local

5 / Créez la base de données :
symfony/console doctrine:database:create

6/ Appliquez les migrations :
symfony/console doctrine:migrations:migrate

7/ Chargez les données de démonstration (fixtures) :
symfony/console doctrine:fixtures:load

8/ Installez les dépendances front-end :
yarn install

9/ Utilisation
symfony/console server:start
Accédez à l'application dans votre navigateur à l'adresse http://localhost:8000.


* GrumPHP, as pre-commit hook, will run 2 tools when `git commit` is run :

    * PHP_CodeSniffer to check PSR12
    * PHPStan focuses on finding errors in your code (without actually running it)
    * PHPmd will check if you follow PHP best practices

  If tests fail, the commit is canceled and a warning message is displayed to developper.

* Github Action as Continuous Integration will be run when a branch with active pull request is updated on github. It will run :

    * Tasks to check if vendor, .idea, env.local are not versionned,
    * PHP_CodeSniffer, PHPStan and PHPmd with same configuration as GrumPHP.

