# Sécurité de l'application

## Introduction

La sécurité constitue un aspect essentiel du développement de l'application **Vite & Gourmand**. Plusieurs mécanismes ont été mis en place afin de protéger les données des utilisateurs, de limiter les accès non autorisés et de garantir le bon fonctionnement de l'application.

---

# Authentification des utilisateurs

L'application permet aux utilisateurs de créer un compte personnel et de s'authentifier de manière sécurisée.

Les fonctionnalités disponibles sont :

* inscription d'un nouvel utilisateur ;
* connexion à l'application ;
* déconnexion ;
* récupération d'un mot de passe oublié ;
* réinitialisation du mot de passe grâce à un lien sécurisé.

Les mots de passe ne sont jamais enregistrés en clair dans la base de données.

---

# Hachage des mots de passe

Les mots de passe sont protégés grâce aux fonctions de hachage natives de PHP.

Avant leur enregistrement en base de données :

* le mot de passe est haché ;
* seule son empreinte cryptographique est conservée.

Lors de la connexion, le mot de passe saisi est comparé à cette empreinte afin de vérifier son authenticité.

Cette méthode protège les comptes des utilisateurs en cas d'accès non autorisé à la base de données.

---

# Gestion des rôles

Trois niveaux d'autorisation sont utilisés dans l'application :

* Utilisateur
* Employé
* Administrateur

Chaque rôle dispose uniquement des fonctionnalités qui lui sont destinées.

Les contrôleurs vérifient les droits avant d'autoriser l'accès aux pages protégées.

---

# Protection des pages

Les espaces réservés aux utilisateurs authentifiés ne sont pas accessibles aux visiteurs non connectés.

Les espaces employés et administrateurs sont protégés par un contrôle des rôles.

Toute tentative d'accès non autorisée est refusée.

---

# Protection CSRF

Les formulaires sensibles utilisent une protection contre les attaques **Cross-Site Request Forgery (CSRF)**.

Un jeton de sécurité est généré pour chaque formulaire.

Lors de la soumission, ce jeton est vérifié avant d'exécuter le traitement demandé.

Cette protection empêche un site tiers d'envoyer des requêtes à la place d'un utilisateur connecté.

---

# Validation des données

Les informations saisies par les utilisateurs sont systématiquement contrôlées avant leur traitement.

Les vérifications portent notamment sur :

* les champs obligatoires ;
* le format des adresses électroniques ;
* la validité des mots de passe ;
* les valeurs numériques ;
* les données envoyées par les formulaires.

Ces contrôles permettent de limiter les erreurs de saisie et de renforcer la sécurité de l'application.

---

# Protection contre les injections

Les échanges avec la base de données sont réalisés à l'aide de requêtes préparées (requêtes paramétrées).

Cette méthode permet de protéger efficacement l'application contre les attaques de type **injection SQL**.

---

# Gestion des sessions

Après la connexion, une session sécurisée est créée.

La session permet :

* d'identifier l'utilisateur connecté ;
* de mémoriser son rôle ;
* de contrôler ses autorisations pendant toute la durée de sa navigation.

La session est détruite lors de la déconnexion.

---

# Réinitialisation du mot de passe

L'application propose une fonctionnalité de récupération du mot de passe.

Le processus est le suivant :

1. l'utilisateur saisit son adresse électronique ;
2. un jeton unique est généré ;
3. une date d'expiration est enregistrée ;
4. un lien de réinitialisation est envoyé ;
5. le nouveau mot de passe est enregistré après vérification du jeton.

Ce mécanisme empêche la réutilisation d'anciens liens de réinitialisation.

---

# Gestion des avis

Les avis publiés par les utilisateurs ne sont pas affichés immédiatement.

Chaque avis est placé en attente de validation.

L'administrateur décide ensuite de :

* publier l'avis ;
* refuser l'avis.

Cette modération permet de garantir la qualité des contenus affichés sur le site.

---

# Sécurisation des accès administratifs

Les fonctionnalités d'administration sont strictement réservées aux comptes possédant le rôle **Administrateur**.

Ces fonctionnalités comprennent notamment :

* la gestion des employés ;
* la modération des avis ;
* la consultation des statistiques ;
* la gestion des commandes.

---

# Bonnes pratiques mises en œuvre

Le développement de l'application respecte plusieurs bonnes pratiques :

* séparation des responsabilités grâce à l'architecture MVC ;
* utilisation de requêtes préparées ;
* hachage des mots de passe ;
* protection CSRF ;
* contrôle des rôles ;
* validation des données saisies ;
* limitation des accès aux pages sensibles.

---

# Conclusion

La sécurité de **Vite & Gourmand** repose sur plusieurs mécanismes complémentaires permettant de protéger les données des utilisateurs, de limiter les risques d'attaques et de garantir un fonctionnement fiable de l'application. Les mesures mises en œuvre répondent aux bonnes pratiques couramment utilisées dans le développement d'applications web modernes.
