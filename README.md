# Vite & Gourmand

## Sommaire

- Présentation
- Objectifs
- Technologies utilisées
- Architecture du projet
- Installation
- Configuration
- Lancement
- Base de données
- Fonctionnalités
- Sécurité
- Captures d'écran
- Pistes d'amélioration
- Auteur

## Présentation

**Vite & Gourmand** est une application web développée dans le cadre de l'Évaluation en Cours de Formation (ECF) de la formation **Développeur Web et Web Mobile**.

Cette application permet aux utilisateurs de consulter des menus traiteur, de passer des commandes en ligne, de suivre leur état d'avancement et de laisser un avis après la livraison. Elle intègre également un espace de gestion destiné aux employés et aux administrateurs.

L'objectif principal est de proposer une plateforme moderne, sécurisée et intuitive permettant de simplifier la gestion des commandes d'un service traiteur.

---

# Objectifs du projet

Ce projet a été réalisé afin de mettre en pratique les compétences acquises durant la formation, notamment :

* Concevoir une architecture MVC en PHP.
* Développer une application web dynamique.
* Utiliser une base de données relationnelle MySQL.
* Exploiter MongoDB pour les statistiques.
* Sécuriser l'authentification des utilisateurs.
* Gérer plusieurs rôles (utilisateur, employé et administrateur).
* Manipuler les formulaires et les données utilisateurs.
* Réaliser une interface responsive.

---

# Technologies utilisées

## Front-end

* HTML5
* CSS3
* JavaScript

## Back-end

* PHP 8
* Architecture MVC

## Bases de données

* MySQL
* MongoDB

## Outils

* WampServer
* phpMyAdmin
* MongoDB Compass
* Git
* GitHub
* Visual Studio Code

---

# Architecture du projet

Le projet **Vite & Gourmand** est développé selon une architecture **MVC (Modèle - Vue - Contrôleur)**.
Cette architecture permet de séparer les données, la logique métier et l'interface utilisateur afin de rendre l'application plus lisible, plus facile à maintenir et à faire évoluer.

```text

vite-gourmand/
│
├── app/
├── config/
├── database/
├── docs/
│   └── screenshots/
├── mongo/
├── public/
├── tests/
└── README.md

```

## Rôle des principaux dossiers

