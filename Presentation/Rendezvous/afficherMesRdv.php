<!-- ----------------------------------------------------------------------------------------- -->
<!--                                          Header                                           -->
<!-- ----------------------------------------------------------------------------------------- -->

<?php $title = "Rendez-vous";
include "../templates/header.php" ?>

<!-- ----------------------------------------------------------------------------------------- -->
<!--                                          Container                                        -->
<!-- ----------------------------------------------------------------------------------------- -->

<div id="main">
    <br>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Mes Rendez-vous</h3>
                    <!-- <p class="text-subtitle text-muted">Ajout d'un Patient </p> -->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <!-- <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li> -->
                            <li class="breadcrumb-item active" aria-current="page">Gestion Medecine</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">



                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Affichage de mes Rendez-vous</h4>
                    </div>
                    <div class="card-header">
                        <a data-bs-toggle="modal" class="btn-cr" data-bs-target="#ajouter">
                            <svg class=" bi" class="btn-cr" width="1em" height="1em" fill="currentColor">
                                <use xlink:href="../../assets/images/bootstrap-icons.svg#back"> </use>
                            </svg>
                            Ajouter Rendez-vous
                        </a>
                    </div>


                    <div class="card-content">
                        <div class="card-body">
                            <div class="email-fixed-search flex-grow-1">
                                <div class="form-group position-relative mb-0 has-icon-left">
                                    <input type="text" class="form-control" placeholder="Rechercher ..." id="search" onkeyup="FilterkeyWord()">
                                    <div class="form-control-icon">
                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                            <use xlink:href="../../assets/images/bootstrap-icons.svg#search"></use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-md table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>Date Rdv</th>
                                            <th>Heure Rdv</th>
                                            <th>Type consultation</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php


                                        // $tab = Rendezvous::afficherMesRdv($_SESSION['idPatient']);
                                        //$tab = DAO::afficherMesRdvJoin($_SESSION['idPatient']);

                                        $dao = new DAO();
                                        $tab = $dao->afficherMesRdvJoin($_SESSION['idPatient']);

                                        // $tab = Rendezvous::afficher();
                                        echo "<tr>";
                                        foreach ($tab as $t) { ?>
                                            <tr>
                                                <td><?= $t['dateRdv'] //$t->get("dateRdv") 
                                                    ?></td>
                                                <td><?= $t['heureRdv'] //$t->get("h") 
                                                    ?></td>
                                                <td><?= $t['designConsultation'] //$t->get("c") 
                                                    ?></td>
                                                <td>
                                                    <a data-bs-toggle="modal" class="btn-cr">
                                                        <svg class=" bi" class="btn-cr" width="155" height="1em" fill="currentColor">
                                                            <?php if ($t['statusRdv'] == 0) { // if ($t->get("s")==0) {
                                                                echo ' <use xlink:href="../../assets/images/bootstrap-icons.svg#clock-history"> </use> En cours';
                                                            } elseif ($t['statusRdv'] == 1) { // elseif ($t->get("s")==1) {
                                                                echo ' <use xlink:href="../../assets/images/bootstrap-icons.svg#check-lg"> Accepté</use> ';
                                                            } else  echo ' <use xlink:href="../../assets/images/bootstrap-icons.svg#lock"> Refusé </use> ';
                                                            ?>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <span>

                                                        <a data-bs-toggle="modal" class="btn-cr" data-bs-target="#consulter<?= $t['idRdv'] //$t->get("i") 
                                                                                                                            ?>">
                                                            <svg class=" bi" class="btn-cr" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#search-heart-fill"> </use>
                                                            </svg>
                                                        </a>&#124;
                                                        <!--    <a data-bs-toggle="modal" class="btn-cr" data-bs-target="#status $t->get("i") ?>"> -->

                                                        <a data-bs-toggle="modal" data-bs-target="#modifier<?= $t['idRdv'] //$t->get("i") 
                                                                                                            ?>">
                                                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#pencil"> </use>
                                                            </svg>
                                                        </a>&#124;

                                                        <a data-bs-toggle="modal" class="btn-cr" data-bs-target="#supprimer<?= $t['idRdv'] //$t->get("i") 
                                                                                                                            ?>">
                                                            <svg class=" bi" class="btn-cr" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#trash"> </use>
                                                            </svg>
                                                        </a>

                                                    </span>


                                                    <!-- --------------------Modifier------------------- -->
                                                    <div class="modal fade bd-example-modal-xl" id="modifier<?= $t['idRdv'] //$t->get("i") 
                                                                                                            ?>" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Modifier le Rendez-vous</h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form form-vertical" method="post" action="modifierRdv.php">
                                                                        <div class="form-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <input type="hidden" name="id" value=<?= $t['idRdv'] // $t->get("i") 
                                                                                                                            ?>>
                                                                                    <input type="hidden" name="patientId" value=<?= $_SESSION['idPatient'] ?>>
                                                                                    <input type="hidden" name="statusRdv" value=<?= $t['statusRdv'] //$t->get("s") 
                                                                                                                                ?>>
                                                                                    <textarea name="motifStatus" class="form-control" rows="5" cols="35" hidden><?= $t['MotifStatus'] //$t->get("s") 
                                                                                                                                                                ?></textarea><br>
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Date RDV</label>
                                                                                        <input type="date" id="dr-name-vertical" class="form-control" name="dateRdv" placeholder="dateRdv" value=<?= $t['dateRdv'] //$t->get("d") 
                                                                                                                                                                                                    ?>>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Heure RDV</label>
                                                                                        <input type="time" id="hr-name-vertical" class="form-control" name="heureRdv" placeholder="heureRdv" value=<?= $t['heureRdv'] //$t->get("h") 
                                                                                                                                                                                                    ?>>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="mdp-id-vertical">Type consultation</label>
                                                                                        <select name="consultationId" type="text" value="" class=" form-select" style="width: 15rem;height:2rem; background-color: var(--bs-body-bg);">
                                                                                            <option value='0' selected>Non defini</option>
                                                                                            <?php
                                                                                            // require "../../Metier/typeconsultation.php";idConsultation

                                                                                            $tab3 = Typeconsultation::afficher();
                                                                                            foreach ($tab3 as $t3) {
                                                                                                if ($t['idConsultation'] == $t3->get("i")) {
                                                                                                    echo "<option value='" . $t3->get("i") . "' selected >" . $t3->get("t") . "</option>";
                                                                                                } else {
                                                                                                    echo "<option value='" . $t3->get("i") . "'>" . $t3->get("t") . "</option>";
                                                                                                }


                                                                                                // if ($t->get("c")==$t3->get("i")) { echo "<option value='".$t3->get("i")."' selected >".$t3->get("t")."</option>"; }
                                                                                                //  else { echo "<option value='".$t3->get("i")."'>".$t3->get("t")."</option>";}  

                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <br>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                                    <input type="submit" value="Modifier" class="btn btn-primary "></input>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- --------------------Supprimer------------------- -->
                                                    <div class="modal fade bd-example-modal-sm" id="supprimer<?= $t['idRdv'] //$t->get("i") 
                                                                                                                ?>" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h4 class="modal-title">Alert</h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- <h4 class="modal-title">Alert</h4> -->
                                                                    <p>Vous etes sure de supprimer ce Rendez-vous?!
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                    <a id="popupHref" href='supprimerRdv.php?id=<?= $t['idRdv'] // $t->get("i") 
                                                                                                                ?>'>
                                                                        <button type="button" class="btn btn-primary btn-danger">Oui!
                                                                            Supprimer</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- ------------------ consulter decision------------------- -->
                                                    <div class="modal fade bd-example-modal-xl" id="consulter<?= $t['idRdv'] //$t->get("i") 
                                                                                                                ?>" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Consultation de décision</h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                </div>
                                                                <?php
                                                                //echo 'ISfffffffffffff NULL';
                                                                // require "../../Metier/typeconsultation.php";
                                                                //   $tab5 = Typeconsultation::afficher();
                                                                //   foreach($tab5 as $t5) {    
                                                                //   echo 'yessss';                                                          
                                                                /*  $dao = new DAO();
                                                                 $decis = $dao->getDecision($t->get("i"));
                                                                 if ($decis==null) {
                                                                    echo 'IS NULL';}
                                                                    else echo 'IS not null';*/

                                                                // echo 'yessss 22';  */  
                                                                ?>
                                                                <div class="modal-body">
                                                                    <form class="form form-vertical" method="post" action="">
                                                                        <div class="form-body">
                                                                            <div class="row">
                                                                                <?php
                                                                                /*  $dao = new DAO();
                                                                              $decis = $dao->getStatusRdv($t->get("i"));*/
                                                                                /* if ($decis==null) {
                                                                                    echo '
                                                                                    <div class="col-12">      
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">En cours ...</label>
                                                                                    </div>
                                                                                </div';
                                                                                } else {*/
                                                                                ?>

                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Decision :
                                                                                            <?PHP
                                                                                            /* if ($t->get("s")==0) {
                                                                                            echo 'En cours ...';
                                                                                           } elseif  ($t->get("s")==1) {
                                                                                            echo 'Acceptée ';
                                                                                           }  elseif ($t->get("s")==2) {
                                                                                           echo 'Refusée';
                                                                                         }*/

                                                                                            if ($t['statusRdv'] == 0) {
                                                                                                // echo 'En cours ...';
                                                                                                echo '<span style="color: #222;text-align:center;">En cours ...</span>';
                                                                                            } elseif ($t['statusRdv'] == 1) {
                                                                                                // echo 'Acceptée ';
                                                                                                echo '<span style="color:#2F2;text-align:center;">Acceptée</span>';
                                                                                            } elseif ($t['statusRdv'] == 2) {
                                                                                                //echo 'Refusée';
                                                                                                echo '<span style="color:red;text-align:center;">Refusée</span>';
                                                                                            }

                                                                                            ?></label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <!-- <input type="hidden" name="id" value=>> --->
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Motif decision :</label>
                                                                                        <textarea name="motifStatus" class="form-control" rows="5" cols="35" readonly><?= $t['MotifStatus'] //$t->get("m") 
                                                                                                                                                                        ?></textarea><br>

                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                                //  }
                                                                                ?>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                                    <!-- <input type="submit" value="Ok" class="btn btn-primary "></input> -->
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ------------------fin consulter decision------------------- -->
                                                </td>
                                            </tr>

                                        <?php }
                                        echo "</tr>";
                                        ?>
                                    </tbody>
                                </table>

                                <!-- --------------------Ajouter------------------- -->
                                <div class="modal fade bd-example-modal-xl" id="ajouter" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ajouter un Rendez-vous</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form form-vertical" method="post" action="ajouterMesRdv.php">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <input type="hidden" name="patientId" value=<?= $_SESSION['idPatient'] ?>>
                                                                <input type="hidden" name="statusRdv" value=0>
                                                                <input type="hidden" name="MotifStatus" value="">

                                                                <div class="form-group">
                                                                    <label for="first-name-vertical">Date RDV</label>
                                                                    <input type="date" id="dr-name-vertical" class="form-control" name="dateRdv" placeholder="dateRdv">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-vertical">Heure RDV</label>
                                                                    <input type="time" id="hr-name-vertical" class="form-control" name="heureRdv" placeholder="heureRdv">
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="mdp-id-vertical">Type consultation</label>

                                                                    <select name="consultationId" type="text" value="" class=" form-select" style="width: 15rem;height:2rem; background-color: var(--bs-body-bg);">
                                                                        <option value='0' selected>Non defini</option>
                                                                        <?php
                                                                        // require "../../Metier/typeconsultation.php";
                                                                        $tab4 = Typeconsultation::afficher();
                                                                        foreach ($tab4 as $t4) {

                                                                            echo "<option value='" . $t4->get("i") . "'>" . $t4->get("t") . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                                                <input type="submit" value="Enregistrer" class="btn btn-primary "></input>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!---------------------------------------fin ajouter----------->
                            </div>
                        </div>
                    </div>
                </div>








            </div>
        </section>
    </div>


    <!-- ----------------------------------------------------------------------------------------- -->
    <!--                                          Footer                                          -->
    <!-- ----------------------------------------------------------------------------------------- -->

    <?php include "../templates/footer.php" ?>