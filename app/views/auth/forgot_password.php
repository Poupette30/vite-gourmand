<h1>Mot de passe oublié</h1>

<p>Entrez votre adresse email. Si un compte existe, un lien de réinitialisation sera généré.</p>

<?php if (!empty($success)): ?>
    <p class="success"><?= Security::e($success) ?></p>
<?php endif; ?>

<?php if (!empty($resetLink)): ?>
    <p>
        <strong>Lien de réinitialisation :</strong><br>
        <a href="<?= Security::e($resetLink) ?>">
            <?= Security::e($resetLink) ?>
        </a>
    </p>
<?php endif; ?>

<form method="post" action="index.php?page=send_reset_link">
    <?= Security::csrfField() ?>

    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email" required>

    <button type="submit">Envoyer le lien</button>
</form>

<a href="index.php?page=login">Retour à la connexion</a>