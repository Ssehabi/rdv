<?php 
  session_start();
  include_once('../../Metier/rendezvous.php');
  if(!isset($_SESSION['nom'])){
    header("Location: http://localhost/rdv/");
  }
  if(isset($_POST)){
    
    if(extract($_POST)){
      if ($consultationId==0) $consultationId=null;
    $c = new Rendezvous($dateRdv, $heureRdv, $patientId,$consultationId,$statusRdv,$MotifStatus);
   // $c->setId($id);
   // $dao = new DAO();
    //$dao->updateRdv($c);
    $c->save();
    $succes=true;
   // unset($_POST);
    }
    unset($_POST);    
 }
 //header("Location:../Presentation/Client/afficherMedecins.php");
 header("Location:afficherMesRdv.php");
 
?>
        

   