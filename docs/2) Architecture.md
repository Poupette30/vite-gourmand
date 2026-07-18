# Architecture du projet – Vite & Gourmand

## 1. Choix de l'architecture

L'application **Vite & Gourmand** a été développée selon le modèle **MVC (Modèle – Vue – Contrôleur)**.

Cette architecture permet de séparer les différentes responsabilités de l'application afin de faciliter sa maintenance, son évolution et sa compréhension.

Le principe est de distinguer :

* les données de l'application ;
* la logique métier ;
* l'affichage des pages.

Cette séparation rend le code plus lisible et limite les dépendances entre les différentes parties du projet.

---

# 2. Organisation générale du projet

Le projet est organisé autour des dossiers suivants :

```text
app/
│
├── controllers/
├── core/
├── models/
└── views/

config/

database/

docs/

mongo/

public/

tests/
```

Chaque dossier possède un rôle bien défini.

---

# 3. Description des dossiers

## app/controllers

Les contrôleurs reçoivent les requêtes des utilisateurs.

Ils exécutent la logique métier, communiquent avec les modèles puis transmettent les données nécessaires aux vues.

Exemples :

* AuthController
* MenuController
* OrderController
* ReviewController
* ContactController
* AdminController
* AnalyticsController

---

## app/models

Les modèles représentent les données de l'application.

Ils réalisent les opérations sur la base MySQL :

* lecture ;
* insertion ;
* modification ;
* suppression.

Chaque modèle correspond à une entité principale.

Exemples :

* User
* Menu
* Order
* Review

---

## app/views

Les vues contiennent le code HTML et PHP chargé d'afficher les pages visibles par l'utilisateur.

Exemples :

* page d'accueil ;
* liste des menus ;
* détail d'un menu ;
* espace utilisateur ;
* tableau de bord administrateur.

---

## app/core

Ce dossier contient les composants techniques utilisés dans l'ensemble du projet.

On y retrouve notamment :

* connexion à la base de données ;
* authentification ;
* sécurité ;
* gestion des vues ;
* envoi de courriels.

Ces classes sont réutilisées par les contrôleurs.

---

## config

Le dossier **config** centralise les paramètres de l'application.

On y retrouve par exemple :

* configuration générale ;
* paramètres de sécurité ;
* informations de connexion.

Cette organisation permet de modifier facilement la configuration sans toucher au reste du code.

---

## database

Ce dossier contient les scripts SQL nécessaires à la création et au remplissage de la base de données.

On y retrouve notamment :

* création des tables ;
* insertion des données de démonstration.

---

## mongo

Le dossier **mongo** contient les scripts destinés à MongoDB.

Ils permettent de créer les collections utilisées pour les statistiques administratives.

---

## docs

Ce dossier rassemble toute la documentation technique du projet :

* présentation ;
* architecture ;
* base de données ;
* sécurité ;
* fonctionnalités ;
* installation.

---

## public

Le dossier **public** constitue le point d'entrée de l'application.

Il contient notamment :

* index.php ;
* feuilles de style CSS ;
* fichiers JavaScript ;
* images ;
* ressources statiques.

Toutes les requêtes des utilisateurs passent par ce dossier.

---

## tests

Ce dossier est destiné aux différents tests réalisés durant le développement du projet.

---

# 4. Fonctionnement d'une requête

Le fonctionnement général de l'application est le suivant :

1. L'utilisateur effectue une action depuis son navigateur.
2. La requête est reçue par **index.php**.
3. Le contrôleur correspondant est appelé.
4. Le contrôleur interroge le modèle.
5. Le modèle communique avec la base de données.
6. Les données sont renvoyées au contrôleur.
7. Le contrôleur transmet les données à une vue.
8. La vue génère la page HTML affichée dans le navigateur.

Ce fonctionnement respecte le principe de séparation des responsabilités propre au modèle MVC.

---

# 5. Avantages de cette architecture

L'utilisation du modèle MVC présente plusieurs avantages :

* meilleure organisation du code ;
* séparation claire entre affichage et logique métier ;
* maintenance facilitée ;
* réutilisation des composants ;
* évolution plus simple de l'application ;
* amélioration de la lisibilité du projet.

---

# 6. Conclusion

L'architecture MVC retenue pour **Vite & Gourmand** permet de structurer efficacement l'application. La séparation des responsabilités facilite le développement, les corrections et les évolutions futures tout en rendant le projet plus compréhensible pour les développeurs amenés à intervenir dessus.
