<h1>Contact</h1><?php if (!empty($success)): ?><p class="success"><?= Security::e($success) ?></p>
<?php endif; ?>
<form method="post" action="index.php?page=contact_send"><?= Security::csrfField() ?>
    <label>Nom et prénom<input name="title" required></label>
    <label>Email<input type="email" name="email" required></label>
    <label>Description<textarea name="message" required></textarea></label><button>Envoyer</button>
</form>