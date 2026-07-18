<?php
return [
    'app_name' => 'Vite & Gourmand',
    'base_url' => $_ENV['APP_URL'] ?? 'http://localhost:8000',
    'db' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'port' => $_ENV['DB_PORT'] ?? 'localhost',
        'name' => $_ENV['DB_NAME'] ?? 'vite_gourmand',
        'user' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASS'] ?? '',
        'charset' => 'utf8mb4',
    ],
    'mongo_uri' => $_ENV['MONGO_URI'] ?? 'mongodb://127.0.0.1:27017',
    'mongo_database' => $_ENV['MONGO_DB'] ?? 'vite_gourmand_stats',
    'mail_from' => $_ENV['MAIL_FROM'] ?? 'contact@vite-gourmand.local',
    'security' => [
        'session_name' => 'VG_SESSION',
        'csrf_key' => '_csrf_token',
        'password_regex' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{10,}$/',
    ],
];
