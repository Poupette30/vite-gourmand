<?php

final class User
{
    public static function create(array $data, string $role = 'utilisateur'): int
    {
        $config = require __DIR__ . '/../config/config.php';

        if (!preg_match($config['security']['password_regex'], $data['password'])) {
            throw new InvalidArgumentException('Mot de passe trop faible.');
        }

        $stmt = Database::pdo()->prepare(
            'INSERT INTO users(first_name,last_name,email,phone,address,password_hash,role,is_active)
             VALUES(?,?,?,?,?,?,?,1)'
        );

        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $data['address'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $role
        ]);

        return (int) Database::pdo()->lastInsertId();
    }

    public static function findByEmail(string $email): ?array
    {
        $s = Database::pdo()->prepare('SELECT * FROM users WHERE email = ? AND is_active = 1');
        $s->execute([$email]);
        return $s->fetch() ?: null;
    }

    public static function find(int $id): ?array
    {
        $s = Database::pdo()->prepare('SELECT * FROM users WHERE id = ?');
        $s->execute([$id]);
        return $s->fetch() ?: null;
    }

    public static function allEmployees(): array
    {
        return Database::pdo()
            ->query("SELECT id,first_name,last_name,email,is_active FROM users WHERE role='employe' ORDER BY id DESC")
            ->fetchAll();
    }

    public static function disableEmployee(int $id): void
    {
        $s = Database::pdo()->prepare("UPDATE users SET is_active = 0 WHERE id = ? AND role = 'employe'");
        $s->execute([$id]);
    }

    public static function updateProfile(int $id, array $data): void
    {
        $s = Database::pdo()->prepare(
            'UPDATE users SET first_name = ?, last_name = ?, phone = ?, address = ? WHERE id = ?'
        );

        $s->execute([
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            $data['address'],
            $id
        ]);
    }

    public static function saveResetToken(int $id, string $token, string $expires): void
    {
        $s = Database::pdo()->prepare(
            'UPDATE users 
         SET reset_token = ?, reset_token_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) 
         WHERE id = ?'
        );

        $s->execute([$token, $id]);
    }

    public static function findByResetToken(string $token): ?array
    {
        if ($token === '') {
            return null;
        }

        $s = Database::pdo()->prepare(
            'SELECT * FROM users
             WHERE reset_token = ?
             AND reset_token_expires > NOW()
             AND is_active = 1'
        );

        $s->execute([$token]);

        return $s->fetch() ?: null;
    }

    public static function updatePassword(int $id, string $passwordHash): void
    {
        $s = Database::pdo()->prepare(
            'UPDATE users SET password_hash = ? WHERE id = ?'
        );

        $s->execute([$passwordHash, $id]);
    }

    public static function clearResetToken(int $id): void
    {
        $s = Database::pdo()->prepare(
            'UPDATE users SET reset_token = NULL, reset_token_expires = NULL WHERE id = ?'
        );

        $s->execute([$id]);
    }
}
