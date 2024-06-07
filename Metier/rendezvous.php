<?php
require_once('C:\rdv\DAO\DAO.php');

class Rendezvous{
    private $id;
    private $dateRdv;
    private $heureRdv;
    private $patientId;
    private $consultationId;
    private $statusRdv;
    private $MotifStatus;
    //private $dao;



    function __construct($d,$h,$p,$c,$s,$m){
     //   $this->id = $i;
        $this->dateRdv = $d;
        $this->heureRdv = $h;
        $this->patientId = $p;
        $this->consultationId = $c;
        $this->statusRdv = $s;
        $this->MotifStatus = $m;
        //$this->dao = new DAO();
    }

    function get($c){
        switch($c){
            case "i" : return $this->id;
            case "d" : return $this->dateRdv;
            case "h" : return $this->heureRdv;
            case "p" : return $this->patientId;
            case "c" : return $this->consultationId;
            case "s" : return $this->statusRdv;
            case "m" : return $this->MotifStatus;
        }
    }

    function save(){
        $dao = new DAO(); 
        $dao->ajouterRdv($this);
        //$this->dao->ajouterRdv($this);
    }
    function setId($idd){
        $this->id = $idd;
    }

    function getRdv($cli){
        $dao = new DAO();  
        return $dao->getRdv($cli); 
        //$this->dao->getPatient($cli);
    }

    static function afficher(){
        $dao = new DAO();
       // $cl=$dao->afficherRdv();
       // return $cl;
        return $dao->afficherRdv();
    }

    function update($cli){
        $dao = new DAO(); 
        $dao->updateRdv($cli);
    }

    function updateStatus($statRdv,$motifStatus,$rdvId){
        $dao = new DAO(); 
        $dao->updateRdvStatus($statRdv,$motifStatus,$rdvId);
    }

    static function delete($cli){
        $dao = new DAO();
        $dao->deleteRdv($cli);
    }

    static function afficherMesRdv($cli){
        $dao = new DAO();
        return $dao->afficherMesRdv($cli);
      //  $cl=$dao->afficherRdv();
        //return $cl;
    }


}

?>