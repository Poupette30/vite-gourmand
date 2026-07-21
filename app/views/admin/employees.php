<h1>Gestion des employés</h1>
<form class="employee-form" method="post" action="index.php?page=admin_create_employee"><?= Security::csrfField() ?>
    <label>Email<input type="email" name="email" required></label>
    <label>Prénom<input name="first_name" value="Employé" required></label>
    <label>Nom<input name="last_name" value="Vite Gourmand" required></label>
    <label>GSM<input name="phone" value="0000000000" required></label>
    <label>Adresse<input name="address" value="Bordeaux" required></label>
    <label>Mot de passe<input name="password" type="password" required></label>
    <button>Créer employé</button>
</form><?php foreach ($employees as $e): ?><article class="card"><strong><?= Security::e($e['email']) ?></strong> actif: <?= $e['is_active'] ? 'oui' : 'non' ?>
        <form method="post" action="index.php?page=admin_employee_disable"><?= Security::csrfField() ?><input type="hidden" name="id" value="<?= $e['id'] ?>">
            <button>Désactiver</button>
        </form>
    </article><?php endforeach; ?>