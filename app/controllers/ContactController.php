<?php
final class ContactController
{
    public function form(): void { View::render('contact/form'); }
    public function send(): void { Security::verifyCsrf(); Contact::create($_POST); View::render('contact/form',['success'=>'Votre message a bien été envoyé.']); }
}
