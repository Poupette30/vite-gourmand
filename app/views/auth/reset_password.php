<h1>Réinitialiser le mot de passe</h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= Security::e($error) ?></p>
<?php endif; ?>

<?php if (!empty($token)): ?>
    <form method="post" action="index.php?page=update_password">
        <?= Security::csrfField() ?>

        <input type="hidden" name="token" value="<?= Security::e($token) ?>">

        <label for="password">Nouveau mot de passe</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirm">Confirmer le mot de passe</label>
        <input type="password" name="password_confirm" id="password_confirm" required>

        <button type="submit">Modifier le mot de passe</button>
    </form>
<?php endif; ?>

<a href="index.php?page=login">Retour à la connexion</a>