- **app/** : contient le code principal de l'application.
- **controllers/** : gèrent les requêtes des utilisateurs et la logique métier.
- **models/** : communiquent avec les bases de données.
- **views/** : affichent les pages de l'application.
- **core/** : regroupe les classes principales (authentification, sécurité, connexion à la base de données, affichage des vues, etc.).
- **config/** : contient les fichiers de configuration.
- **database/** : contient les scripts SQL de création et d'alimentation de la base MySQL.
- **mongo/** : contient les scripts d'initialisation de la base MongoDB.
- **public/** : contient le point d'entrée de l'application ainsi que les ressources publiques (CSS, JavaScript, images).
- **docs/** : contient la documentation technique et utilisateur du projet.
- **docs/screenshots/** : contient les captures d'écran utilisées dans le README et la documentation.
- **tests/** : contient les fichiers destinés aux tests de l'application.

---

# Installation

## Prérequis

Avant de lancer le projet, les logiciels suivants doivent être installés :

- WampServer
- PHP 8
- Apache
- MySQL
- MongoDB Community Server
- MongoDB Compass
- Visual Studio Code
- Git

## Installation du projet

1. Cloner le dépôt Git ou copier le projet dans le dossier `C:\wamp64\www\`.
2. Démarrer les services Apache et MySQL depuis WampServer.
3. Démarrer le service MongoDB.
4. Importer la base de données MySQL à l'aide des scripts présents dans le dossier `database/`.
5. Importer les données MongoDB à l'aide des scripts présents dans le dossier `mongo/`.
6. Vérifier les paramètres de connexion dans le fichier de configuration.

---

# Configuration

Les paramètres de configuration de l'application sont regroupés dans le fichier `config/config.php`.

Ce fichier permet notamment de configurer :

- la connexion à la base de données MySQL ;
- les paramètres généraux de l'application ;
- les informations nécessaires au bon fonctionnement du projet.

Avant de lancer l'application, il est recommandé de vérifier que les paramètres de connexion correspondent à votre environnement local.

---

# Lancement

Une fois les services Apache, MySQL et MongoDB démarrés, l'application est accessible depuis un navigateur à l'adresse suivante :

http://localhost/vite-gourmand/public/

L'utilisateur peut alors créer un compte, se connecter ou accéder aux différentes fonctionnalités selon son rôle (visiteur, utilisateur, employé ou administrateur).

---

# Base de données

L'application utilise deux systèmes de gestion de bases de données complémentaires :

## MySQL

MySQL est utilisé pour stocker les données principales de l'application.

Les principales tables sont :

- users
- menus
- orders
- reviews
- contacts
- themes
- diets
- dishes
- menu_dishes
- dish_allergens
- order_status_history

## MongoDB

MongoDB est utilisé pour stocker les statistiques de l'application.

La collection principale est :

- orders_by_menu

Elle permet notamment d'afficher :

- le nombre de commandes par menu ;
- le chiffre d'affaires généré ;
- les statistiques par période.

---

# Fonctionnalités

## Visiteur

* Consulter les menus.
* Consulter le détail d'un menu.
* Filtrer les menus selon différents critères.
* Créer un compte.
* Se connecter.
* Envoyer un message via le formulaire de contact.

## Utilisateur

En plus des fonctionnalités du visiteur :

* Passer une commande.
* Consulter l'historique de ses commandes.
* Suivre l'évolution de leur statut.
* Laisser un avis.
* Modifier son mot de passe grâce au système de réinitialisation sécurisé.

## Employé

* Consulter les commandes.
* Modifier leur statut.
* Gérer le suivi des commandes.

## Administrateur

* Accéder au tableau de bord.
* Gérer les employés.
* Modérer les avis.
* Consulter les statistiques issues de MongoDB.

---

# Sécurité

L'application met en œuvre plusieurs mécanismes de sécurité :

* Authentification sécurisée.
* Hachage des mots de passe.
* Gestion des rôles et des autorisations.
* Protection contre les accès non autorisés.
* Réinitialisation du mot de passe par jeton temporaire.
* Validation des données saisies.

---

# Captures d'écran

## 1. Page d'accueil

![Accueil](<docs/screenshots/01 Accueil.png>)

La page d'accueil présente le service traiteur, les principales fonctionnalités de l'application et permet d'accéder rapidement aux menus proposés.

---

## 2. Connexion


![Connexion](<docs/screenshots/08 Connexion.png>)

Cette page permet aux utilisateurs de se connecter afin d'accéder à leur espace personnel.

---

## 3. Menu Noël Gourmand

![Menu Noël](<docs/screenshots/02 Menu 1 Noel Gourmand.png>)

Présentation du menu **Noël Gourmand**.

![Menu Noël](<docs/screenshots/05 Détail Menu 1 Noel Gourmand.png>)

Cette page affiche le détail du menu, sa composition, son prix, les allergènes et les informations utiles avant la commande.

---

## 4. Menu Printemps Végétarien

![Menu Printemps Végétarien](<docs/screenshots/03 Menu 2 Printemps Végétarien.png>)

Présentation du menu **Printemps Végétarien**.

![Détail Menu Printemps Végétarien](<docs/screenshots/06 Détail Menu 2 Printemps Végétarien.png>)

Cette page présente le détail complet du menu.

---

## 5. Menu Classique Bordeaux

![Menu Bordeaux](<docs/screenshots/04 Menu 3 Classique Bordeaux.png>)

Présentation du menu **Classique Bordeaux**.

![Détail Menu Bordeaux](<docs/screenshots/07 Détail Menu 3 Classique Bordeaux.png>)

Cette page affiche les informations détaillées du menu.

---

## 6. Historique des commandes

![Historique](<docs/screenshots/09 Historique Commandes.png>)

L'utilisateur peut consulter toutes ses commandes ainsi que leur état d'avancement.

---

## 7. Gestion des commandes

![Gestion commandes](<docs/screenshots/10 Gestion Commandes.png>)

L'employé peut consulter les commandes et mettre à jour leur statut.

---

## 8. Gestion des employés

![Gestion employés](<docs/screenshots/13 Gestion des employés.png>)

L'administrateur peut gérer les comptes des employés.

---

## 9. Gestion des avis

![Gestion avis](<docs/screenshots/12 Gestion des avis.png>)

Les avis déposés par les utilisateurs peuvent être modérés par l'administrateur.

---

## 10. Statistiques

![Statistiques](<docs/screenshots/14 Statistiques.png>)

Les statistiques issues de MongoDB présentent le nombre de commandes par menu ainsi que le chiffre d'affaires associé.

---

## 11. Mot de passe oublié

![Mot de passe oublié](<docs/screenshots/11 Mot de passe oublié.png>)

Le système de réinitialisation permet à un utilisateur de demander un lien sécurisé afin de définir un nouveau mot de passe.

---

# Pistes d'amélioration

Bien que l'application réponde aux objectifs fixés dans le cadre de l'ECF, plusieurs évolutions pourraient être envisagées afin d'enrichir ses fonctionnalités et d'améliorer l'expérience utilisateur.

Parmi les améliorations possibles :

- intégrer un système de paiement en ligne sécurisé ;
- mettre en place des notifications par e-mail lors des changements de statut d'une commande ;
- développer une version mobile de l'application ;
- ajouter un système de fidélité et de codes promotionnels ;
- enrichir le tableau de bord statistique avec de nouveaux indicateurs ;
- permettre l'export des commandes au format PDF ;
- mettre en place une gestion des stocks des menus et des ingrédients.

Ces évolutions permettraient d'améliorer les performances de l'application et d'offrir davantage de services aux utilisateurs.

---

# Auteur

Zakia HACHEMANE

Formation Développeur Web et Web Mobile

Épreuve ECF 2026

---

# Version de l'application

La version de l'application est 1.0

---

# Licence

Ce projet a été réalisé dans le cadre de l'Évaluation en Cours de Formation (ECF) de la formation Développeur Web et Web Mobile.

Il est destiné à un usage pédagogique.

