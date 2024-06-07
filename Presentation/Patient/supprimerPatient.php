<?php 
   session_start();
   require_once('C:\rdv\Metier\patient.php');
   if(!isset($_SESSION['nom'])){
     header("Location: http://localhost/rdv/");
   }
 
    if(isset($_GET)){
      DAO::deletePatient($_GET['id']);
    }

   //* header("Location: http://localhost/Mini/Presentation/Client/afficherClients.php");
   header("Location:afficherPatientAdmin.php");

   
?>