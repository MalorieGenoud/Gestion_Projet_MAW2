# Résumé



# Introduction

Dans le cadre du CPNV, nous devons concevoir une plateforme Web à l'aide d'un framework de gestion de projet. Cette gestion contiendra le planning initial et final d'un projet ainsi qu'une partie gestion des tâches permettant de construire le journal de bord. 
Le site permettra de mieux gérer toute la partie planning et gestion des tâches dans un quelconque projet, peu importe le cadre dans lequel il est fait.
Les gestion de projet est une partie très importante dans "le monde des techniciens" ...
Ce site sera une partie intégrante de l'Intranet du CPNV afin d'offrir cette gestion à tous les utilisateurs, qu'ils soient "élève" ou "professeur" des trois sites.
Ce projet devra permettre de créer un nouveau projet, d'inviter des membres, ajouter des nouvelles tâches qu'elles soient "parente", "enfant" ou aucun des deux, démarrer et stoper une tâche, supprimer ou éditer une tâche, ajouter un ou plusieurs utilisateurs

# Corps du rapport

## Cahier des charges

### Tâches principales

  - Les tâches auront une durée en heure dans le planning.
  - Attribution des tâches sur plusieurs personnes (les personnes du groupe peuvent s’ajouter à une tâche en cours par une autre personne du groupe).
  - L’élève pourra voir toutes ses tâches sous forme de liste.
  - Dans le journal de travail on récoltera le nom de la tâche, la durée par le planning et sa véritable durée pour permettre de comparer.
  - Dans les tâches, l’élève pourra « commencer », « arrêter » et « reprendre » une tâche (l’application devra tracker quand il a commencé et arrêté). La tâche aura donc plusieurs « début » et « fin ».
  - L’élève peut avoir un historique de ses tâches pour voir par exemple les dernières tâches effectuées, il ne peut pas les modifier, s'il veut les modifier il doit demander au professeur.
  - Chaque tâche peut avoir des commentaires par la personne qui a la tâche ou par le professeur. 
  - Mettre un champ de recherche pour les commentaires et tâches.

### Tâches secondaires

  - Les tâches sont modifiables/supprimables que par les élèves et les profs même en cours du projet (planification).
  - Les tâches et le projet ne seront pas visibles par les autres groupes de personnes.
  - Il existera donc 2 types d’utilisateurs :
    - Elèves
    - Professeurs
  - Le professeur devra pouvoir voir en temps réel comment les élèves activent et désactivent leur tâches comme un historique. On retrouvera donc le nom de l’élève et sa tâche avec la durée.

## Théorie

### Routing

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

#### Route App

La **Route App** contient la méthode suivante:

  - **SessionController@destroy** => De détruire la session actuelle quans l'utilisateur se déconnecte 

#### Route Invitation Projects

La **Route Invitation Projects** contient les méthodes suivantes:

  - **InvitationController@show** => De retourner la vu des invitations 
  - **InvitationController@store** => De créer une nouvelle invitation 
  - **InvitationController@wait** => De retourner la vue des invitations en attentes 
  - **InvitationController@edit** => De retourner la vue d'édition des invitations
  - **InvitationController@** => De mettre à jour les invitations en *Accept* et d'ajouter l'utilisateur au(x) projet(s) qu'il a accepté(s)
  - **InvitationController@refuse** => De mettre à jours les invitations en *Refuse*

#### Route Event

La **Route Event** contient les méthodes suivantes:

  - **EventController@show** => De retourner la vue des événements 
  - **EventController@store** => D'ajouter un événement 

#### Route Comment

La **Route Comment** contient les méthodes suivantes:

  - **CommentController@show** => De retourner la vue des commentaire 
  - **CommentController@store** => D'ajouter un commentaire sur une tâche 

### Controller

Nous avons créé différents **Controller** pour gérer les différentes fonctionnalités de notre site:

  - **InvitationController**
  - **ProjectController**
  - **TaskController**

Nous avons modifié un **Controller** déjà existant en rajoutant une méthode:

  - **SessionController** => Ajout de la méthode **store**

Les différentes méthodes des **Controller** ont été expliquées dans la partie **Route**.


### Middleware

#### ProjectControl


### Models

#### MCD
![alt-text](MCD_MLD\\MCD.png)

#### MLD
![alt-text](MCD_MLD\\MLD.png)

### Views

  - **Project** => Affiche la liste de tous les projets créés ainsi que les utilisateurs liés aux projets.
  - **Invitation**
  - **Task**
  - **Planning**
  - 


### Plugin planning



## Liste des tests à effectuer



## Résultats



# Conclusion



# Références



# Annexes