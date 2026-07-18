<h1>Mes commandes</h1>
<?php foreach ($orders as $o): ?><article class="card">
        <h2><?= Security::e($o['reference']) ?> - <?= Security::e($o['menu_title']) ?></h2>
        <p>Statut : <?= Security::e($o['status']) ?> · Total : <?= number_format($o['total'], 2, ',', ' ') ?> €</p><?php if ($o['status'] === 'terminee'): ?>
            <form method="post" action="index.php?page=review_store">

                <?= Security::csrfField() ?>

                <input type="hidden"
                    name="order_id"
                    value="<?= (int)$o['id'] ?>">

                <label>
                    Note
                    <input type="number"
                        min="1"
                        max="5"
                        name="rating"
                        required>
                </label>

                <label>
                    Avis
                    <textarea name="comment"
                        required></textarea>
                </label>

                <button type="submit">
                    Envoyer mon avis
                </button>

            </form><?php endif; ?>
    </article><?php endforeach; ?>