<?php
final class Review
{
    public static function create(int $orderId, int $userId, int $rating, string $comment): void
    {
        if ($rating < 1 || $rating > 5) throw new InvalidArgumentException('Note invalide');
        $s = Database::pdo()->prepare('INSERT INTO reviews(order_id,user_id,rating,comment,status) VALUES(?,?,?,?,"pending")');
        $s->execute([$orderId, $userId, $rating, $comment]);
    }
    public static function pending(): array
    {
        return Database::pdo()->query('SELECT r.*,u.email FROM reviews r JOIN users u ON u.id=r.user_id WHERE r.status="pending" ORDER BY r.created_at DESC')->fetchAll();
    }
    public static function approved(): array
    {
        return Database::pdo()->query('SELECT r.*,u.first_name FROM reviews r JOIN users u ON u.id=r.user_id WHERE r.status="approved" ORDER BY r.created_at DESC LIMIT 6')->fetchAll();
    }
    public static function moderate(int $id, string $status): void
    {
        $s = Database::pdo()->prepare('UPDATE reviews SET status=? WHERE id=?');
        $s->execute([$status, $id]);
    }
}
