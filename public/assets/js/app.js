document.addEventListener('input', async (e) => {
  if (e.target.closest('#filters')) {
    const params = new URLSearchParams(
      new FormData(document.querySelector('#filters'))
    );

    const res = await fetch(
      'index.php?page=api_menus&' + params.toString()
    );

    const menus = await res.json();

    document.querySelector('#menu-list').innerHTML = menus.map(m => `
      <article class="card menu-card">
        <img src="${m.image_url || ''}" alt="${m.title}">
        <h2>${m.title}</h2>
        <p>${m.description}</p>
        <p>
          Dès ${m.min_people} personnes ·
          ${Number(m.base_price).toFixed(2).replace('.', ',')} €
        </p>
        <a class="btn" href="index.php?page=menu&id=${m.id}">
          Voir le détail
        </a>
      </article>
    `).join('');
  }

  if (e.target.matches('[name="people_count"], [name="distance_km"]')) {
    updatePrice();
  }
});

function updatePrice() {
  const people = document.querySelector('[name="people_count"]');

  if (!people) {
    return;
  }

  const min = Number(people.dataset.min);
  const base = Number(people.dataset.base);
  const count = Number(people.value);

  const distanceInput = document.querySelector('[name="distance_km"]');
  const km = Number(distanceInput.value || 0);

  const menu = base * (count / min);
  const disc = count >= min + 5 ? menu * 0.10 : 0;
  const del = km > 0 ? 5 + km * 0.59 : 0;
  const total = menu - disc + del;

  document.querySelector('#price-preview').textContent =
    `Menu : ${menu.toFixed(2).replace('.', ',')} € · ` +
    `Remise : ${disc.toFixed(2).replace('.', ',')} € · ` +
    `Livraison : ${del.toFixed(2).replace('.', ',')} € · ` +
    `Total : ${total.toFixed(2).replace('.', ',')} €`;
}

document.addEventListener('DOMContentLoaded', updatePrice);