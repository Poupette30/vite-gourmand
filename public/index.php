<?php
require __DIR__ . '/../app/core/Database.php';
require __DIR__ . '/../app/core/Security.php';
require __DIR__ . '/../app/core/Auth.php';
require __DIR__ . '/../app/core/Mailer.php';
require __DIR__ . '/../app/core/View.php';
foreach (glob(__DIR__ . '/../app/models/*.php') as $f) require $f;
foreach (glob(__DIR__ . '/../app/controllers/*.php') as $f) require $f;
Security::startSession();
$page = $_GET['page'] ?? 'home';
$routes = [
    'home' => fn() => View::render('home/index', ['reviews' => Review::approved()]),
    'menus' => fn() => (new MenuController())->index(),
    'api_menus' => fn() => (new MenuController())->api(),
    'menu' => fn() => (new MenuController())->show(),
    'login' => fn() => (new AuthController())->login(),
    'do_login' => fn() => (new AuthController())->doLogin(),
    'register' => fn() => (new AuthController())->register(),
    'do_register' => fn() => (new AuthController())->doRegister(),
    'logout' => fn() => (new AuthController())->logout(),
    'order_create' => fn() => (new OrderController())->create(),
    'order_store' => fn() => (new OrderController())->store(),
    'user_orders' => fn() => (new OrderController())->mine(),
    'dashboard' => fn() => View::render('user/dashboard'),
    'employee_orders' => fn() => (new OrderController())->employeeList(),
    'order_status' => fn() => (new OrderController())->status(),
    'order_cancel' => fn() => (new OrderController())->cancel(),
    'admin' => fn() => (new AdminController())->dashboard(),
    'admin_employees' => fn() => (new AdminController())->employees(),
    'admin_employee_create' => fn() => (new AdminController())->createEmployee(),
    'admin_employee_disable' => fn() => (new AdminController())->disableEmployee(),
    'contact' => fn() => (new ContactController())->form(),
    'contact_send' => fn() => (new ContactController())->send(),
    'legal' => fn() => View::render('home/legal'),
    'cgv' => fn() => View::render('home/cgv'),
    'review_store' => fn() => (new ReviewController())->store(),
    'forgot_password' => fn() => (new AuthController())->forgotPassword(),
    'send_reset_link' => fn() => (new AuthController())->sendResetLink(),
    'reset_password' => fn() => (new AuthController())->resetPassword(),
    'update_password' => fn() => (new AuthController())->updatePassword(),
    'admin_reviews' => fn() => (new AdminController())->reviews(),
    'admin_review_approve' => fn() => (new AdminController())->approveReview(),
    'admin_review_refuse' => fn() => (new AdminController())->refuseReview(),
    'admin' => fn() => (new AdminController())->dashboard(),
    'admin_analytics' => fn() => (new AnalyticsController())->index(),
];
($routes[$page] ?? $routes['home'])();
