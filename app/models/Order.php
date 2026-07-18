<?php
final class Order
{
    public const STATUSES=['recue','accepte','en_preparation','en_livraison','livre','attente_retour_materiel','terminee','annulee'];
    public static function price(float $basePrice, int $minPeople, int $people, float $km=0): array
    {
        if ($people < $minPeople) throw new InvalidArgumentException('Nombre de personnes inférieur au minimum.');
        $menuTotal = $basePrice * ($people / $minPeople);
        $discount = ($people >= $minPeople + 5) ? $menuTotal * 0.10 : 0;
        $delivery = $km > 0 ? 5 + (0.59 * $km) : 0;
        return ['menu_total'=>$menuTotal, 'discount'=>$discount, 'delivery'=>$delivery, 'total'=>$menuTotal - $discount + $delivery];
    }
    public static function create(array $d): int
    {
        $ref='VG-'.date('Ymd').'-'.strtoupper(bin2hex(random_bytes(3)));
        $s=Database::pdo()->prepare('INSERT INTO orders(reference,user_id,menu_id,customer_first_name,customer_last_name,customer_email,customer_phone,service_address,service_city,service_date,delivery_time,people_count,distance_km,menu_total,discount,delivery_fee,total,status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $s->execute([$ref,$d['user_id'],$d['menu_id'],$d['customer_first_name'],$d['customer_last_name'],$d['customer_email'],$d['customer_phone'],$d['service_address'],$d['service_city'],$d['service_date'],$d['delivery_time'],$d['people_count'],$d['distance_km'],$d['menu_total'],$d['discount'],$d['delivery_fee'],$d['total'],'recue']);
        $id=(int)Database::pdo()->lastInsertId(); self::history($id,'recue','Commande reçue'); return $id;
    }
    public static function byUser(int $userId): array { $s=Database::pdo()->prepare('SELECT o.*, m.title menu_title FROM orders o JOIN menus m ON m.id=o.menu_id WHERE o.user_id=? ORDER BY o.created_at DESC'); $s->execute([$userId]); return $s->fetchAll(); }
    public static function search(?string $status=null, ?string $client=null): array { $where=[];$p=[]; if($status){$where[]='o.status=?';$p[]=$status;} if($client){$where[]='(o.customer_email LIKE ? OR o.customer_last_name LIKE ?)';$p[]="%$client%";$p[]="%$client%";} $sql='SELECT o.*,m.title menu_title FROM orders o JOIN menus m ON m.id=o.menu_id'.($where?' WHERE '.implode(' AND ',$where):'').' ORDER BY o.service_date ASC'; $s=Database::pdo()->prepare($sql); $s->execute($p); return $s->fetchAll(); }
    public static function updateStatus(int $id, string $status, string $note=''): void { if(!in_array($status,self::STATUSES,true)) throw new InvalidArgumentException('Statut invalide'); $s=Database::pdo()->prepare('UPDATE orders SET status=? WHERE id=?'); $s->execute([$status,$id]); self::history($id,$status,$note); }
    public static function cancel(int $id, string $contactMode, string $reason): void { $s=Database::pdo()->prepare('UPDATE orders SET status="annulee", cancel_contact_mode=?, cancel_reason=? WHERE id=?'); $s->execute([$contactMode,$reason,$id]); self::history($id,'annulee',"$contactMode : $reason"); }
    public static function history(int $id, string $status, string $note=''): void { $s=Database::pdo()->prepare('INSERT INTO order_status_history(order_id,status,note) VALUES(?,?,?)'); $s->execute([$id,$status,$note]); }
}
