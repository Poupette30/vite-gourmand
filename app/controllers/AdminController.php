<?php
final class AdminController
{
    public function dashboard(): void
    {
        Auth::requireRole(['administrateur']);
        View::render('admin/dashboard');
    }

    public function employees(): void
    {
        Auth::requireRole(['administrateur']);
        View::render('admin/employees', ['employees' => User::allEmployees()]);
    }

    public function createEmployee(): void
    {
        Auth::requireRole(['administrateur']);
        Security::verifyCsrf();

        User::create($_POST, 'employe');

        Mailer::send(
            $_POST['email'],
            'Compte employé créé',
            'Un compte employé Vite & Gourmand a été créé. Le mot de passe est à demander à l’administrateur.'
        );

        header('Location: index.php?page=admin_employees');
        exit;
    }

    public function disableEmployee(): void
    {
        Auth::requireRole(['administrateur']);
        Security::verifyCsrf();

        User::disableEmployee((int)$_POST['id']);

        header('Location: index.php?page=admin_employees');
        exit;
    }

    public function reviews(): void
    {
        Auth::requireRole(['administrateur']);
        View::render('admin/reviews', ['reviews' => Review::pending()]);
    }

    public function approveReview(): void
    {
        Auth::requireRole(['administrateur']);
        Security::verifyCsrf();

        Review::moderate((int)$_POST['id'], 'approved');

        header('Location: index.php?page=admin_reviews');
        exit;
    }

    public function refuseReview(): void
    {
        Auth::requireRole(['administrateur']);
        Security::verifyCsrf();

        Review::moderate((int)$_POST['id'], 'refused');

        header('Location: index.php?page=admin_reviews');
        exit;
    }
}
