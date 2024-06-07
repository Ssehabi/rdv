<?php 
  session_start();
  require_once('C:\rdv\Metier\resultat.php');
  if(!isset($_SESSION['nom'])){
    //* header("Location: http://localhost/Mini/");
    header("Location: http://localhost/rdv/");
  }

 
 if(isset($_POST)){
    
  if(extract($_POST)){
   // if ($consultationId==0) $consultationId=null;
 // $c = new Rendezvous($dateRdv, $heureRdv, $patientId,$consultationId,$statusRdv);
  $c = new Resultat($dateRes,$heureRes,$patientId,$observation);
  $c->setId($id);
  $dao = new DAO();
  $dao->updateResultat($c);
 //** */ $c->update($c);
 // DAO::updateRdv($c);
 // $succes=true;
 // unset($_POST);
  }
  unset($_POST);    
}
header("Location:afficherResultAdmin.php");
 
 ?>
