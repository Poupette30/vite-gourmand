INSERT INTO themes(label) VALUES ('Noël'),('Pâques'),('Classique'),('Événement'); 
INSERT INTO diets(label) VALUES ('Classique'),('Végétarien'),('Vegan'),('Sans gluten'); 
INSERT INTO dish_categories(label) VALUES ('Entrée'),('Plat'),('Dessert');
INSERT INTO users(first_name,last_name,email,phone,address,password_hash,role) VALUES ('José','Admin','jose@vite-gourmand.local','0600000000','Bordeaux','$2y$10$wH8EvTsV.2liAChig2y0tOqny7DzyhcS7ZHwnOWQaoH.GIXC/L9tG','administrateur'),('Julie','Employée','julie@vite-gourmand.local','0600000001','Bordeaux','$2y$10$wH8EvTsV.2liAChig2y0tOqny7DzyhcS7ZHwnOWQaoH.GIXC/L9tG','employe'),('Client','Demo','client@example.com','0600000002','10 rue Sainte-Catherine, Bordeaux','$2y$10$wH8EvTsV.2liAChig2y0tOqny7DzyhcS7ZHwnOWQaoH.GIXC/L9tG','utilisateur');
INSERT INTO dishes(category_id,name,description) VALUES (1,'Velouté de potimarron','Entrée chaude de saison'),(2,'Suprême de volaille sauce morilles','Plat traiteur classique'),(3,'Bûche chocolat noisette','Dessert de fête'),(1,'Salade printanière','Entrée fraîche'),(2,'Risotto aux légumes','Plat végétarien'),(3,'Tarte aux fruits','Dessert léger');
INSERT INTO dish_allergens(dish_id,allergen) VALUES (2,'lait'),(2,'sulfites'),(3,'fruits à coque'),(3,'gluten'),(5,'lait');
INSERT INTO menus(title,description,conditions,theme_id,diet_id,min_people,base_price,stock,image_url) VALUES ('Menu Noël Gourmand','Menu festif complet pour repas de Noël.','Commande au minimum 14 jours avant. Conservation au frais entre 0 et 4 °C.',1,1,10,350.00,5,'/assets/img/menu-noel.jpg'),('Menu Printemps Végétarien','Menu frais adapté aux événements de printemps.','Commande au minimum 7 jours avant. Livraison à confirmer selon disponibilité.',2,2,8,240.00,8,'/assets/img/menu-printemps.jpg'),('Menu Classique Bordeaux','Prestation classique pour repas familial ou professionnel.','Commande au minimum 5 jours avant.',3,1,6,180.00,12,'/assets/img/menu-classique.jpg');
INSERT INTO menu_dishes VALUES (1,1),(1,2),(1,3),(2,4),(2,5),(2,6),(3,1),(3,2),(3,6);
INSERT INTO orders(
    reference,
    user_id,
    menu_id,
    customer_first_name,
    customer_last_name,
    customer_email,
    customer_phone,
    service_address,
    service_city,
    service_date,
    delivery_time,
    people_count,
    distance_km,
    menu_total,
    discount,
    delivery_fee,
    total,
    status
)
VALUES (
    'VG-DEMO-001',
    (SELECT id FROM users WHERE email = 'client@example.com'),
    (SELECT id FROM menus WHERE title = 'Menu Noël Gourmand'),
    'Client',
    'Demo',
    'client@example.com',
    '0600000002',
    '10 rue Sainte-Catherine',
    'Bordeaux',
    '2026-12-20',
    '12:00',
    15,
    0,
    525,
    52.5,
    0,
    472.5,
    'terminee'
);

INSERT INTO reviews(
    order_id,
    user_id,
    rating,
    comment,
    status
)
VALUES (
    (SELECT id FROM orders WHERE reference = 'VG-DEMO-001'),
    (SELECT id FROM users WHERE email = 'client@example.com'),
    5,
    'Très belle prestation et livraison ponctuelle.',
    'approved'
);