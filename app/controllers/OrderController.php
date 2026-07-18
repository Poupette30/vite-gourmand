<?php
final class OrderController
{
    public function create(): void
    {
        Auth::requireLogin();

        $menuId = (int)($_GET['menu_id'] ?? 0);
        $menu = Menu::find($menuId);

        if (!$menu) {
            echo "Menu introuvable. ID reçu : " . $menuId;
            exit;
        }

        View::render('orders/create', ['menu' => $menu]);
    }
    public function store(): void
    {
        Auth::requireLogin();
        Security::verifyCsrf();
        $menu = Menu::find((int)$_POST['menu_id']);
        $calc = Order::price((float)$menu['base_price'], (int)$menu['min_people'], (int)$_POST['people_count'], (float)($_POST['distance_km'] ?? 0));
        $user = Auth::user();
        $data = array_merge($_POST, $calc, ['user_id' => $user['id'], 'menu_total' => $calc['menu_total'], 'delivery_fee' => $calc['delivery'], 'total' => $calc['total']]);
        $id = Order::create($data);
        Mailer::orderConfirmation($_POST['customer_email'], 'commande #' . $id);
        header('Location: index.php?page=user_orders');
    }
    public function mine(): void
    {
        Auth::requireLogin();
        View::render('user/orders', ['orders' => Order::byUser(Auth::user()['id'])]);
    }
    public function employeeList(): void
    {
        Auth::requireRole(['employe', 'administrateur']);
        View::render('employee/orders', ['orders' => Order::search($_GET['status'] ?? null, $_GET['client'] ?? null)]);
    }
    public function status(): void
    {
        Auth::requireRole(['employe', 'administrateur']);
        Security::verifyCsrf();
        Order::updateStatus((int)$_POST['id'], $_POST['status'], $_POST['note'] ?? '');
        header('Location: index.php?page=employee_orders');
    }
    public function cancel(): void
    {
        Auth::requireRole(['employe', 'administrateur']);
        Security::verifyCsrf();
        Order::cancel((int)$_POST['id'], $_POST['contact_mode'], $_POST['reason']);
        header('Location: index.php?page=employee_orders');
    }
}
