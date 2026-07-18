document.addEventListener('input', async (e) => {
  if (e.target.closest('#filters')) {
    const params = new URLSearchParams(new FormData(document.querySelector('#filters')));
    const res = await fetch('/?page=api_menus&' + params.toString()); const menus = await res.json();
    document.querySelector('#menu-list').innerHTML = menus.map(m => `<article class="card menu-card"><img src="${m.image_url || ''}" alt=""><h2>${m.title}</h2><p>${m.description}</p><p>Dès ${m.min_people} personnes · ${Number(m.base_price).toFixed(2)} €</p><a class="btn" href="index.php?page=menu&id=${m.id}">Voir le détail</a></article>`).join('');
  }
  if (e.target.matches('[name="people_count"], [name="distance_km"]')) updatePrice();
});
function updatePrice() { const people = document.querySelector('[name="people_count"]'); if (!people) return; const min = +people.dataset.min, base = +people.dataset.base, count = +people.value, km = +(document.querySelector('[name="distance_km"]').value || 0); let menu = base * (count / min), disc = count >= min + 5 ? menu * .10 : 0, del = km > 0 ? 5 + km * .59 : 0; document.querySelector('#price-preview').textContent = `Menu: ${menu.toFixed(2)} € · Remise: ${disc.toFixed(2)} € · Livraison: ${del.toFixed(2)} € · Total: ${(menu - disc + del).toFixed(2)} €`; }
document.addEventListener('DOMContentLoaded', updatePrice);
