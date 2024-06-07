<?php
require_once('C:\rdv\DAO\DAO.php');

class statusRDV{
    private  $statusRdvS;
    private $MotifStatus;
   
    function __construct($s,$m){
        $this->statusRdvS = $s;
        $this->MotifStatus = $m;
    }

    function get($c){
        switch($c){
            case "s" : return $this->statusRdvS;
            case "m" : return $this->MotifStatus;         
        }
    }

    static function afficher(){
       // $dao = new DAO();
       //  return $dao->afficherDecision();
    }   

}

?>