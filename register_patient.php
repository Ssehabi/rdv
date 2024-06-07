<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once(__DIR__ . '/Metier/patient.php');

    $nom = $_POST['nom'] ?? null;
    $adresse = $_POST['adresse'] ?? null;
    $telephone = $_POST['telephone'] ?? null;
    $email = $_POST['email'] ?? null;
    $passwrd = $_POST['passwrd'] ?? null;

    if ($nom && $adresse && $telephone && $email && $passwrd) {
        $c = new Patient($nom, $adresse, $telephone, $email, $passwrd);
        $c->save();
        $succes = true;
    } else {
        // Handle the case where some data is missing
        $succes = false;
    }

    // Redirect back to the form with success or error status
    header('Location: index.html' . ($succes ? '?success=1' : '?error=1'));
    exit();
}
