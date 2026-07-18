<h1>Connexion</h1>
<?php if (!empty($error)): ?><p class="alert"><?= Security::e($error) ?></p><?php endif; ?>
<form method="post" action="index.php?page=do_login"><?= Security::csrfField() ?>
    <label>Email<input name="email" type="email" required autocomplete="email"></label>
    <label>Mot de passe<input name="password" type="password" required autocomplete="current-password"></label>
    <button>Se connecter</button>
    <p><a href="index.php?page=register">Créer un compte</a> ·
        <a href="index.php?page=forgot_password">Mot de passe oublié</a>
    </p>
</form>