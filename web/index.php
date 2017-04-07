<?php
use Core\Auth\DBAuth;
define('ROOT', dirname(__DIR__)); // On indique que l'on veux le dossier parent de celui où on est
require ROOT.'/app/App.php'; // On fait appelle au fichier 'App.php' dans le dossier 'app'
App::load();

if(isset($_GET['p'])){ // Si la variable 'p' est définie
	$page = $_GET['p']; // Alors on attribue à la variable 'page', la variable 'p'
}else{
	$page = 'home'; // Sinon 'page' est égale à 'home'
}


##################################
#        BOUTON CONNEXION        #
##################################

$app = App::getInstance();
$auth = new DBAuth($app->getDb());
if($auth->logged()){
    $connect = 'Deconnexion';
    $admin = '<li><a href="admin.php">Administration</a></li>';
}else{
	$connect = 'Connexion';
	$admin = '';
}

##################################

ob_start(); // On créer un cache

# Page d'accueil
if($page === 'home'){ // Si la variable 'page' est égale à 'home'
	require ROOT.'/pages/index.php'; // Alors on fait appelle au fichier 'home.php'
}

# Autres pages

# Espace admin
elseif($page === 'Connexion'){ // Si la variable `page` est égale à `Connexion`
	require ROOT.'/pages/users/login.php'; // Alors on fait appelle au fichier `login.php`
}elseif($page === 'Deconnexion'){ // Si la variable `page` est égale à `Deconnexion`
	require ROOT.'/pages/users/logout.php'; // Alors on fait appelle au fichier `logout.php`

# Page d'erreur
}elseif($page === '403'){ // Si la variable `page` est égale à `403`
	require ROOT.'/pages/errors/403.php'; // Alors on fait appelle au fichier `403.php`
}else{ // Sinon si la variable `page` est égale à `404`
	require ROOT.'/pages/errors/404.php'; // Alors on fait appelle au fichier `404.php`
}

$content = ob_get_clean(); // On décharge/supprime le cache
require ROOT.'/pages/templates/default.php'; // On charge le fichier template par défaut