<?php
//include_once("..\DAO\DAO.php");
require_once('C:\rdv\DAO\DAO.php');

class Decision{
    private $id;
    private $observation;
    private $dateDecision;
    private $valDecision;
    private $rdvId;
    //private $dao;

    function __construct($i,$o,$d,$v,$r){
        $this->id = $i;
        $this->observation = $o;
        $this->dateDecision = $d;
        $this->valDecision = $v;
        $this->rdvId = $r;
        //$this->dao = new DAO();

    }

    function get($c){
        switch($c){
            case "i" : return $this->id;
            case "o" : return $this->observation;
            case "d" : return $this->dateDecision;
            case "v" : return $this->valDecision;
            case "r" : return $this->rdvId;
        }
    }

    function save(){
        $dao = new DAO(); 
        $dao->ajouterDecision($this);
    }

    function setId($idd){
        $this->id = $idd;
    }

    function update($cli){
        $dao = new DAO(); 
        $dao->updateDecision($cli);
    }

    static function delete($cli){
        $dao = new DAO();
        $dao->deleteDecision($cli);
    }

    function getDecision($cli){
        $dao = new DAO();  
        return $dao->getDecision($cli); 
    }

    static function afficher(){
        $dao = new DAO();
         return $dao->afficherDecision();
    }

    

}

?>