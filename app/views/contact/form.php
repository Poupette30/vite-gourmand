<h1>Contact</h1>

<?php if (!empty($success)): ?>
    <p class="success">
        <?= Security::e($success) ?>
    </p>
<?php endif; ?>

<form
    class="contact-form"
    method="post"
    action="index.php?page=contact_send">
    <?= Security::csrfField() ?>

    <label>
        Nom et prénom
        <input
            type="text"
            name="title"
            required>
    </label>

    <label>
        Email
        <input
            type="email"
            name="email"
            required>
    </label>

    <label>
        Description
        <textarea
            name="message"
            required></textarea>
    </label>

    <button type="submit">Envoyer</button>
</form>