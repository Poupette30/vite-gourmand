<?php
final class MenuController
{
    public function index(): void { View::render('menus/index',['menus'=>Menu::all($_GET)]); }
    public function api(): void { header('Content-Type: application/json'); echo json_encode(Menu::all($_GET), JSON_UNESCAPED_UNICODE); }
    public function show(): void { $menu=Menu::find((int)($_GET['id']??0)); if(!$menu){http_response_code(404); exit('Menu introuvable');} View::render('menus/show',['menu'=>$menu]); }
}
