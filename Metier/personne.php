<?php 
//include_once("../DAO/DAO.php");
//include_once(__DIR__ .'\DAO\DAO.php');
include_once('C:\rdv\DAO\DAO.php');

class Personne{
    protected $id;
    protected $nom;
    protected $adresse;
    protected $telephone;
    protected $email;
    protected $passwrd;
   // protected $dao;

    //protected $dao;

    public function __construct($n,$a,$t,$e,$m){
        $this->nom = $n;
        $this->adresse = $a;
        $this->telephone = $t;
        $this->email = $e;
        $this->passwrd = $m;
      //  $this->dao = new DAO();
        
        
    }

    public function get($c){
        switch($c){
            case "i" : return $this->id; break;
            case "n" : return $this->nom; break;
            case "a" : return $this->adresse; break;
            case "t" : return $this->telephone; break;
            case "e" : return $this->email; break;
            case "m" : return $this->passwrd; break;
        }
    }

    public function save(){}

    public static function afficher(){}

    public function setId($idd){}

    public function update($cli){}

    public static function delete($cli){}
}
?>