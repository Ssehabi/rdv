<?php
    require("../DAO/DAO.php");
    extract($_POST);
    session_start();
   // echo 'yesss';
    $dao = new DAO();
    $resRet=$dao->authentification($password);
    if ($resRet==1){    //admin
        $_SESSION=$_GET;
        $_SESSION['level_u']=1;
        unset($_GET);
       // header("location:Patient/afficherPatient.php");
       header("location:Patient/afficherPatientAdmin.php");
        
    } elseif ($resRet==2) {
        $_SESSION=$_GET;
        $_SESSION['level_u']=2;
        unset($_GET);
       // $patId=$_SESSION['idPatient'];
        //header("location:Rendezvous/afficherMesRdv.php?ref=$patId ");
        header("location:Rendezvous/afficherMesRdv.php?ref=".$_SESSION['idPatient']." ");
      //  header("location:Rendezvous/afficherMesRdv.php ");
    }
    else header("location: ../index.php?error=1");
   
   
?>