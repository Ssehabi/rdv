<?php

class DAO
{

    private $pdo;

    function getPDO()
    {
        if ($this->pdo === null) {
            $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
            //  $pdo->setAttribute
            $this->pdo = $pdo;
        }
        return $pdo;
    }

    function authentification($password)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM administrateurs WHERE email = ? AND password = ?");
        $stmt->execute(array($password));
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $_GET = $row;
            return 1;
        } else {
            //$pdo = $this->getPDO();
            $stmt = $pdo->prepare("SELECT * FROM patient WHERE email = ? AND password = ?");
            $stmt->execute(array($password));
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $_GET = $row;
                return 2;
            } else return 0;
        }
    }

    /*       $connexion  = new PDO('mysql:host='.SQL_SERVEUR.';dbname='.SQL_DATABASE,SQL_USER,SQL_PASSWORD);
$requete_preparee = $connexion->prepare('SELECT COUNT(*) AS nbr_entrees FROM Utilisateurs WHERE prenom=?');
$requete_preparee->execute(array('John'));
$resultat = $prep->fetch(PDO::FETCH_OBJ);
if($resultat->nbr_entrees ==  0)
  echo 'C\'est clean !';
else
  echo 'Bah non ! John existe déjà !';*/

    function executeQuery($sql)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clients[] = $row;
        }
        return $clients;
    }

    //PATIENT////////

    function ajouterPatient($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("INSERT INTO patient(nom,adresse,telephone,email,passwrd) VALUES(?,?,?,?,?)");
        $stmt->execute(array($obj->get("n"), $obj->get("a"), $obj->get("t"), $obj->get("e"), $obj->get("m")));
    }
    function updatePatient($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("UPDATE patient SET nom=?,adresse=?,telephone=?,email=?,passwrd=? where idPatient=?; ");
        $stmt->execute(array($obj->get("n"), $obj->get("a"), $obj->get("t"), $obj->get("e"), $obj->get("m"), $obj->get("i")));
    }

    static function deletePatient($id)
    {
        //** */   $pdo=$this->getPDO();
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        $stmt = $pdo->prepare("DELETE FROM patient where idPatient =?; ");
        $stmt->execute(array($id));
    }

    function afficherPatients()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM patient");
        $stmt->execute();
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $cli = new Patient($nom, $adresse, $telephone, $email, $passwrd);
            $cli->setId($idPatient);
            $clients[] = $cli;
        }
        return $clients;
    }

    static function getPatient($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        // $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM patient where idPatient =?;");
        $stmt->execute(array($id));

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            return new Patient($nom, $adresse, $telephone, $email, $passwrd);
        }
        return null;
    }

    function getPatientTotal()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT count(*) as number FROM patient;");
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            return $number;
        }
        return 0;
    }

    //////rendz vous/////////////////////////

    function ajouterRdv($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("INSERT INTO rendezvous(dateRdv,heureRdv,idPatient,idConsultation,statusRdv,MotifStatus) VALUES(?,?,?,?,?,?)");
        $stmt->execute(array($obj->get("d"), $obj->get("h"), $obj->get("p"), $obj->get("c"), $obj->get("s"), $obj->get("m")));
    }
    function updateRdv($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("UPDATE rendezvous SET dateRdv=?,heureRdv=?,idPatient=?,idConsultation=?,statusRdv=?,MotifStatus=? where idRdv=?; ");
        $stmt->execute(array($obj->get("d"), $obj->get("h"), $obj->get("p"), $obj->get("c"), $obj->get("s"), $obj->get("m"), $obj->get("i")));
    }

    function updateRdvStatus($statRdv, $motifStatus, $rdvId)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("UPDATE rendezvous SET statusRdv=?,MotifStatus=? where idRdv=?; ");
        $stmt->execute(array($statRdv, $motifStatus, $rdvId));
    }

    static function deleteRdv($id)
    {
        //   $pdo=$this->getPDO();
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        $stmt = $pdo->prepare("DELETE FROM rendezvous where idRdv =?; ");
        $stmt->execute(array($id));
    }


    function afficherRdv()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM rendezvous");
        $stmt->execute();
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $cli = new Rendezvous($dateRdv, $heureRdv, $idPatient, $idConsultation, $statusRdv, $MotifStatus);
            $cli->setId($idRdv);
            $clients[] = $cli;
        }
        return $clients;
    }

    function afficherMesRdv($id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM rendezvous  where idPatient  =?;");
        $stmt->execute(array($id));
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $cli = new Rendezvous($dateRdv, $heureRdv, $idPatient, $idConsultation, $statusRdv, $MotifStatus);
            $cli->setId($idRdv);
            $clients[] = $cli;
        }
        return $clients;
    }

    function afficherMesRdvJoin($id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT rendezvous.idRdv,rendezvous.dateRdv,rendezvous.heureRdv,rendezvous.statusRdv,
                         rendezvous.idConsultation,rendezvous.MotifStatus,typeconsultation.designConsultation FROM rendezvous 
                         LEFT JOIN typeconsultation ON rendezvous.idConsultation = typeconsultation.idConsultation where idPatient=?");
        //  $stmt->execute();
        $stmt->execute(array($id));
        $tabrdv = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tabrdv[] = $row;
        }
        return $tabrdv;
    }

    function afficherRdvJoin()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT rendezvous.idRdv,rendezvous.dateRdv,rendezvous.heureRdv,rendezvous.statusRdv,
                         rendezvous.idConsultation,rendezvous.MotifStatus,typeconsultation.designConsultation,patient.nom FROM rendezvous 
                         LEFT JOIN typeconsultation ON rendezvous.idConsultation = typeconsultation.idConsultation 
                         INNER JOIN patient ON rendezvous.idPatient  = patient.idPatient  
                         ");
        $stmt->execute();
        $tabrdv = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tabrdv[] = $row;
        }
        return $tabrdv;
    }




    static function getRdv($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        //  $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM rendezvous where idRdv =?;");
        $stmt->execute(array($id));

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $cli = new Rendezvous($dateRdv, $heureRdv, $idPatient, $idConsultation, $statusRdv, $MotifStatus);
            $cli->setId($idRdv);
            //$clients[]=$cli;
            return $cli;
            // return new Rendezvous($idRdv,$dateRdv,$heureRdv,$idPatient,$idConsultation,$statusRdv);
        } else
            return null;
    }

    static function getStatusRdv($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        //  $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT statusRdvS,MotifStatus FROM rendezvous where idRdv =?;");
        $stmt->execute(array($id));

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            //   $rdv=new statusRDV($statusRdvS,$MotifStatus);
            //   return  $rdv ;
            return new statusRDV($statusRdvS, $MotifStatus);
        } else
            return null;
    }




    function getRdvTotal()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT count(*) as number FROM rendezvous;");
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            return $number;
        }
        return 0;
    }

    //////resultat////////////////////////


    function ajouterResultat($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("INSERT INTO resultat(dateRes,heureRes,patientId,observation) VALUES(?,?,?,?)");
        $stmt->execute(array($obj->get("d"), $obj->get("h"), $obj->get("p"), $obj->get("o")));
    }
    function updateResultat($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("UPDATE resultat SET dateRes=?,heureRes=?,patientId=?,observation=? where idResultat=?; ");
        $stmt->execute(array($obj->get("d"), $obj->get("h"), $obj->get("p"), $obj->get("o"), $obj->get("i")));
    }

    static function deleteResultat($id)
    {
        //   $pdo=$this->getPDO();
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        $stmt = $pdo->prepare("DELETE FROM resultat where idResultat =?; ");
        $stmt->execute(array($id));
    }


    function afficherResultat()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM resultat");
        $stmt->execute();
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $cli = new Resultat($dateRes, $heureRes, $patientId, $observation);
            $cli->setId($idResultat);
            $clients[] = $cli;
        }
        return $clients;
    }

    function afficherMesResultat($id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM resultat  where patientId  =?;");
        $stmt->execute(array($id));
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $cli = new Resultat($dateRes, $heureRes, $patientId, $observation);
            $cli->setId($idResultat);
            $clients[] = $cli;
        }
        return $clients;
    }

    static function getResultat($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        //  $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM resultat where patientId =?;");
        $stmt->execute(array($id));

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $cli = new Resultat($dateRes, $heureRes, $patientId, $observation);
            $cli->setId($idResultat);
            return $cli;
            // return new Resultat($idRdv,$dateRdv,$heureRdv,$idPatient,$idConsultation,$statusRdv);
        }
        return null;
    }

    function getResultatTotal()
    {
    }
    //////TYPE CONSULTATION/////////////////////////

    function ajouterTypecons($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("INSERT INTO typeconsultation(designConsultation) VALUES(?)");
        $stmt->execute(array($obj->get("t")));
    }
    function updateTypecons($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("UPDATE typeconsultation SET designConsultation=? where idConsultation =?; ");
        $stmt->execute(array($obj->get("t"), $obj->get("i")));
    }

    static function deleteTypecons($id)
    {
        //  $pdo=$this->getPDO();
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        $stmt = $pdo->prepare("DELETE FROM typeconsultation where idConsultation  =?; ");
        $stmt->execute(array($id));
    }


    function afficherTypecons()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM typeconsultation");
        $stmt->execute();
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $cli = new Typeconsultation($idConsultation, $designConsultation);
            // $cli->setId($idConsultation);
            $clients[] = $cli;
        }
        return $clients;
    }


    static function getTypeC($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        // $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM typeconsultation where idConsultation  =?;");
        $stmt->execute(array($id));

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            return new Typeconsultation($idConsultation, $designConsultation);
        }
        return null;
    }

    function getTypeCTotal()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT count(*) as number FROM typeconsultation;");
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            return $number;
        }
        return 0;
    }

    //////decision/////////////////////////

    function ajouterDecision($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("INSERT INTO decision(dateDec,observation,idRdv,statusRdv) VALUES(?,?,?,?,?)");
        $stmt->execute(array($obj->get("d"), $obj->get("o"), $obj->get("r"), $obj->get("v")));
    }
    function updateDecision($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("UPDATE decision SET dateDec=?,observation=?,idRdv =?,statusRdv=? where idDecision =?; ");
        $stmt->execute(array($obj->get("d"), $obj->get("o"), $obj->get("r"), $obj->get("v"), $obj->get("i")));
    }

    static function deleteDecision($id)
    {
        // $pdo=$this->getPDO();
        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");
        $stmt = $pdo->prepare("DELETE FROM decision where idDecision  =?; ");
        $stmt->execute(array($id));
    }


    function afficherDecision()
    {
    }

    static function getDecision($id)
    {

        $pdo = new PDO("mysql:host=localhost;dbname=tprdv;", "root", "");

        // $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM decision where idRdv  =?;");
        $stmt->execute(array($id));

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            return new Decision($idDecision, $observation, $dateDec, $statusRdv, $idRdv);
        }
        return null;
    }

    /*static function getDecision($id){
   //***  $pdo=new PDO("mysql:host=localhost;dbname=tprdv;","root","");

    $pdo=new PDO("mysql:host=localhost;dbname=tprdv;","root","");
  
   // $pdo = $this->getPDO();
    $stmt=$pdo->prepare("SELECT * FROM decision where idRdv  =?;");
    $stmt->execute(array($id));

    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        return new Decision($idDecision,$observation,$dateDec,$statusRdv,$idRdv );
    }
    return null;
} */

    function getDecisionTotal()
    {
    }

    /////////////////////////////

    static function Stats()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tp5;", "root", "");
        $stmt = $pdo->prepare("SELECT date_format(commande.date,'%m-%y') as monthnum,date_format(commande.date,'%M %Y') as month,sum(prixVente) as prix FROM commande natural join lignecmd group by monthname(commande.date) order by `monthnum` ASC;");
        $stmt->execute();
        return $stmt;

        //** */   return 0;
    }



    static function Trending()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tp5;", "root", "");
        $stmt = $pdo->prepare("SELECT reference,count(reference) as num 
                                FROM commande natural join lignecmd 
                                where commande.date < now() and commande.date > DATE_SUB(now(), INTERVAL 7 DAY) 
                                group by reference 
                                order by `num` desc,commande.date desc limit 3;");
        $stmt->execute();
        $produits = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $produits[] = DAO::getProduit($reference);
        }
        return $produits;
    }


    //CATEGORIE////////


    //LIGNE DE CMD////////////////////////
    function ajouterLigneCmd($obj)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("INSERT INTO lignecmd VALUES(?,?,?,?)");
        $stmt->execute(array($obj->get("n"), $obj->get("q"), $obj->get("r"), $obj->get("p")));
        // $stm=$pdo->prepare("UPDATE produit SET quantiteStock = ? where reference = ?;");
        // $stm->execute(array($obj->get("i"),$obj->get("r")));
        //header("location:../Presentation/afficherClients.php");
    }

    function afficherLigneCmd($id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT reference,libelle,quantite,prixVente,(quantite*prixVente) as total FROM lignecmd natural join produit where numeroCmd=$id");
        $stmt->execute();
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clients[] = $row;
        }
        return $clients;
    }


    //LIGNE DE APPRO////////////////////////

    function afficherLigneAppro($id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT produit.reference,libelle,quantite,ligneappro.prixAchat,(quantite*ligneappro.prixAchat) as total FROM ligneAppro join produit where numeroAppro=$id");
        $stmt->execute();
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clients[] = $row;
        }
        return $clients;
    }
}
