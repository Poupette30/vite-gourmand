<h1>Création de compte</h1>
<?php if (!empty($error)): ?>
    <p class="alert"><?= Security::e($error) ?></p>
<?php endif; ?>
<form method="post" action="index.php?page=do_register">
    <?= Security::csrfField() ?>
    <label>Prénom<input name="first_name" required></label>
    <label>Nom<input name="last_name" required></label>
    <label>GSM<input name="phone" required></label>
    <label>Adresse postale<textarea name="address" required></textarea></label>
    <label>Email<input name="email" type="email" required></label>
    <label>Mot de passe<input name="password" type="password" minlength="10" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{10,}" required></label>
    <button>Créer mon compte</button>
</form>