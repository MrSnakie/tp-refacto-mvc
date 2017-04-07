<?php
namespace Core; // Initialise config.php dans le fichier 'app' contenant toutes les classes

/**
* class pour la configuration du site
*/
class Config
{
    private static $_instance; // On stocke la variable 'instance'

    private $settings = []; // Tableau vide pour stocker les infos de connexion à la BDD

    public static function getInstance($file){ // On fait un singleton pour notre instance
        if(is_null(self::$_instance)){ // Si notre est variable est nul
            self::$_instance = new Config($file);// On met notre instance dans la variable
        }
        return self::$_instance; // On retourne l'instance
    }

    public function __construct($file){
        $this->settings = require($file);
    }

    public function get($key){ // Fonction pour récupérer la clé
        if(!isset($this->settings[$key])){ // Si la clé n'est pas définie
            return null; // On retourne 'null'
        }
        return $this->settings[$key]; // Sinon retourne la valeur du tableau qui est contenu dans la clé x
    }
}