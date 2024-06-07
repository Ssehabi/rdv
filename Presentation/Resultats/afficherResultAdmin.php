<!-- ----------------------------------------------------------------------------------------- -->
<!--                                          Header                                           -->
<!-- ----------------------------------------------------------------------------------------- -->

<?php $title = "Resultat";
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
                    <h3>Mes Resultat</h3>
                    <!-- <p class="text-subtitle text-muted">Ajout d'un Patient </p> -->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <!-- <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li> -->
                            <li class="breadcrumb-item active" aria-current="page">Gestion des patients </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">



                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Affichage des resultats</h4>
                    </div>
                    <div class="card-header">
                        <a data-bs-toggle="modal" class="btn-cr" data-bs-target="#ajouter">
                            <svg class=" bi" class="btn-cr" width="1em" height="1em" fill="currentColor">
                                <use xlink:href="../../assets/images/bootstrap-icons.svg#back"> </use>
                            </svg>
                            Ajouter resultat
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
                                            <th>Date Resultat</th>
                                            <th>Heure Resultat</th>
                                            <th>Observation</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php


                                        //   $tab = Rendezvous::afficherResultAdmin($_SESSION['idPatient']);
                                        $tab = Resultat::afficherResultAdmin();
                                        // $tab = Rendezvous::afficher();
                                        echo "<tr>";
                                        foreach ($tab as $t) { ?>
                                            <tr>
                                                <td><?= $t->get("d") ?></td>
                                                <td><?= $t->get("h") ?></td>
                                                <td><?= $t->get("o") ?></td>

                                                <td>
                                                    <span>

                                                        <a data-bs-toggle="modal" data-bs-target="#modifier<?= $t->get("i") ?>">
                                                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#pencil"> </use>
                                                            </svg>
                                                        </a>&#124;
                                                        <a data-bs-toggle="modal" class="btn-cr" data-bs-target="#supprimer<?= $t->get("i") ?>">
                                                            <svg class=" bi" class="btn-cr" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#trash"> </use>
                                                            </svg>
                                                        </a>

                                                    </span>
                                                    <!---------------------------------------modif+supp ----------->
                                                    <!-- --------------------Modifier------------------- -->
                                                    <div class="modal fade bd-example-modal-xl" id="modifier<?= $t->get("i") ?>" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Modifier le Resultat</h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form form-vertical" method="post" action="modifierResultat.php">
                                                                        <div class="form-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <input type="hidden" name="id" value=<?= $t->get("i") ?>>

                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Date Resultat</label>
                                                                                        <input type="date" id="dr-name-vertical" class="form-control" name="dateRes" placeholder="dateResultat" value=<?= $t->get("d") ?>>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Heure Resultat</label>
                                                                                        <input type="time" id="hr-name-vertical" class="form-control" name="heureRes" placeholder="heureResultat" value=<?= $t->get("h") ?>>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="mdp-id-vertical">Nom patient</label>
                                                                                        <select name="patientId" type="text" value="" class=" form-select" style="width: 15rem;height:2rem; background-color: var(--bs-body-bg);">
                                                                                            <?php
                                                                                            $tab3 = Patient::afficherPatientAdmin();
                                                                                            foreach ($tab3 as $t3) {
                                                                                                if ($t->get("p") == $t3->get("i")) {
                                                                                                    echo "<option value='" . $t3->get("i") . "' selected >" . $t3->get("n") . "</option>";
                                                                                                } else {
                                                                                                    echo "<option value='" . $t3->get("i") . "'>" . $t3->get("n") . "</option>";
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <br>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Resultat</label>
                                                                                        <!-- <input  type="textarea" id="hr-name-vertical" class="form-control" name="observation" placeholder="Ici resultat" value=<? //= $t->get("o") 
                                                                                                                                                                                                                    ?>> -->
                                                                                        <textarea name="observation" class="form-control" rows="5" cols="35"><?= $t->get("o") ?></textarea><br>
                                                                                    </div>
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
                                                    <div class="modal fade bd-example-modal-sm" id="supprimer<?= $t->get("i") ?>" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h4 class="modal-title">Alert</h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- <h4 class="modal-title">Alert</h4> -->
                                                                    <p>Vous etes sure de supprimer ce Resultat?!
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                    <a id="popupHref" href='supprimerResultat.php?id=<?= $t->get("i") ?>'>
                                                                        <button type="button" class="btn btn-primary btn-danger">Oui!
                                                                            Supprimer</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>





                                                </td>
                                            </tr>

                                        <?php }
                                        echo "</tr>";
                                        ?>
                                    </tbody>
                                </table>
                                <!--------------------------------------- ajouter----------->

                                <!-- --------------------Ajouter------------------- -->
                                <div class="modal fade bd-example-modal-xl" id="ajouter" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ajouter un Resultat</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form form-vertical" method="post" action="ajouterResultat.php">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <!-- <input type="hidden" name="patientId" value=<? //= $_SESSION['idPatient'] 
                                                                                                                    ?>> -->


                                                                <div class="form-group">
                                                                    <label for="first-name-vertical">Date Resultat</label>
                                                                    <input type="date" id="dr-name-vertical" class="form-control" name="dateRes" placeholder="dateRdv">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-vertical">Heure Resultat</label>
                                                                    <input type="time" id="hr-name-vertical" class="form-control" name="heureRes" placeholder="heureRdv">
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="mdp-id-vertical">Nom patient</label>

                                                                    <select name="patientId" type="text" value="" class=" form-select" style="width: 15rem;height:2rem; background-color: var(--bs-body-bg);">
                                                                        <!-- <option value='0'>holla</option> -->
                                                                        <?php

                                                                        $tab4 = Patient::afficherPatientAdmin();
                                                                        foreach ($tab4 as $t4) {
                                                                            echo "<option value='" . $t4->get("i") . "'>" . $t4->get("n") . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-vertical">Resultat</label>
                                                                    <!-- <input  type="textarea" id="hr-name-vertical" class="form-control" name="observation" placeholder="Ici resultat" value=""> -->
                                                                    <textarea name="observation" class="form-control" rows="5" cols="35"></textarea><br>
                                                                </div>
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