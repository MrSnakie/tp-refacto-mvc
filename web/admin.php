<?php
use Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));
require ROOT.'/app/App.php';
App::load();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}else{
    $page = "home";
}

$app = App::getInstance();
$auth = new DBAuth($app->getDb());

//connexion utilisateur via login.php
if ($_POST) {
    if (isset($_POST['username'], $_POST['password'])) {
        if ($auth->login($_POST['username'], $_POST['password'])) {
            //prevoir un message flash
        }else{
            header('location: index.php?p=Connexion');
            exit();
        }
    }
}
//fin connexion utilisateur via login.php

if (!$auth->logged()) {
    $app->forbidden();
}

$connect = "Deconnexion";
$admin = '<li><a href="admin.php">Administration</a></li>';

ob_start();

# Page d'accueil
if ($page==='home') { // Page 'home'
    require ROOT.'/pages/users/account.php';

# Page d'erreur
}else{ // Erreur 404
    require ROOT.'/pages/errors/404.php';
}

$content = ob_get_clean();
require ROOT.'/pages/templates/default.php';