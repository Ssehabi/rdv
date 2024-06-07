<?php
//include_once("..\DAO\DAO.php");
require_once('C:\rdv\DAO\DAO.php');

class Typeconsultation{
    private $id;
    private $designTypeCons;



    function __construct($i,$t){
        $this->id = $i;
        $this->designTypeCons = $t;
        //$this->dao = new DAO();

    }

    function get($c){
        switch($c){
            case "i" : return $this->id;
            case "t" : return $this->designTypeCons;
        }
    }

    function save(){
        $dao = new DAO(); 
        $dao->ajouterTypecons($this);
    }

    static function afficher(){

        $dao = new DAO();
         return $dao->afficherTypecons();
    }

    function update($cli){
        $dao = new DAO(); 
        $dao->updateTypecons($cli);
    }

    static function delete($cli){
        $dao = new DAO();
        $dao->deleteTypecons($cli);
    }
    function setId($idd){
        $this->id = $idd;
    }

    function getTypeC($cli){
        $dao = new DAO();  
        return $dao->getTypeC($cli); 
        //$this->dao->getPatient($cli);
    }


}

?>