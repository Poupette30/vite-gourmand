<?php
final class Mailer
{
    public static function send(string $to, string $subject, string $body): bool
    {
        $config = require __DIR__ . '/../config/config.php';
        $headers = "From: {$config['mail_from']}\r\nContent-Type: text/plain; charset=UTF-8";
        // En production : remplacer par Symfony Mailer, PHPMailer ou API SMTP.
        return @mail($to, $subject, $body, $headers);
    }
    public static function welcome(string $to, string $firstName): void { self::send($to, 'Bienvenue chez Vite & Gourmand', "Bonjour $firstName,\n\nVotre compte utilisateur a bien été créé.\n\nL'équipe Vite & Gourmand"); }
    public static function orderConfirmation(string $to, string $ref): void { self::send($to, 'Confirmation de commande '.$ref, "Votre commande $ref est bien enregistrée. Vous pouvez suivre son évolution depuis votre espace."); }
    public static function equipmentReminder(string $to): void { self::send($to, 'Retour de matériel', "Merci de restituer le matériel prêté sous 10 jours ouvrés. Passé ce délai, des frais de 600 € pourront être appliqués conformément aux CGV."); }
    public static function reviewAvailable(string $to): void { self::send($to, 'Votre avis nous intéresse', "Votre commande est terminée. Connectez-vous pour laisser une note entre 1 et 5 et un commentaire."); }
}
