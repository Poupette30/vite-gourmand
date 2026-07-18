# Installation du projet

## Introduction

Ce document décrit les étapes nécessaires pour installer et exécuter le projet **Vite & Gourmand** sur un environnement de développement local.

Le projet repose sur une architecture PHP MVC utilisant une base de données MySQL et une base de données MongoDB.

---

# Prérequis

Avant de lancer le projet, les logiciels suivants doivent être installés :

* WampServer
* PHP 8.2 ou version compatible
* MySQL
* MongoDB Community Server
* MongoDB Compass
* Visual Studio Code
* Un navigateur web récent (Google Chrome, Microsoft Edge, Mozilla Firefox…)

---

# Installation du projet

## 1. Copier le projet

Copier le dossier **vite-gourmand** dans le répertoire :

```text
C:\wamp64\www\
```

---

## 2. Démarrer WampServer

Lancer WampServer.

Vérifier que les services suivants sont démarrés :

* Apache
* MySQL

L'icône WampServer doit être verte.

---

## 3. Créer la base MySQL

Ouvrir **phpMyAdmin**.

Créer une nouvelle base de données nommée :

```text
vite_gourmand
```

---

## 4. Importer la base de données

Importer le fichier :

```text
database/schema.sql
```

Puis importer les données de démonstration :

```text
database/seed.sql
```

Les tables et les données nécessaires seront alors créées automatiquement.

---

## 5. Configurer la connexion MySQL

Vérifier les paramètres de connexion dans le fichier :

```text
config/config.php
```

Les informations suivantes doivent être adaptées si nécessaire :

* nom de la base de données ;
* utilisateur MySQL ;
* mot de passe ;
* serveur.

---

# Installation de MongoDB

## 1. Démarrer MongoDB

Vérifier que le service MongoDB est démarré.

---

## 2. Importer les statistiques

Exécuter le script :

```text
mongo/analytics.seed.js
```

Ce script crée automatiquement :

* la base **vite_gourmand_stats** ;
* la collection **orders_by_menu** ;
* les données statistiques utilisées dans l'espace administrateur.

---

## 3. Vérifier MongoDB Compass

Ouvrir MongoDB Compass.

Contrôler la présence de :

```text
vite_gourmand_stats
```

Puis vérifier que la collection :

```text
orders_by_menu
```

contient bien les données attendues.

---

# Lancement du projet

Une fois les installations terminées, ouvrir le navigateur et accéder à l'adresse :

```text
http://localhost/vite-gourmand/public/
```

La page d'accueil de **Vite & Gourmand** doit s'afficher.

---

# Comptes de démonstration

Le projet contient plusieurs profils permettant de tester les différentes fonctionnalités.

Les rôles disponibles sont :

* Utilisateur
* Employé
* Administrateur

Les comptes peuvent être créés directement depuis l'application ou être présents dans les données de démonstration importées avec le fichier `seed.sql`.

---

# Structure générale du projet

```text
vite-gourmand/
│
├── app/
│   ├── controllers/
│   ├── core/
│   ├── models/
│   └── views/
│
├── config/
├── database/
├── docs/
├── mongo/
├── public/
└── tests/
```

---

# Vérifications

Avant de commencer les tests, vérifier que :

* Apache est démarré ;
* MySQL est démarré ;
* MongoDB est démarré ;
* la base MySQL est correctement importée ;
* les statistiques MongoDB sont présentes ;
* les fichiers de configuration sont correctement renseignés.

---

# Fonctionnement attendu

Une fois l'installation terminée, il est possible :

* de créer un compte utilisateur ;
* de se connecter ;
* de consulter les menus ;
* de passer une commande ;
* de suivre les commandes ;
* de déposer un avis ;
* d'accéder aux espaces Employé et Administrateur selon les droits attribués ;
* de consulter les statistiques commerciales.

---

# Conclusion

L'installation de **Vite & Gourmand** nécessite la mise en place d'un environnement PHP avec WampServer, d'une base de données MySQL et d'une base MongoDB. Une fois ces éléments configurés, l'application est immédiatement opérationnelle et permet de tester l'ensemble des fonctionnalités développées dans le cadre de l'ECF.
