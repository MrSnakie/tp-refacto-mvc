<?php
namespace Core\Database; // Initialise database.php dans le fichier 'app' contenant toutes les classes
use \PDO; // On quitte le dossier virtuel 'app' pour pouvoir utiliser la classe 'pdo' qui est utilisé par défaut en PHP

/**
* Connexion a la base de donnée
*/
class MysqlDatabase extends Database
{
    
    private $db_name; // Nom de la base de donnée
    private $db_user; // Nom d'utilisateur de la base de donnée
    private $db_pass; // Mot de passe de la base de donnée
    private $db_host; // Nom d'hôte de la base de donnée
    private $pdo; // Variable PDO pour appeler la base de donnée


    function __construct($db_name, $db_user='root', $db_pass='', $db_host='localhost') // '__construct' permet de pouvoir utiliser les méthodes privates et leur donner une variable
    {
        $this->db_name= $db_name;
        $this->db_user= $db_user;
        $this->db_pass= $db_pass;
        $this->db_host= $db_host;
    }

    private function getPdo(){ // Si 'pdo' est strictement égale à 0, demande de connexion à la base de donnée
        if($this->pdo === null){
            $pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.';charset=UTF8', $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo; // Si 'pdo' existe déjà retourne $this->pdo
    }

    public function query($statement, $class_name=null, $one=false){

        $req = $this->getPdo()->query($statement); // Execute une 'req' depuis la fonction 'getPdo', query éxecute une requête sql
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
            ){
            return $req;
        }
        if(is_null($class_name)){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one===false){ // Si '$one' est strictement égale à false
            $datas = $req->fetchAll(); // Execute si false et le met dans un tableau
        }else{
            $datas = $req->fetch(); // Execute si true et le met dans un tableau
        }
        return $datas;
    }
    public function prepare($statement, $parametre, $class_name=null, $one=false){
        
        $req = $this->getPdo()->prepare($statement); // Prépare une requête à l'exécution et retourne un objet
        $res = $req->execute($parametre); // Execute $parametre
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
            ){
            return $res;
        }
        if(is_null($class_name)){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one===false){ // Si '$one' est strictement égale à false
            $datas = $req->fetchAll(); // Execute si false et le met dans un tableau
        }else{
            $datas = $req->fetch(); // Execute si true et le met dans un tableau
        }
        return $datas; // Retourne dans la variable '$datas'
    }
}