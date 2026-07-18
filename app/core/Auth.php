<?php
final class Auth
{
    public static function user(): ?array
    {
        Security::startSession();
        return $_SESSION['user'] ?? null;
    }
    public static function check(): bool
    {
        return self::user() !== null;
    }
    public static function hasRole(array $roles): bool
    {
        $u = self::user();
        return $u && in_array($u['role'], $roles, true);
    }
    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: index.php?page=login');
            exit;
        }
    }
    public static function requireRole(array $roles): void
    {
        self::requireLogin();
        if (!self::hasRole($roles)) {
            http_response_code(403);
            exit('Accès refusé');
        }
    }
    public static function login(array $user): void
    {
        Security::startSession();
        session_regenerate_id(true);
        $_SESSION['user'] = ['id' => $user['id'], 'email' => $user['email'], 'role' => $user['role'], 'first_name' => $user['first_name']];
    }
    public static function logout(): void
    {
        Security::startSession();
        $_SESSION = [];
        session_destroy();
    }
}
