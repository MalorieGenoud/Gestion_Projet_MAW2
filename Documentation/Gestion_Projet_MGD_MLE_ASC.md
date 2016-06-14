# Résumé

Ce rapport décrit la réalisation technique d'une plateforme web, permettant de créer divers projets, d'assigner des utilisateurs à des projets et à des tâches ainsi qu'une gestion des tâches.

# Introduction

Dans le cadre du CPNV dans le module MAW2 (Module d'Application Web 2), nous devons concevoir une plateforme Web de gestion de projet à l'aide d'un framework. Elle contiendra le planning initial et final d'un projet ainsi qu'une partie gestion des tâches permettant de construire le journal de bord. 

Le site permettra de mieux gérer toute la partie planning et gestion des tâches dans un quelconque projet, peu importe le cadre dans lequel il est fait.

Ce site sera une partie intégrante de l'Intranet du CPNV afin d'offrir cette gestion à tous les utilisateurs, qu'ils soient "élève" ou "professeur".

Il y a divers buts que nous devons atteindre. Il devra permettre:

  - De créer un nouveau projet
  - D'inviter des membres pour ce projet
  - D'ajouter des nouvelles tâches qu'elles soient "parente", "enfant" ou simplement "racine"
  - De démarrer et stopper une tâche
  - De supprimer ou éditer une tâche
  - D'ajouter un ou plusieurs utilisateurs à une tâche
  - D'afficher le planning en fonction des tâches.

# Corps du rapport

## Cahier des charges

### Fonctionnalités principales

  - Les tâches auront une durée en heure dans le planning.
  - Attribution des tâches sur plusieurs personnes (les personnes du groupe peuvent s’ajouter à une tâche en cours par une autre personne du groupe).
  - L’élève pourra voir toutes ses tâches sous forme de liste.
  - Dans le journal de travail on récoltera le nom de la tâche, la durée par le planning et sa véritable durée pour permettre de comparer.
  - Dans les tâches, l’élève pourra « commencer », « arrêter » et « reprendre » une tâche (l’application devra tracker quand il a commencé et arrêté). La tâche aura donc plusieurs « début » et « fin ».
  - L’élève peut avoir un historique de ses tâches pour voir par exemple les dernières tâches effectuées, il ne peut pas les modifier, s'il veut les modifier il doit demander au professeur.
  - Chaque tâche peut avoir des commentaires par la personne qui a la tâche ou par le professeur. 
  - Mettre un champ de recherche pour les commentaires et tâches.

### Fonctionnalités secondaires

  - Les tâches sont modifiables/supprimables que par les élèves et les profs même en cours du projet (planification).
  - Les tâches et le projet ne seront pas visibles par les autres groupes de personnes.
  - Il existera donc 2 types d’utilisateurs :
    - Elèves
    - Professeurs
  - Le professeur devra pouvoir voir en temps réel comment les élèves activent et désactivent leur tâches comme un historique. On retrouvera donc le nom de l’élève et sa tâche avec la durée.

### Fonctionnalités supplémentaire

Ces fonctionnalités ont été discutées avec M. Carrel Xavier. Cependant, nous n'allons pas implémenter toutes les fonctionnalités que M. Carrel nous a demandé. Après discussion, nous avons décidé d'implémenter:

  - Une liste d’objectifs généraux. Chaque objectif général est constitué d’un énoncé, accompagné d’une checklist de critères qui permettront de dire si l’objectif est atteint ou non
  - Un journal de bord, qui contient les événements marquants du projet. Il est éditable (ajout uniquement) par n’importe quel membre du projet.

## Mise en place du projet

### Outils

Pour la réalisation de notre projet, nous avons utilisé les outils suivants:

  - Microsoft Viso
  - MySQl Workbench
  - JetBrains PhpStorm 2016.1
  - Laravel 5.2
  - Trello
  - Github - <https://github.com/MalorieGenoud/Gestion_Projet_MAW2.git>
  - Xampp
  - Wamp

## Théorie

Cette partie contient l'explication des **Route**, des **Controller**, des **Middleware** et des **Models** que nous avons créés tout le long de notre projet.

### Route

Nous avons structuré nos différentes **Route** en deux blocs. Le premier bloc gère tout ce qui concerne l'authentification d'un utilisateur:

``` php
    Route::get('login', 'SessionController@create');
```
La première **Route** permet de renvoyer à l'utilisateur sur la vue de **Login** en appelant le **Controller** `SessionController@create` si celui-ci n'est pas connecté, d'où l'utilisation de la méthode **GET** car dans ce cas-ci on prend des données via l'url.

``` php
    Route::post('login', 'SessionController@store');
```
La deuxième **Route** permet de contrôler la validiter de l'e-mail et le mot de passe par rapport à la base de données en appelant le **Controller** `SessionController@store`, d'où l'utilisation de la méthode **POST** car dans ce cas-ci en renvoie des données.

Le deuxième bloc regroupe toutes les **Route** nécessaire à toute la conception de la gestion de projet: 

``` php
    Route::group(['middleware' => 'auth'], function(){ 
        ... 
    }
```
Cette **Route** regroupe toutes les autres (d'où l'utilisation de la méthode **GROUP** et permet à un utilisateur connecté d'accéder au reste du site.

#### Route Task

La **Route Task** contient les méthodes suivantes:

  - **TaskController@show** => D'afficher les détails de la tâche sélectionnée 
  - **TaskController@create** => De retourner la vue de création des tâches simple ou parentes 
  - **TaskController@store** => De créer des tâches simple ou parentes, de les mettre à jour 
  - **TaskController@createChildren** => De retourner la vue de création des tâches enfants 
  - **TaskController@storeChildren** => De créer des tâches enfants 
  - **TaskController@destroy** => De supprimer des tâches parents et/ou enfants 
  - **TaskController@edit** => D'éditer des tâches 
  - **TaskController@play** => De commencer une tâche 
  - **TaskController@stop** => De stopper une tâche 
  - **TaskController@users** => D'afficher les utilisateurs ayant une ou des tâches en communs 
  - **TaskController@storeUsers** => D'ajouter un ou plusieurs utilisateurs à une tâche 
  - **TaskController@userTaskDelete** => De supprimer un utilisateur à une tâche

#### Route Project

La **Route Project** contient les méthodes suivantes:

  - **ProjectController@index** => De retourner la vue des projets
  - **ProjectController@show** => D'afficher les projets ainsi que les utilisateurs du projet
  - **ProjectController@edit** => De retourner la vue d'édition des projets 
  - **ProjectController@task** => De retourner la vue des tâches du projet sélectionné 
  - **ProjectController@create** => De retourner la vue de création des projets 
  - **ProjectController@store** => De créer un ou plusieurs projets
  - **ProjectController@createTask** => De retourner la vue de création d'une tâche
  - **ProjectController@storeTask** => De créer une ou plusieurs tâches 
  - **ProjectController@destroyUser** => De supprimer un ou plusieurs utilisateurs d'un projet
  - **ProjectController@storeTarget** => De créer un objectif
  - **ProjectController@validateTarget** => De valider un objectif
  - **ProjectController@getTarget** => De retourner la vue des objectifs

#### Route App

La **Route App** contient la méthode suivante:

  - **SessionController@destroy** => De détruire la session actuelle quans l'utilisateur se déconnecte 

#### Route Invitation Projects

La **Route Invitation Projects** contient les méthodes suivantes:

  - **InvitationController@show** => De retourner la vu des invitations 
  - **InvitationController@store** => De créer une nouvelle invitation 
  - **InvitationController@wait** => De retourner la vue des invitations en attentes 
  - **InvitationController@edit** => De retourner la vue d'édition des invitations
  - **InvitationController@** => De mettre à jour les invitations en *Accept* et d'ajouter l'utilisateur au(x) projet(s)
  - **InvitationController@refuse** => De mettre à jours les invitations en *Refuse*

#### Route Event

La **Route Event** contient les méthodes suivantes:

  - **EventController@show** => De retourner la vue des événements 
  - **EventController@store** => D'ajouter un événement 
  - **EventController@formEvent** => Retourne la vue du formulaire d'ajout d'un événement

#### Route Comment

La **Route Comment** contient les méthodes suivantes:

  - **CommentController@show** => De retourner la vue des commentaire 
  - **CommentController@store** => D'ajouter un commentaire sur une tâche 

#### Route User

La **Route User** contient les méthodes suivantes:

  - **UserController@show** => De retourner la vue des informations de l'utilisateur
  - **UserController@storeAvatar** => D'ajouter un avatar à l'utilisateur

#### Route File

La **Route File** contient la méthode suivante:

  - **FileController@show** => De retourner la vue des fichiers
  - **FileController@store** => D'ajouter des fichiers

### Controller

Nous avons créé différents **Controller** pour gérer les différentes fonctionnalités de notre site:
  
  - **TaskController**
  - **ProjectController**
  - **InvitationController**
  - **UserController**
  - **PlanningControlelr**
  - **CommentController**
  - **EventController**
  - **FileController**
  
Nous avons modifié un **Controller** déjà existant en rajoutant une méthode:

  - **SessionController** => Ajout de la méthode **store**

Les différentes méthodes des **Controller** ont été expliquées dans la partie **Route**.

### Middleware

#### ProjectControl

Ce **Middleware** permet que lorsqu'un utilisateur s'authentifie sur le site, celui-ci va vérifier le rôle de l'utilisateur. Si son rôle est **Eleve**, il peut accéder aux fonctionnalités du site. Néanmoins si ce n'est pas le cas, il ne peut pas y accéder.

### Models

#### MCD
![alt-text](MCD_MLD\\MCD.png)

#### MLD
![alt-text](MCD_MLD\\MLD.png)

#### Migrations

Nous avons créer pour chaque table un fichier de **Migration** afin de nous facilité la mise à jour de la base de données étant donné que nous avons dû ajouter ou supprimer plusieurs champs dans les tables.

### Views

Nous avons différentes vues:

  - La vue d'authentification d'un utilisateur
  - La vue qui affiche tous les porjets ainsi que les utilisateurs associés à un ou plusieurs projets
  - La vue de création d'un projet
  - La vue des invitations en attente de l'utilisateur connecté
  - La vue d'un des projet de l'utilisateur connecté comportant:
    - Le planning
    - Les tâches associées à l'utilisateur contenant:
      - L'option **Terminé**
      - L'option **Commencer**/**Stopper**
    - La liste des tâches du projet contenant:
      - La création d'une tâche racine
      - L'ajout d'une tâche enfant à une tâche parente
      - L'édition d'une tâche
      - La suppression d'une tâche
      - L'ajout d'un utilisateur à une tâche
    - Les détails d'une tâche contenant:
      - La durée intiale
      - La date du jalon
      - Les différents rush
      - La liste des commentaires
      - L'ajout d'un commentaire
    - Les information du projet contenant:
      - Le nom
      - la date de début
      - Une description
      - Les membres du projet avec:
        - L'ajout d'un membre
        - La suppression d'un membre
        - Voir les invitation en attente
    - La liste des évènements majeurs

### Plugin planning

Pour l'affichage du planning, nous avons utilisé le plugin de Google Charts.

## Liste des tests à effectuer

  - L'authentification avec vérification de l'e-mail et du mot de passe 
  - La déconnexion
  - Dans la vue global des projets: 
    - L'affichage de la liste des projets ainsi que les utilisateurs associés
    - L'accès au détail du projet lorsqu'on clique sur le nom du projet
    - La création d'un projet
    - L'affichage d'un pop-up des invitations en attente, acceptée ou refusée de l'utilisateur connecté
    - La possibilité d'accepter ou de refuser une invitation
  - Dans la vue détaillée du projet d'un utilisateur
    - L'affichage correcte du planning
    - Dans la partie **Vos tâches**
      - L'affichage des tâches propres à l'utilisateur connecté
      - L'affichage de toutes les tâches racines et/ou parents
      - L'affichage de l'avancement en pourcent de la tâche racine/parente/enfant (pour les tâches parentes, le pourcentage se fait en fonction des tâches enfants)
      - La possibilité de valider la fin d'une tâche
      - La possibilité de démarrer/stopper une tâche sauf si la tâche contient des tâches enfants
      - L'affichage des tâches enfants d'une tâches
      - L'affichage du temps des tâches (pour les tâches parents, leur temps est calcul en fonctionne du temps de leurs tenfants en plus de leur temps de base)
    - Dans la partie **Les tâches du projet**
      - L'affichage de toutes les tâches racines et/ou parents
      - L'affichage de l'avancement en pourcent de la tâche racine/parente/enfant (pour les tâches parentes, le pourcentage se fait en fonction des tâches enfants)
      - La possibilité de créer une tâche racine
      - La création d'une tâche enfant d'une tâche existante
      - L'édition d'une tâche racine/parente/enfant
      - La suppression d'une tâche
      - L'ajout d'un ou plusieurs utilisateurs à une tâche
      - L'affichage des tâches enfants d'une tâches
      - L'affichage du temps des tâches (pour les tâches parents, leur temps est calcul en fonctionne du temps de leurs tenfants en plus de leur temps de base)
    - Dans la partie **Détail de la tâche**
      - L'affichage du nom de la tâche avec:
        - L'affichage de la durée intiale de la tâche
        - L'affichage de la date du jalon (si y a une date de jalon)
      - L'affichage des différents rush effectués sur la tâche avec:
        - L'affichage de la date de création du rush
        - L'affichage de la date de fin du rush
        - Le nom de l'utilisateur qui a effectué le rush
        - La durée du rush
      - L'affichage des commentaires avec:
        - Le commentaire
        - La date de création du commentaire
        - Le nom de l'utilisateur qui a écrit le commentaire
      - L'ajout de commentaires
    - Dans la partie **Informations du projet**
      - L'affichage du nom du projet
      - L'affichage du début du projet
      - L'affichage de la description du projet
      - L'affichage des différents membres du projet avec l'affichage de leur avatar, de leur nom et prénom ainsi que l'adresse e-mail
      - La suppression d'un membre
      - L'ajout d'un membre
      - L'affichage des invitations en attente du projet
      - L'ajout d'un ou plusieurs objectifs
    - Dans la partie **Evènement majeur**
      - L'affichage des événements avec:
        - L'utilisateur qui a effectué ou créer l'évenement
        - La description de l'évenement
        - La date de création
      - L'ajout d'un événement
    - Le champ de recherche d'un commentaire ou d'une tâche
  - Dans la partie **Informations sur l'utilisateur**
    - L'affichage du nom de l'utilisateur
    - L'affichage correcte de son avatar (s'il l'a déjà ajouté)
    - La recherche d'un avatar depuis le bouton **Parcourir...**
    - L'ajout d'un avatar depuis le bouton **Envoyer**
    - L'affichage de l'email de l'utilisateur
    - L'affichage du rôle de l'utilisateur (**Elève** ou **Prof**)

## Résultats des tests

  - L'authentification avec vérification de l'e-mail et du mot de passe => **FONCTIONNELLE À 100%**
  - La déconnexion => **FONCTIONNELLE À 100%**
  - Dans la vue global des projets: 
    - L'affichage de la liste des projets => **FONCTIONNELLE À 100%**
    - L'affichage des utilisateurs associés au(x) projet(s) => **FONCTIONNELLE À 100%**
    - L'accès à la vue détaillée du projet lorsqu'on clique sur le nom du projet => **FONCTIONNELLE À 100%**
    - La création d'un projet => **FONCTIONNELLE À 100%**
    - L'affichage d'un pop-up des invitations en attente, acceptée ou refusée de l'utilisateur connecté => **FONCTIONNELLE À 100%**
    - La possibilité d'accepter ou de refuser une invitation => **FONCTIONNELLE À 100%**
  - Dans la vue détaillée du projet de utilisateur l'utilisateur connecté:
    - L'affichage correcte du planning => **CHANGEZ DE PLUGIN**
    - Dans la partie **Vos tâches**
      - L'affichage des tâches propres à l'utilisateur connecté => **FONCTIONNELLE À 100%**
      - L'affichage de toutes les tâches racines et/ou parentes => **FONCTIONNELLE À 100%**
      - L'affichage de l'avancement en pourcent de la tâche racine/parente/enfant (pour les tâches parentes, le pourcentage se fait en fonction des tâches enfants) => **FONCTIONNELLE À 100%**
      - La possibilité de valider la fin d'une tâche => **FONCTIONNELLE À 90%**
      - La possibilité de démarrer/stopper une tâche sauf si la tâche contient des tâches enfants => **FONCTIONNELLE À 100%**
      - L'affichage des tâches enfants d'une tâche parente => **FONCTIONNELLE À 100%**
      - L'affichage du temps des tâches (pour les tâches parents, leur temps est calcul en fonctionne du temps de leurs tenfants en plus de leur temps de base) => **FONCTIONNELLE À 100%**
    - Dans la partie **Les tâches du projet**
      - L'affichage de toutes les tâches racines et/ou parents => **FONCTIONNELLE À 100%**
      - L'affichage de l'avancement en pourcent de la tâche racine/parente/enfant (pour les tâches parentes, le pourcentage se fait en fonction des tâches enfants) => **FONCTIONNELLE À 100%**
      - La possibilité de créer une tâche racine => **FONCTIONNELLE À 100%**
      - La création d'une tâche enfant d'une tâche existante => **FONCTIONNELLE À 100%**
      - L'édition d'une tâche racine/parente/enfant => **FONCTIONNELLE À 100%**
      - La suppression d'une tâche => **FONCTIONNELLE À 100%**
      - L'ajout d'un ou plusieurs utilisateurs à une tâche => **FONCTIONNELLE À 100%**
      - L'affichage des tâches enfants d'une tâches => **FONCTIONNELLE À 100%**
      - L'affichage du temps des tâches (pour les tâches parents, leur temps est calcul en fonctionne du temps de leurs tenfants en plus de leur temps de base) => **FONCTIONNELLE À 100%**
    - Dans la partie **Détail de la tâche**
      - L'affichage du nom de la tâche avec:
        - L'affichage de la durée intiale de la tâche => **FONCTIONNELLE À 100%**
        - L'affichage de la date du jalon (si y a une date de jalon) => **FONCTIONNELLE À 100%**
      - L'affichage des différents rush effectués sur la tâche avec: => **FONCTIONNELLE À 100%**
        - L'affichage de la date de création du rush
        - L'affichage de la date de fin du rush
        - Le nom de l'utilisateur qui a effectué le rush
        - La durée du rush
      - L'affichage des commentaires avec: => **FONCTIONNELLE À 100%**
        - Le commentaire
        - La date de création du commentaire
        - Le nom de l'utilisateur qui a écrit le commentaire
      - L'ajout de commentaires => **FONCTIONNELLE À 100%**
    - Dans la partie **Informations du projet**
      - L'affichage du nom du projet => **FONCTIONNELLE À 100%**
      - L'affichage du début du projet => **FONCTIONNELLE À 100%**
      - L'affichage de la description du projet => **FONCTIONNELLE À 100%**
      - L'affichage des différents membres du projet => **FONCTIONNELLE À 100%**
      - La suppression d'un membre => **FONCTIONNELLE À 100%**
      - L'ajout d'un membre => **FONCTIONNELLE À 100%**
      - L'affichage des invitations du projet ayant pour status *en attente*, *refusée* ou *acceptée* => **FONCTIONNELLE à 100%**
    - Dans la partie **Evènement majeur**
      - L'affichage des événements avec: => **FONCTIONNELLE À 80%**
        - L'utilisateur qui a effectué ou créer l'évenement
        - La description de l'évenement
        - La date de création
      - L'ajout d'un événement => **EN COURS**
    - Le champ de recherche d'un commentaire ou d'une tâche => **EN COURS**
  - Dans la partie **Informations sur l'utilisateur**
    - L'affichage du nom de l'utilisateur => **FONCTIONNELLE à 100%**
    - L'affichage correcte de son avatar (s'il l'a déjà ajouté) => **FONCTIONNELLE À 100%**
    - La recherche d'un avatar depuis le bouton **Parcourir...** => **FONCTIONNELLE à 100%**
    - L'ajout d'un avatar depuis le bouton **Envoyer** => **FONCTIONNELLE À 100%**
    - L'affichage de l'email de l'utilisateur => **FONCTIONNELLE à 100%**
    - L'affichage du rôle de l'utilisateur (**Elève** ou **Prof**) => **FONCTIONNELLE À 100%**

## Erreurs restantes

## Fonctionnalités accomplies

### Fonctionnilités principales

  - Les tâches auront une durée en heure dans le planning.
  - Attribution des tâches sur plusieurs personnes (les personnes du groupe peuvent s’ajouter à une tâche en cours par une autre personne du groupe).
  - L’élève pourra voir toutes ses tâches sous forme de liste.
  - Dans le journal de travail on récoltera le nom de la tâche, la durée par le planning et sa véritable durée pour permettre de comparer.
  - Dans les tâches, l’élève pourra « commencer », « arrêter » et « reprendre » une tâche (l’application devra tracker quand il a commencé et arrêté). La tâche aura donc plusieurs « début » et « fin ».
  - L’élève peut avoir un historique de ses tâches pour voir par exemple les dernières tâches effectuées, il ne peut pas les modifier, s'il veut les modifier il doit demander au professeur.
  - Chaque tâche peut avoir des commentaires par la personne qui a la tâche ou par le professeur. 
  - Mettre un champ de recherche pour les commentaires et tâches.

### Fonctionnalités secondaires

  - Les tâches sont modifiables/supprimables que par les élèves et les profs même en cours du projet (planification).
  - Les tâches et le projet ne seront pas visibles par les autres groupes de personnes.
  - Il existera donc 2 types d’utilisateurs :
    - Elèves
    - Professeurs
  - Le professeur devra pouvoir voir en temps réel comment les élèves activent et désactivent leur tâches comme un historique. On retrouvera donc le nom de l’élève et sa tâche avec la durée.

### Fonctionnalités supplémentaires

  - Une liste d’objectifs généraux. Chaque objectif général est constitué d’un énoncé, accompagné d’une checklist de critères qui permettront de dire si l’objectif est atteint ou non
  - Un journal de bord, qui contient les événements marquants du projet. Il est éditable (ajout uniquement) par n’importe quel membre du projet.


# Pré-requis

Avant de faire un **pull** du projet, il faut vérifier que dans le fichier **php.ini**, la ligne ... soit décommentée (plus de **;** devant la ligne).
Après le **pull** du projet, il faut faire un **php artisan migrate** afin que toute la migration de la base de données soit faite.

# Conclusion



# Références



# Annexes