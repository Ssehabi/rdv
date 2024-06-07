<?php 
  session_start();

   require_once('C:\rdv\Metier\decision.php');
   if(!isset($_SESSION['nom'])){
     header("Location: http://localhost/rdv/");
   }
 
  if(isset($_POST)){
    
    if(extract($_POST)){
    //$c = new Decision($observation, $dateDecision, $valDecision,$rdvId);
   // $c->setId($id);
    $dao = new DAO();
    //$dao->updateDecision($c);
    $dao->updateRdvStatus($statRdv,$motifStatus,$rdvId);
   // $succes=true;
   // unset($_POST);
    }
    unset($_POST);
  }
 //header("Location:../Presentation/Client/afficherMedecins.php");
 header("Location:afficherRdv.php");
 
?>
