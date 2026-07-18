<h1>Commander un menu</h1><?php if (!$menu): ?><p class="alert">Menu introuvable.</p><?php else: $u = User::find(Auth::user()['id']); ?>
    <form method="post" action="index.php?page=order_store" id="order-form"><?= Security::csrfField() ?>
        <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">
        <label>Prénom<input name="customer_first_name" value="<?= Security::e($u['first_name']) ?>" required></label>
        <label>Nom<input name="customer_last_name" value="<?= Security::e($u['last_name']) ?>" required></label>
        <label>Email<input type="email" name="customer_email" value="<?= Security::e($u['email']) ?>" required></label>
        <label>GSM<input name="customer_phone" value="<?= Security::e($u['phone']) ?>" required></label>
        <label>Adresse de prestation<textarea name="service_address" required><?= Security::e($u['address']) ?></textarea></label>
        <label>Ville<input name="service_city" value="Bordeaux" required></label><label>Date<input type="date" name="service_date" required></label>
        <label>Heure livraison<input type="time" name="delivery_time" required></label>
        <label>Distance hors Bordeaux en km<input type="number" step="0.1" name="distance_km" value="0"></label>
        <label>Nombre de personnes<input type="number" name="people_count" min="<?= $menu['min_people'] ?>" value="<?= $menu['min_people'] ?>" data-base="<?= $menu['base_price'] ?>" data-min="<?= $menu['min_people'] ?>" required></label>
        <p id="price-preview"></p><button>Valider la commande</button>
    </form><?php endif; ?>