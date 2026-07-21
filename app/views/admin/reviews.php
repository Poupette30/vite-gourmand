<h1>Gestion des avis</h1>

<p>
    <a href="index.php?page=admin">Retour au tableau de bord</a>
</p>

<?php if (empty($reviews)): ?>
    <p>Aucun avis en attente.</p>
<?php else: ?>
    <?php foreach ($reviews as $review): ?>
        <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">
            <p><strong>Email :</strong> <?= htmlspecialchars($review['email']) ?></p>
            <p><strong>Note :</strong> <?= (int)$review['rating'] ?>/5</p>
            <p><strong>Commentaire :</strong></p>
            <p><?= nl2br(htmlspecialchars($review['comment'])) ?></p>

            <form method="post" action="index.php?page=admin_review_approve" style="display:inline;">
                <?= Security::csrfField() ?>
                <input type="hidden" name="id" value="<?= (int)$review['id'] ?>">
                <button type="submit">Approuver</button>
            </form>

            <form method="post" action="index.php?page=admin_review_refuse" style="display:inline;">
                <?= Security::csrfField() ?>
                <input type="hidden" name="id" value="<?= (int)$review['id'] ?>">
                <button type="submit">Refuser</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>