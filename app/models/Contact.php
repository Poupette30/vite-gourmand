<?php
final class Contact
{
    public static function create(array $d): void
    {
        $s=Database::pdo()->prepare('INSERT INTO contacts(title,email,message) VALUES(?,?,?)'); $s->execute([$d['title'],$d['email'],$d['message']]);
        Mailer::send('contact@vite-gourmand.local', 'Nouveau contact : '.$d['title'], $d['email']."\n\n".$d['message']);
    }
}
