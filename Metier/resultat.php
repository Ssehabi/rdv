<?php
//include_once("..\DAO\DAO.php");
require_once('C:\rdv\DAO\DAO.php');

class Resultat{
    private $id;
    
    private $dateRes;
    private $heureRes;
    private $patientId;
    private $observation;
    //private $dao;

    function __construct($d,$h,$p,$o){
       //$this->id = $i;  
        $this->dateRes = $d;
        $this->heureRes = $h;
        $this->patientId = $p;
        $this->observation = $o;
        //$this->dao = new DAO();
    }

    function get($c){
        switch($c){
            case "i" : return $this->id;
            case "d" : return $this->dateRes;
            case "h" : return $this->heureRes;
            case "p" : return $this->patientId;
            case "o" : return $this->observation;
        }
    }

    function save(){
        $dao = new DAO(); 
        $dao->ajouterResultat($this);
    }

    function setId($idd){
        $this->id = $idd;
    }

    function update($cli){
        $dao = new DAO(); 
        $dao->updateResultat($cli);
    }

    static function delete($cli){
        $dao = new DAO();
        $dao->deleteResultat($cli);
    }

    function getResultat($cli){
        $dao = new DAO();  
        return $dao->getResultat($cli); 
    }

    static function afficherResultUser($cli){
        $dao = new DAO();
         return $dao->afficherMesResultat($cli);
    }

    static function afficherResultAdmin(){
        $dao = new DAO();
         return $dao->afficherResultat();
    }   

}

?>