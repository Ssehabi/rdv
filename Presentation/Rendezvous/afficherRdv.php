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
            <div class="row"><div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Rendez-vous</h3>
                    <!-- <p class="text-subtitle text-muted">Ajout d'un Patient </p> -->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                           <!-- <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li> -->
                            <li class="breadcrumb-item active" aria-current="page">Rendez-vous</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Affichage des Rendez-vous</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="email-fixed-search flex-grow-1">
                                <div class="form-group position-relative mb-0 has-icon-left">
                                    <input type="text" class="form-control" placeholder="Rechercher le nom..." id="search" onkeyup="FilterkeyWord()">
                                    <div class="form-control-icon">
                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                            <use xlink:href="../../assets/images/bootstrap-icons.svg#search"></use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                              <!--  <table class="table table-md table-striped"  id="table"> --> 
                              <table class="table table-bordered table-sm table-striped"  id="table"> 
                                    <thead>
                                        <tr>
                                            <th>Date Rdv</th>
                                            <th>Heure Rdv</th>
                                            <th>Nom patient</th>
                                          
                                            <th>Type consultation</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php

                                      //  $tab = Rendezvous::afficher();
                                        $dao = new DAO();
                                        $tab = $dao->afficherRdvJoin();
                                        echo "<tr>";
                                        foreach ($tab as $t) { ?>
                                            <tr>

                                                <td><?= $t['dateRdv'] //$t->get("dateRdv") ?></td>
                                                <td><?= $t['heureRdv'] //$t->get("h") ?></td>
                                                <td><?= $t['nom'] //$t->get("c") ?></td>
                                                <td><?= $t['designConsultation'] //$t->get("c") ?></td>

                                                <td>
                                                 <a data-bs-toggle="modal" class="btn-cr" >
                                                    <svg class=" bi" class="btn-cr" width="155" height="1em" fill="currentColor">
                                                            <?php
                                                                if ($t['statusRdv']==0) {
                                                                    // echo 'En cours ...';
                                                                      echo ' <use xlink:href="../../assets/images/bootstrap-icons.svg#clock"> </use> En cours'; 
                                                                    } elseif  ($t['statusRdv']==1) {
                                                                    // echo 'Acceptée ';
                                                                      echo ' <use xlink:href="../../assets/images/bootstrap-icons.svg#check-lg"> Accepté</use> ';
                                                                    }  elseif ($t['statusRdv']==2) {
                                                                    //echo 'Refusée';
                                                                      echo ' <use xlink:href="../../assets/images/bootstrap-icons.svg#lock"> Refusé </use> ';
                                                                  }                                                            
                                                            ?>
                                                    </svg>
                                                 </a>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a data-bs-toggle="modal" data-bs-target="#decision<?=  $t['idRdv']//$t->get("i") ?>">
                                                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#pencil">
                                                                </use>
                                                            </svg>
                                                        </a>&#124;
                                                        <a data-bs-toggle="modal" class="btn-cr" data-bs-target="#supprimer<?=  $t['idRdv']//$t->get("i") ?>">
                                                            <svg class=" bi" class="btn-cr" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#trash">
                                                                </use>
                                                            </svg>
                                                        </a>

                                                    </span>
                                                           <!-- --------------------Décision------------------- -->
                                                    <div class="modal fade bd-example-modal-xl" id="decision<?=  $t['idRdv']//$t->get("i") ?>" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Décision sur le rendez vous</h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form form-vertical" method="post" action="decisionRdv.php">
                                                                        <div class="form-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <input type="hidden" name="rdvId" value=<?=  $t['idRdv']//$t->get("i") ?>>
                                                                                 <!--   <input type="hidden" name="dateDecision" value=<//?=date("Y-m-d H:i") ?>> --->
                                                                             <!--   <div class="form-group">
                                                                                        <label for="first-name-vertical">Date RDV</label>
                                                                                        <input type="date" id="dr-name-vertical" class="form-control" name="dtRdv" placeholder="dtRdv" value= $t->get("d") ?>>
                                                                                    </div>  -->
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="email-id-vertical">Décision :</label>
                                                                                        <select name="statRdv" type="text" value="" class=" form-select" style="width: 15rem;height:2rem; background-color: var(--bs-body-bg);"> 
                                                                                        <?php
                                                                                          if ($t['statusRdv']==0) { 
                                                                                            echo "<option value='0' selected >Rien faire</option>"; }
                                                                                          else {
                                                                                             echo "<option value='0'>Rien faire</option>";} 

                                                                                          if ($t['statusRdv']==1) { 
                                                                                                echo "<option value='1' selected >Accepter</option>"; }
                                                                                              else {
                                                                                                 echo "<option value='1'>Accepter</option>";}  
                                                                                          if ($t['statusRdv']==2) { 
                                                                                                echo "<option value='2' selected >Refuser</option>"; }
                                                                                               else {
                                                                                                echo "<option value='2'>Refuser</option>";}                                                          
                                                                                        ?>
         
                                                                                        </select>
                                                                                    </div>
                                                                                    <br>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-vertical">Motif decision :</label>
                                                                                        <textarea name="motifStatus" class="form-control" rows="5" cols="35" ><?= $t['MotifStatus']//$t->get("s") ?></textarea><br>
                                                                                    </div>
                                                                                </div>                        
                                                                                    <br>                                      
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                                    <input type="submit" value="Valider" class="btn btn-primary "></input>

                                                                                 <!--   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                                    <a id="popupHref" href='decisionRdv.php?id=<//?= $t->get("i") ?>'>
                                                                                    <button type="button" class="btn btn-primary btn-danger">Accepter</button>
                                                                                    </a> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- --------------------Supprimer------------------- -->
                                                    <div class="modal fade bd-example-modal-sm" id="supprimer<?=  $t['idRdv']//$t->get("i") ?>" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                                                                    <a id="popupHref" href='supprimerRdvAdmin.php?id=<?=  $t['idRdv']//$t->get("i") ?>'>
                                                                    <button type="button" class="btn btn-primary btn-danger">Oui! Supprimer</button>
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