<h1>Tous les menus</h1>
<form id="filters" class="filters">
    <label>Prix min<input name="min_price" type="number" step="0.01"></label>
    <label>Prix max<input name="max_price" type="number" step="0.01"></label>
    <label>Thème<select name="theme_id">
            <option value="">Tous</option>
            <option value="1">Noël</option>
            <option value="2">Pâques</option>
            <option value="3">Classique</option>
            <option value="4">Événement</option>
        </select></label><label>Régime<select name="diet_id">
            <option value="">Tous</option>
            <option value="1">Classique</option>
            <option value="2">Végétarien</option>
            <option value="3">Vegan</option>
        </select>
    </label>
    <label>Nb personnes<input name="min_people" type="number"></label>
</form>
<section id="menu-list" class="grid"><?php foreach ($menus as $m): ?>
        <article class="card menu-card">
            <img src="<?= Security::e($m['image_url']) ?>" alt="<?= Security::e($m['title']) ?>">
            <h2><?= Security::e($m['title']) ?>
            </h2>
            <p><?= Security::e($m['description']) ?></p>
            <p>Dès <?= (int)$m['min_people'] ?> personnes · <?= number_format($m['base_price'], 2, ',', ' ') ?> €</p>
            <a class="btn" href="index.php?page=menu&id=<?= $m['id'] ?>">Voir le détail</a>
        </article><?php endforeach; ?>
</section>
<script>
    const form = document.getElementById('filters');
    const list = document.getElementById('menu-list');

    function escapeHtml(text) {
        return String(text ?? '').replace(/[&<>"']/g, function(char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            } [char];
        });
    }

    function renderMenus(menus) {
        list.innerHTML = '';

        if (menus.length === 0) {
            list.innerHTML = '<p>Aucun menu ne correspond à votre recherche.</p>';
            return;
        }

        menus.forEach(menu => {
            const article = document.createElement('article');
            article.className = 'card menu-card';

            article.innerHTML = `
            <img src="${escapeHtml(menu.image_url)}" alt="${escapeHtml(menu.title)}">
            <h2>${escapeHtml(menu.title)}</h2>
            <p>${escapeHtml(menu.description)}</p>
            <p>Dès ${parseInt(menu.min_people)} personnes · ${parseFloat(menu.base_price).toFixed(2).replace('.', ',')} €</p>
            <a class="btn" href="index.php?page=menu&id=${parseInt(menu.id)}">Voir le détail</a>
        `;

            list.appendChild(article);
        });
    }

    async function loadMenus() {
        const params = new URLSearchParams(new FormData(form));
        const response = await fetch('index.php?page=api_menus&' + params.toString());
        const menus = await response.json();

        renderMenus(menus);
    }

    form.addEventListener('input', loadMenus);
    form.addEventListener('change', loadMenus);
</script>