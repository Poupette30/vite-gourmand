<section class="hero">
    <div>
        <h1>Traiteur événementiel à Bordeaux depuis 25 ans</h1>
        <p>Julie et José accompagnent vos repas de famille, événements professionnels, Noël, Pâques et prestations sur mesure.</p>
        <a class="btn" href="index.php?page=menus">Voir les menus</a>
    </div>
</section>

<section class="section">
    <h2>Notre professionnalisme</h2>
    <p>Menus évolutifs, commande suivie, conditions visibles, gestion des allergènes et communication par mail à chaque étape importante.</p>
</section>

<section class="section">
    <h2>Avis clients validés</h2>

    <?php foreach (($reviews ?? []) as $r): ?>
        <article class="card">
            <strong><?= Security::e($r['first_name']) ?> — <?= (int)$r['rating'] ?>/5</strong>
            <p><?= Security::e($r['comment']) ?></p>
        </article>
    <?php endforeach; ?>
</section>