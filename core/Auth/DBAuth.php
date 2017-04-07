<?php
namespace Core\Auth;
use Core\Database\Database;

/**
* Classe pour la connexion au site via une base de donnée
*/
class DBAuth
{
    protected $db; // On protège la variable 'db'

    function __construct(Database $db){ // Fonction pour se connecter à la BDD
        $this->db = $db;
    }

    public function login($username, $password){ // Fonction pour récupérer les infos de connexion d'un admin
        $user = $this->db->prepare("SELECT *
                                    FROM users
                                    WHERE pseudo = ?",
                                   [$username], null, true); // Séléctionne toute la table 'admin' et on le récupère dans un objet standard sur une ligne
        if($user){
            if($user->password === sha1($password)){ // 'sha1' crypte le mot de passe
                $_SESSION['Auth'] = $user->id; // On commence une nouvelle session
                return true;
            }
        }
        return false;
    }

    public function logged(){
        return isset($_SESSION['Auth']); // Vérifie si 'Auth' existe en retournant 'true' ou 'false'
    }

    public function getUserId(){
        if($this->logged()){
            return $_SESSION['Auth'];
        }else{
            return false;
        }
    }
}