<?php
final class Menu
{
    public static function all(array $filters=[]): array
    {
        $where=['m.is_active=1']; $params=[];
        if (!empty($filters['theme_id'])) {$where[]='m.theme_id=?'; $params[]=$filters['theme_id'];}
        if (!empty($filters['diet_id'])) {$where[]='m.diet_id=?'; $params[]=$filters['diet_id'];}
        if (!empty($filters['max_price'])) {$where[]='m.base_price<=?'; $params[]=$filters['max_price'];}
        if (!empty($filters['min_price'])) {$where[]='m.base_price>=?'; $params[]=$filters['min_price'];}
        if (!empty($filters['min_people'])) {$where[]='m.min_people<=?'; $params[]=$filters['min_people'];}
        $sql='SELECT m.*, t.label theme, d.label diet FROM menus m JOIN themes t ON t.id=m.theme_id JOIN diets d ON d.id=m.diet_id WHERE '.implode(' AND ',$where).' ORDER BY m.created_at DESC';
        $s=Database::pdo()->prepare($sql); $s->execute($params); return $s->fetchAll();
    }
    public static function find(int $id): ?array
    {
        $s=Database::pdo()->prepare('SELECT m.*, t.label theme, d.label diet FROM menus m JOIN themes t ON t.id=m.theme_id JOIN diets d ON d.id=m.diet_id WHERE m.id=?'); $s->execute([$id]);
        $menu=$s->fetch(); if(!$menu) return null;
        $p=Database::pdo()->prepare('SELECT d.*, c.label category FROM dishes d JOIN dish_categories c ON c.id=d.category_id JOIN menu_dishes md ON md.dish_id=d.id WHERE md.menu_id=? ORDER BY c.id'); $p->execute([$id]); $menu['dishes']=$p->fetchAll();
        $a=Database::pdo()->prepare('SELECT dish_id, allergen FROM dish_allergens WHERE dish_id IN (SELECT dish_id FROM menu_dishes WHERE menu_id=?)'); $a->execute([$id]); $menu['allergens']=$a->fetchAll();
        return $menu;
    }
    public static function create(array $d): int { $s=Database::pdo()->prepare('INSERT INTO menus(title,description,conditions,theme_id,diet_id,min_people,base_price,stock,image_url,is_active) VALUES(?,?,?,?,?,?,?,?,?,1)'); $s->execute([$d['title'],$d['description'],$d['conditions'],$d['theme_id'],$d['diet_id'],$d['min_people'],$d['base_price'],$d['stock'],$d['image_url']]); return (int)Database::pdo()->lastInsertId(); }
    public static function update(int $id, array $d): void { $s=Database::pdo()->prepare('UPDATE menus SET title=?,description=?,conditions=?,theme_id=?,diet_id=?,min_people=?,base_price=?,stock=?,image_url=? WHERE id=?'); $s->execute([$d['title'],$d['description'],$d['conditions'],$d['theme_id'],$d['diet_id'],$d['min_people'],$d['base_price'],$d['stock'],$d['image_url'],$id]); }
    public static function delete(int $id): void { $s=Database::pdo()->prepare('UPDATE menus SET is_active=0 WHERE id=?'); $s->execute([$id]); }
}
