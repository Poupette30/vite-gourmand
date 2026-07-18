<h1>Espace employé - commandes</h1>
<form class="filters"><label>Statut<input name="status" value="<?= Security::e($_GET['status'] ?? '') ?>"></label>
        <label>Client<input name="client" value="<?= Security::e($_GET['client'] ?? '') ?>"></label>
        <button>Filtrer</button>
</form><?php foreach ($orders as $o): ?>
        <article class="card">
                <h2><?= Security::e($o['reference']) ?> - <?= Security::e($o['menu_title']) ?></h2>
                <p><?= Security::e($o['customer_email']) ?> · <?= Security::e($o['service_date']) ?> · <?= Security::e($o['status']) ?></p>
                <form method="post" action="index.php?page=order_status"><?= Security::csrfField() ?><input type="hidden" name="id" value="<?= $o['id'] ?>">
                        <select name="status">
                                <option value="accepte">accepté</option>
                                <option value="en_preparation">en préparation</option>
                                <option value="en_livraison">en cours de livraison</option>
                                <option value="livre">livré</option>
                                <option value="attente_retour_materiel">en attente du retour de matériel</option>
                                <option value="terminee">terminée</option>
                        </select><input name="note" placeholder="Note interne"><button>Mettre à jour</button>
                </form>
                <form method="post" action="index.php?page=order_cancel"><?= Security::csrfField() ?>
                        <input type="hidden" name="id" value="<?= $o['id'] ?>">
                        <select name="contact_mode">
                                <option>appel GSM</option>
                                <option>mail</option>
                        </select><input name="reason" placeholder="Motif d’annulation" required><button>Annuler après contact</button>
                </form>
        </article><?php endforeach; ?>