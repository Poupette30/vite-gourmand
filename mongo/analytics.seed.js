use vite_gourmand_stats;
db.orders_by_menu.drop();
db.orders_by_menu.insertMany([
  { menu_id: 1, menu_title: 'Menu Noël Gourmand', orders_count: 18, revenue: 8500, period: '2026' },
  { menu_id: 2, menu_title: 'Menu Printemps Végétarien', orders_count: 9, revenue: 2700, period: '2026' },
  { menu_id: 3, menu_title: 'Menu Classique Bordeaux', orders_count: 24, revenue: 6200, period: '2026' }

]);
db.orders_by_menu.createIndex({ menu_id: 1, period: 1 });
