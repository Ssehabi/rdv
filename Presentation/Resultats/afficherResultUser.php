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
                            <li class="breadcrumb-item active" aria-current="page">Gestion medecine</li>
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
                                        $tab = Resultat::afficherResultUser($_SESSION['idPatient']);
                                        // $tab = Rendezvous::afficher();
                                        echo "<tr>";
                                        foreach ($tab as $t) { ?>
                                            <tr>
                                                <td><?= $t->get("d") ?></td>
                                                <td><?= $t->get("h") ?></td>
                                                <td><?= $t->get("o") ?></td>

                                                <td>
                                                    <span>

                                                        <a data-bs-toggle="modal" data-bs-target="#consulter<?= $t->get("i") ?>">
                                                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#search-heart-fill"> </use>
                                                            </svg>
                                                        </a>


                                                    </span>


                                                    <!-- --------------------Consulter------------------- -->
                                                    <div class="modal fade bd-example-modal-xl" id="consulter<?= $t->get("i") ?>" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Consulter le Resultat</h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form form-vertical" method="post" action="">
                                                                        <div class="form-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <input type="hidden" name="id" value=<?= $t->get("i") ?>>

                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Date Resultat</label>
                                                                                        <input type="date" id="dr-name-vertical" class="form-control" name="dateRes" placeholder="dateResultat" value=<?= $t->get("d") ?> readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Heure Resultat</label>
                                                                                        <input type="time" id="hr-name-vertical" class="form-control" name="heureRes" placeholder="heureResultat" value=<?= $t->get("h") ?> readonly>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Resultat : </label>
                                                                                        <!-- <input  type="textarea" id="hr-name-vertical" class="form-control" name="observation" placeholder="Ici resultat" value=<? //= $t->get("o") 
                                                                                                                                                                                                                    ?> readonly> -->
                                                                                        <textarea name="observation" class="form-control" rows="5" cols="35" readonly><?= $t->get("o") ?></textarea><br>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                                    <!--- <input type="submit" value="Modifier" class="btn btn-primary "></input> --->

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>

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