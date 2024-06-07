<?php 
  session_start();
  require_once('C:\rdv\Metier\rendezvous.php');
  if(!isset($_SESSION['nom'])){
    //* header("Location: http://localhost/Mini/");
    header("Location: http://localhost/rdv/");
  }

  /* if(isset($_POST)){
    
    if(extract($_POST)){
    $c = new Rendezvous($dateRdv, $heureRdv, $patientId,$consultationId,$statusRdv);
   // $c->setId($id);
    $dao = new DAO();
    $dao->updateRdv($c);
    $succes=true;
   // unset($_POST);
    }
    unset($_POST);
    
 } */
 //header("Location:../Presentation/Client/afficherMedecins.php");


 if(isset($_POST)){
    
  if(extract($_POST)){
    if ($consultationId==0) $consultationId=null;
  $c = new Rendezvous($dateRdv, $heureRdv, $patientId,$consultationId,$statusRdv,$MotifStatus);
  $c->setId($id);
  $dao = new DAO();
  $dao->updateRdv($c);
 //** */ $c->update($c);
 // DAO::updateRdv($c);
 // $succes=true;
 // unset($_POST);
  }
  unset($_POST);    
}
header("Location:afficherMesRdv.php");
 
?>
