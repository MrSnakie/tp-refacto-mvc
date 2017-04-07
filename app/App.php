<?php
use Core\Database\MysqlDatabase;
use Core\Config;

class App
{
    public $titre = 'Travail personnel n°2'; // Titre du site

    private static $_instance; // On stocke la variable 'instance'

    private $db_instance; // On la passe en privée

    public static function load(){
        session_start(); // On commence une session
        require ROOT.'/app/Autoloader.php'; // On fait appelle au fichier 'Autoloader' dans le dossier 'app'
        App\Autoloader::register();
        require ROOT.'/core/Autoloader.php'; // On fait appelle au fichier 'Autoloader' mais dans le dossier 'core'
        Core\Autoloader::register();
    }

    public static function getInstance(){ // On fait un singleton pour notre instance
        if(is_null(self::$_instance)){ // Si notre variable est nul
            self::$_instance = new App(); // On met notre instance dans la variable
        }
        return self::$_instance; // On retourne l'instance
    }

    public function getTable($name){ // On fait une fonction pour récupérer une table selon son nom
        $class_name = '\\App\\Table\\'.ucfirst($name).'Table'; // On indique le chemin de la table et on transforme la 1ère lettre en majuscule
        return new $class_name($this->getDb());
    }

    public function getDb(){ // Fonction pour récupérer les données de la BDD
        $config = Config::getInstance(ROOT.'/config/config.php'); // On stock dans la variable la config de la BDD
        if(is_null($this->db_instance)){ // Si l'instance de connexion est vide
            $this->db_instance = new MysqlDatabase(
                $config->get('db_name'),
                $config->get('db_user'),
                $config->get('db_pass'),
                $config->get('db_host')
            ); // On créer alors l'instance
        }
        return $this->db_instance; // Sinon on retourne l'instance
    }

    public function notFound(){ // Fonction pour appeler les pages d'erreur 404
        header("HTML/1.0 404 Not Found");
        header('location: index.php?p=404');
    }

    public function forbidden(){ // Fonction pour appeler les pages d'erreur 403
        header("HTML/1.0 403 Forbidden");
        header('location: index.php?p=403');
    }
}