# Documentation technique - Vite & Gourmand

## Choix techniques

La stack technique retenue pour le projet est la suivante :

- PHP 8 avec PDO
- HTML5
- CSS3
- JavaScript
- Bootstrap
- MySQL / MariaDB pour les données relationnelles
- MongoDB pour les statistiques administrateur

Cette architecture respecte les exigences de l'ECF, qui impose l'utilisation d'une base de données relationnelle et d'une base NoSQL.

## Sécurité
- Mots de passe hachés avec `password_hash`.
- Requêtes SQL préparées avec PDO.
- Sessions avec cookie HTTPOnly et SameSite=Lax.
- Protection CSRF sur les formulaires sensibles.
- Échappement HTML avec `htmlspecialchars`.
- Rôles : utilisateur, employé, administrateur.
- Pas de création d’administrateur depuis l’application.
- Désactivation possible des comptes employés.
- Validation côté client.
- Validation côté serveur.
- Contrôle des permissions.
- Protection contre l'injection SQL.
- Protection XSS.


## RGPD
Les données collectées servent à créer un compte, gérer les commandes et répondre aux demandes de contact. L’application limite les données collectées aux informations nécessaires : identité, email, GSM, adresse, commandes et avis.

## Accessibilité RGAA
- Balises sémantiques header/nav/main/footer.
- Lien d’évitement vers le contenu.
- Labels associés aux champs de formulaire.
- Vérification des contrastes à l'aide de Lighthouse.
- Navigation clavier prévue via éléments HTML natifs.

## Modèle de données

La base de données relationnelle repose principalement sur les entités suivantes :

- users
- menus
- dishes
- dish_allergens
- orders
- order_status_history
- reviews
- contacts

Les statistiques destinées à l'espace administrateur sont stockées dans MongoDB, notamment dans la collection `orders_by_menu`.

## Déploiement

1. Créer la base MySQL/MariaDB.
2. Importer `database/schema.sql` puis `database/seed.sql`.
3. Créer la base MongoDB et lancer `mongo/analytics.seed.js`.
4. Configurer les variables : `APP_URL`, `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`, `MONGO_URI`.
5. Pointer le serveur web vers le dossier `public`.
6. Vérifier le bon fonctionnement de l'application.
7. Tester les connexions MySQL et MongoDB.
8. Vérifier les fonctionnalités principales et les droits d'accès selon les rôles.

Après ces étapes, l'application est prête à être utilisée et testée avec les différents profils (utilisateur, employé et administrateur).

## Architecture

L'application suit une architecture MVC (Model – View – Controller).

- Models : accès aux données MySQL et MongoDB.
- Views : affichage HTML des pages.
- Controllers : traitement des requêtes et logique métier.

Cette séparation facilite la maintenance, les tests et l'évolution de l'application.

## Structure du projet

```text
app/
public/
database/
docs/
assets/
config/
```

## Environnement de développement

- Windows 11
- WampServer
- PHP 8.2
- Apache
- MariaDB
- MongoDB Community Server
- MongoDB Compass
- Visual Studio Code
- Git
- GitHub
- Figma


## Technologies utilisées


### PHP
Choisi car demandé dans la formation et parfaitement adapté au développement d'une application MVC.

### MySQL / MariaDB
Stockage des données relationnelles de l'application.

### MongoDB
Utilisé pour les statistiques afin de séparer les données métier des données analytiques.

### JavaScript
Permet les filtres dynamiques sans rechargement de page.

### CSS3

Utilisé pour créer une interface responsive personnalisée, adaptée aux différents formats d'écran grâce à une feuille de style développée spécifiquement pour le projet.

## Utilisation de MongoDB

MongoDB est utilisé uniquement pour les statistiques de l'espace administrateur.

Les données métier (utilisateurs, menus, commandes, avis...) restent stockées dans MySQL.

Les agrégats sont enregistrés dans la collection :

`orders_by_menu`

Ils permettent :

- d'afficher un graphique comparatif des commandes par menu ;
- de comparer les menus entre eux ;
- de calculer le nombre de commandes ;
- de calculer le chiffre d'affaires selon les filtres sélectionnés.









