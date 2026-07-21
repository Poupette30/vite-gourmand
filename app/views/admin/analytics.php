<section class="admin-section">
    <h1>Statistiques des commandes</h1>

    <p>
        Données issues de MongoDB : collection <strong>orders_by_menu</strong>.
    </p>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            Erreur MongoDB : <?= Security::e($error) ?>
        </div>
    <?php endif; ?>

    <?php if (empty($stats)): ?>
        <p>Aucune statistique disponible.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Nombre de commandes</th>
                    <th>Chiffre d'affaires</th>
                    <th>Période</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stats as $stat): ?>
                    <tr>
                        <td><?= Security::e($stat->menu_title ?? '') ?></td>
                        <td><?= (int)($stat->orders_count ?? 0) ?></td>
                        <td><?= number_format((float)($stat->revenue ?? 0), 2, ',', ' ') ?> €</td>
                        <td><?= Security::e($stat->period ?? '') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>