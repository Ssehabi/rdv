<?php 
  session_start();
  require_once('C:\rdv\Metier\patient.php');
  if(!isset($_SESSION['nom'])){
    header("Location: http://localhost/rdv/");
  }


 
  if(isset($_POST)){
    
    if(extract($_POST)){
    $c = new Patient($nom, $adresse, $telephone, $email,$mdpasse);
    $c->setId($id);
    $dao = new DAO();
    $dao->updatePatient($c);
  //  $succes=true;
   // unset($_POST);
    }
    unset($_POST);
    
 }
 header("Location:afficherPatientAdmin.php");
 
 
?>