# Présentation du projet – Vite & Gourmand

## 1. Contexte

**Vite & Gourmand** est une application web développée dans le cadre de l'Épreuve de Contrôle en Cours de Formation (ECF) de la formation Développeur Web et Web Mobile.

L'objectif du projet est de concevoir une plateforme permettant aux utilisateurs de découvrir des menus gastronomiques, de passer des commandes en ligne et d'assurer le suivi de celles-ci. L'application propose également un espace d'administration permettant la gestion des utilisateurs, des employés, des commandes, des avis clients ainsi que des statistiques.

---

## 2. Objectifs du projet

Le projet répond aux objectifs suivants :

* développer une application web dynamique en PHP ;
* mettre en œuvre une architecture MVC ;
* manipuler une base de données relationnelle MySQL ;
* exploiter une base de données NoSQL MongoDB pour les statistiques ;
* sécuriser les accès grâce à une authentification et à une gestion des rôles ;
* proposer une interface ergonomique, responsive et accessible.

---

## 3. Public concerné

L'application s'adresse à trois catégories d'utilisateurs :

### Utilisateur

L'utilisateur peut :

* créer un compte ;
* se connecter ;
* consulter les menus disponibles ;
* filtrer les menus selon différents critères ;
* commander un menu ;
* consulter l'historique de ses commandes ;
* laisser un avis après une commande terminée.

### Employé

L'employé dispose d'un espace dédié lui permettant :

* de consulter les commandes ;
* de modifier leur état d'avancement.

### Administrateur

L'administrateur possède l'ensemble des droits de gestion :

* gestion des employés ;
* activation ou désactivation des comptes employés ;
* modération des avis clients ;
* consultation des statistiques issues de MongoDB.

---

## 4. Technologies utilisées

### Front-end

* HTML5
* CSS3
* JavaScript

### Back-end

* PHP 8.2

### Bases de données

* MySQL
* MongoDB

### Serveur de développement

* WampServer

### Outils

* Visual Studio Code
* phpMyAdmin
* MongoDB Compass
* Git
* GitHub

---

## 5. Fonctionnalités principales

L'application propose notamment :

* authentification des utilisateurs ;
* gestion des rôles (utilisateur, employé, administrateur) ;
* catalogue de menus ;
* recherche et filtrage des menus ;
* consultation détaillée d'un menu ;
* création de commandes ;
* historique des commandes ;
* suivi de l'état des commandes ;
* dépôt et modération des avis ;
* formulaire de contact ;
* tableau de bord administrateur ;
* statistiques commerciales alimentées par MongoDB.

---

## 6. Architecture

Le projet est développé selon une architecture **MVC (Modèle – Vue – Contrôleur)** afin de séparer les différentes responsabilités de l'application :

* **Modèles** : accès aux données ;
* **Vues** : affichage des pages ;
* **Contrôleurs** : traitement des requêtes et logique métier.

Cette organisation facilite la maintenance, l'évolution et la lisibilité du code.

---

## 7. Conclusion

Le projet **Vite & Gourmand** met en œuvre les principales compétences attendues d'un développeur web full stack débutant. Il combine la création d'interfaces utilisateur, le développement d'une logique métier en PHP, l'utilisation de bases de données relationnelles et NoSQL ainsi que la mise en place de mécanismes de sécurité et d'administration.

Ce projet constitue une application complète permettant de démontrer les compétences acquises durant la formation.
