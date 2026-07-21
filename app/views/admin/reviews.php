<h1>Gestion des avis</h1>

<p>
    <a class="btn" href="index.php?page=admin">Retour au tableau de bord</a>
</p>

<?php if (empty($reviews)): ?>

    <p>Aucun avis en attente.</p>

<?php else: ?>

    <?php foreach ($reviews as $review): ?>

        <div class="card review-card">

            <p><strong>Email :</strong> <?= htmlspecialchars($review['email']) ?></p>
            <p><strong>Note :</strong> <?= (int)$review['rating'] ?>/5</p>
            <p><strong>Commentaire :</strong></p>
            <p><?= nl2br(htmlspecialchars($review['comment'])) ?></p>

            <div class="review-actions">

                <form method="post" action="index.php?page=admin_review_approve">
                    <?= Security::csrfField() ?>
                    <input type="hidden" name="id" value="<?= (int)$review['id'] ?>">
                    <button type="submit">Approuver</button>
                </form>

                <form method="post" action="index.php?page=admin_review_refuse">
                    <?= Security::csrfField() ?>
                    <input type="hidden" name="id" value="<?= (int)$review['id'] ?>">
                    <button type="submit">Refuser</button>
                </form>

            </div>

        </div>

    <?php endforeach; ?>

<?php endif; ?>