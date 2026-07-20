<?php

final class AuthController
{
    public function login(): void
    {
        View::render('auth/login');
    }

    public function doLogin(): void
    {
        Security::verifyCsrf();

        $u = User::findByEmail($_POST['email'] ?? '');

        if (!$u || !password_verify($_POST['password'] ?? '', $u['password_hash'])) {
            View::render('auth/login', ['error' => 'Identifiants invalides']);
            return;
        }

        Auth::login($u);
        header('Location: index.php?page=dashboard');
        exit;
    }

    public function register(): void
    {
        View::render('auth/register');
    }

    public function doRegister(): void
    {
        Security::verifyCsrf();

        try {
            User::create($_POST);

            Mailer::welcome(
                $_POST['email'] ?? '',
                $_POST['first_name'] ?? ''
            );

            header('Location: index.php?page=login&registered=1');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                View::render('auth/register', [
                    'error' => 'Cette adresse e-mail est déjà utilisée.'
                ]);
                return;
            }

            View::render('auth/register', [
                'error' => 'Une erreur est survenue lors de la création du compte.'
            ]);
        } catch (Throwable $e) {
            View::render('auth/register', [
                'error' => 'Une erreur est survenue lors de la création du compte.'
            ]);
        }
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: index.php');
        exit;
    }

    public function forgotPassword(): void
    {
        View::render('auth/forgot_password');
    }

    public function sendResetLink(): void
    {
        Security::verifyCsrf();

        $email = trim($_POST['email'] ?? '');
        $user = User::findByEmail($email);

        $message = "Si un compte existe avec cet email, un lien de réinitialisation a été généré.";

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', time() + 7200);

            User::saveResetToken((int)$user['id'], $token, $expires);

            $config = require __DIR__ . '/../config/config.php';

            $resetLink = rtrim($config['base_url'], '/') .
                '/index.php?page=reset_password&token=' . urlencode($token);

            View::render('auth/forgot_password', [
                'success' => $message,
                'resetLink' => $resetLink
            ]);
            return;
        }

        View::render('auth/forgot_password', [
            'success' => $message
        ]);
    }

    public function resetPassword(): void
    {
        $token = $_GET['token'] ?? '';
        $user = User::findByResetToken($token);

        if (!$user) {
            View::render('auth/reset_password', [
                'error' => "Lien invalide ou expiré."
            ]);
            return;
        }

        View::render('auth/reset_password', [
            'token' => $token
        ]);
    }

    public function updatePassword(): void
    {
        Security::verifyCsrf();

        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        $user = User::findByResetToken($token);

        if (!$user) {
            View::render('auth/reset_password', [
                'error' => "Lien invalide ou expiré."
            ]);
            return;
        }

        if (strlen($password) < 8) {
            View::render('auth/reset_password', [
                'error' => "Le mot de passe doit contenir au moins 8 caractères.",
                'token' => $token
            ]);
            return;
        }

        if ($password !== $passwordConfirm) {
            View::render('auth/reset_password', [
                'error' => "Les mots de passe ne correspondent pas.",
                'token' => $token
            ]);
            return;
        }

        User::updatePassword((int)$user['id'], password_hash($password, PASSWORD_DEFAULT));
        User::clearResetToken((int)$user['id']);

        header('Location: index.php?page=login&password_reset=1');
        exit;
    }
}
