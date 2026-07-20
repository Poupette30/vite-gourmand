<?php

$env = static function (string $name, ?string $default = null): ?string {
    $value = getenv($name);

    if ($value !== false && $value !== '') {
        return $value;
    }

    if (isset($_ENV[$name]) && $_ENV[$name] !== '') {
        return $_ENV[$name];
    }

    return $default;
};

return [
    'app_name' => 'Vite & Gourmand',

    'base_url' => $env(
        'APP_URL',
        'http://localhost:8000'
    ),

    'db' => [
        'host' => $env(
            'MYSQLHOST',
            $env('DB_HOST', '127.0.0.1')
        ),

        'port' => $env(
            'MYSQLPORT',
            $env('DB_PORT', '3308')
        ),

        'name' => $env(
            'MYSQLDATABASE',
            $env('DB_NAME', 'vite_gourmand')
        ),

        'user' => $env(
            'MYSQLUSER',
            $env('DB_USER', 'root')
        ),

        'password' => $env(
            'MYSQLPASSWORD',
            $env('DB_PASS', '')
        ),

        'charset' => 'utf8mb4',
    ],

    'mongo_uri' => $env(
        'MONGO_URI',
        'mongodb://127.0.0.1:27017'
    ),

    'mongo_database' => $env(
        'MONGO_DB',
        'vite_gourmand_stats'
    ),

    'mail_from' => $env(
        'MAIL_FROM',
        'contact@vite-gourmand.local'
    ),

    'security' => [
        'session_name' => 'VG_SESSION',
        'csrf_key' => '_csrf_token',
        'password_regex' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{10,}$/',
    ],
];
