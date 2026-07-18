<?php $u = Auth::user(); ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Vite & Gourmand</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script defer src="assets/js/app.js"></script>
</head>

<body>
    <a class="skip" href="#contenu">Aller au contenu</a>
    <header class="site-header">
        <a class="brand" href="index.php" aria-label="Accueil - Vite & Gourmand">
            <img src="assets/img/logo.png" alt="Logo Vite & Gourmand" class="brand-logo">
            <span>Vite & Gourmand</span>
        </a>
        <nav aria-label="Menu principal"><a href="index.php">Accueil</a>
            <a href="index.php?page=menus">Menus</a>
            <a href="index.php?page=contact">Contact</a>
            <?php if ($u): ?>
                <a href="index.php?page=dashboard">Mon espace</a>
                <?php if (in_array($u['role'], ['employe', 'administrateur'])): ?>
                    <a href="index.php?page=employee_orders">Employé</a>
                    <?php endif; ?><?php if ($u['role'] === 'administrateur'): ?>
                    <a href="index.php?page=admin">Admin</a><?php endif; ?>
                <a href="index.php?page=logout">Déconnexion</a><?php else: ?>
                <a href="index.php?page=login">Connexion</a><?php endif; ?>
        </nav>
    </header>
    <main id="contenu" class="container">