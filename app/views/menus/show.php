<article class="detail">
    <h1><?= Security::e($menu['title']) ?></h1>

    <img src="<?= Security::e($menu['image_url']) ?>" alt="">

    <p><?= Security::e($menu['description']) ?></p>

    <p>
        <strong>Thème :</strong> <?= Security::e($menu['theme']) ?> ·
        <strong>Régime :</strong> <?= Security::e($menu['diet']) ?>
    </p>

    <p>
        <strong>Minimum :</strong> <?= (int)$menu['min_people'] ?> personnes ·
        <strong>Prix :</strong> <?= number_format($menu['base_price'], 2, ',', ' ') ?> € ·
        <strong>Stock :</strong> <?= (int)$menu['stock'] ?>
    </p>

    <aside class="warning">
        <h2>Conditions importantes</h2>
        <p><?= nl2br(Security::e($menu['conditions'])) ?></p>
    </aside>

    <h2>Plats</h2>

    <?php foreach ($menu['dishes'] as $d): ?>
        <article class="card">
            <strong>
                <?= Security::e($d['category']) ?> :
                <?= Security::e($d['name']) ?>
            </strong>

            <p><?= Security::e($d['description']) ?></p>

            <?php
            $allergens = array_filter(
                $menu['allergens'],
                fn($a) => (int)$a['dish_id'] === (int)$d['id']
            );
            ?>

            <?php if (!empty($allergens)): ?>
                <p>
                    <strong>Allergènes :</strong>
                    <?= Security::e(implode(', ', array_column($allergens, 'allergen'))) ?>
                </p>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>

    <a class="btn" href="index.php?page=order_create&menu_id=<?= (int)$menu['id'] ?>">
        Commander ce menu
    </a>
</article>