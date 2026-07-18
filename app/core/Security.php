<?php
final class Security
{
    public static function startSession(): void
    {
        $config = require __DIR__ . '/../config/config.php';
        if (session_status() === PHP_SESSION_NONE) {
            session_name($config['security']['session_name']);
            session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'secure' => isset($_SERVER['HTTPS'])]);
            session_start();
        }
    }
    public static function e(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
    public static function csrfToken(): string
    {
        self::startSession();
        $config = require __DIR__ . '/../config/config.php';
        $key = $config['security']['csrf_key'];
        if (empty($_SESSION[$key])) $_SESSION[$key] = bin2hex(random_bytes(32));
        return $_SESSION[$key];
    }
    public static function csrfField(): string { return '<input type="hidden" name="csrf" value="'.self::csrfToken().'">'; }
    public static function verifyCsrf(): void
    {
        self::startSession();
        $config = require __DIR__ . '/../config/config.php';
        $token = $_POST['csrf'] ?? '';
        if (!$token || !hash_equals($_SESSION[$config['security']['csrf_key']] ?? '', $token)) {
            http_response_code(419); exit('Jeton CSRF invalide.');
        }
    }
}
