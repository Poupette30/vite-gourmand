<h1>Espace employé - Gestion des commandes</h1>

<form class="filters employee-filters">
        <label>
                Statut
                <input
                        name="status"
                        value="<?= Security::e($_GET['status'] ?? '') ?>">
        </label>

        <label>
                Client
                <input
                        name="client"
                        value="<?= Security::e($_GET['client'] ?? '') ?>">
        </label>

        <button type="submit">Filtrer</button>
</form>

<?php foreach ($orders as $o): ?>
        <article class="card order-card">
                <h2>
                        <?= Security::e($o['reference']) ?>
                        -
                        <?= Security::e($o['menu_title']) ?>
                </h2>

                <p class="order-meta">
                        <?= Security::e($o['customer_email']) ?>
                        ·
                        <?= Security::e($o['service_date']) ?>
                        ·
                        <?= Security::e($o['status']) ?>
                </p>

                <form
                        class="order-action-form"
                        method="post"
                        action="index.php?page=order_status">
                        <?= Security::csrfField() ?>

                        <input
                                type="hidden"
                                name="id"
                                value="<?= (int) $o['id'] ?>">

                        <select name="status">
                                <option value="accepte">Acceptée</option>
                                <option value="en_preparation">En préparation</option>
                                <option value="en_livraison">En cours de livraison</option>
                                <option value="livre">Livrée</option>
                                <option value="attente_retour_materiel">
                                        En attente du retour de matériel
                                </option>
                                <option value="terminee">Terminée</option>
                        </select>

                        <input
                                name="note"
                                placeholder="Note interne">

                        <button type="submit">Mettre à jour</button>
                </form>

                <form
                        class="order-action-form cancellation-form"
                        method="post"
                        action="index.php?page=order_cancel">
                        <?= Security::csrfField() ?>

                        <input
                                type="hidden"
                                name="id"
                                value="<?= (int) $o['id'] ?>">

                        <select name="contact_mode">
                                <option value="appel GSM">Appel GSM</option>
                                <option value="mail">E-mail</option>
                        </select>

                        <input
                                name="reason"
                                placeholder="Motif d’annulation"
                                required>

                        <button type="submit">Annuler après contact</button>
                </form>
        </article>
<?php endforeach; ?>