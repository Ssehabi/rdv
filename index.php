<?php 
        if(isset($_POST)){
          include_once(__DIR__ . '/Metier/patient.php');
            if(extract($_POST)){
            $c = new Patient($nom, $adresse, $telephone, $email,$passwrd);
            $c->save();
            $succes=true;
            }
        }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -TP Gestion Rendez vous </title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.php"><img src="assets/images/logo/logo12.png" style="height: 100px;" alt="Logo"></a>
                        
                    </div>

                    <div class="auth-logo">
                        <a data-bs-toggle="modal" class="btn-cr" data-bs-target="#inscription">
                                                            <svg class=" bi" class="btn-cr" width="1em" height="1em" fill="currentColor">
                                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#twitter"> </use>
                                                            </svg>
                                                            Inscription
                                                        </a>
                    </div>
                    
                    
                    <!-- <p class="auth-subtitle mb-4">Log in with your data that you entered during registration.</p> -->

                    <form action="Presentation/verifier.php" method="post">
                        <?php
                        if (isset($_GET['error'])) {
                            echo '<div class="alert alert-danger" role="alert">
                            Login ou password est incorrect!
                        </div>';
                            unset($_GET);
                        }
                        ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" placeholder="Adresse Email" name="login">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Mot de passe" name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Enregistere les informations
                            </label>
                        </div>
                        <input type="submit" value="Se connecter" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <br>
                    <br>
                    <br>
                    <img src="assets/images/login1.png" style="height: 600px;" alt="Logo">
                </div>
            </div>
        </div>

    </div>


           <!-------------------------inscription ---------------->
                    <div class="modal fade bd-example-modal-xl" id="inscription" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                       
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title">Inscription</h4>
                                 <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                             </div>
                                <?php
                                  /*  if(isset($succes)){
                                    echo '<div class="alert alert-light-success color-success" id="alertsucces">
                                    <i class="bi bi-check-circle"></i> Patient ajouté.
                                    </div>';
                                }
                                unset($succes);*/
                                 ?>
                             <div class="modal-body">     
                             <!--   <form class="form form-vertical" method="post" action="ajouterPatient.php"> --->
                             <form class="form form-vertical" method="post" >
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Nom</label>
                                                    <input type="text" id="first-name-vertical" class="form-control"
                                                        name="nom" placeholder="Nom">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Adresse</label>
                                                    <input type="text" id="password-vertical" class="form-control"
                                                        name="adresse" placeholder="Adresse">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Telephone</label>
                                                    <input type="number" id="contact-info-vertical" class="form-control"
                                                        name="telephone" placeholder="Telephone">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Email</label>
                                                    <input type="email" id="email-id-vertical" class="form-control"
                                                        name="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Mot de passe</label>
                                                    <input type="text" id="mdp-vertical" class="form-control"
                                                        name="passwrd" placeholder="votre mot de passe">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <input type="submit" value="Ajouter" class="btn btn-primary me-1 mb-1"
                                                    name="submit">
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                    Initialiser
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                             </div>
                            </div>
                        </div>
                    </div>

                    <!---------------------------fin inscrription ----------------------->
 
                    
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/app.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>