<?php
//include_once("../DAO/DAO.php");
//include_once(__DIR__ .'\DAO\DAO.php');
include_once('C:\rdv\DAO\DAO.php');
require_once("personne.php");

class Patient extends Personne{

    function save(){  
        $dao = new DAO();    
       // $this->dao->ajouterPatient($this);
        $dao->ajouterPatient($this);
    }

    static function afficherPatientAdmin(){
        $dao = new DAO();
        return $dao->afficherPatients();
    }

  /*  static function total(){
        $dao = new DAO();
        return $dao->getClientTotal();
    }*/

    function setId($idd){
        $this->id = $idd;
    }

    function update($cli){
        $dao = new DAO();  
        $dao->updatePatient($cli); 
       // $this->dao->updatePatient($cli);
    }

    function getPatient($cli){
        $dao = new DAO();  
       return $dao->getPatient($cli); 
        //$this->dao->getPatient($cli);
    }

    static function delete($cli){
        $dao = new DAO();
        $dao->deletePatient($cli);
    }
}
