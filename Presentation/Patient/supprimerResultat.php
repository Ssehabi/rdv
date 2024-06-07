<?php 
  session_start();
 // include_once('../../Metier/rendezvous.php');
 require_once('C:\rdv\Metier\resultat.php');
  if(!isset($_SESSION['nom'])){
    //* header("Location: http://localhost/Mini/");
    header("Location: http://localhost/rdv/");
  }

    if(isset($_GET)){
      DAO::deleteResultat($_GET['id']);
    }

   //* header("Location: http://localhost/Mini/Presentation/Client/afficherClients.php");
   header("Location:afficherResultAdmin.php");
?>