<?php
session_start();
include('bdd.php'); // Fichier PHP contenant la connexion à votre BDD

// S'il y a une session alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])){
header('Location: ../index.php');
exit;
}

// Si la variable "$_Post" contient des informations alors on les traitres
if(!empty($_POST)){

    if (isset($_POST['register'])){
        $nom  = htmlentities(trim($_POST['nom'])); // On récupère le nom
        $prenom = htmlentities(trim($_POST['prenom'])); // on récupère le prénom
        $username = htmlentities(trim($_POST['username'])); // On récupère le mail
        $question = htmlentities(trim($_POST['question'])); // On récupère le mail
        $reponse = htmlentities(trim($_POST['reponse'])); // On récupère le mail
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

if(!empty($nom) && !empty($prenom) && !empty($username) && !empty($password) && !empty($question) && !empty($reponse)){

        $req_add_user = $bdd->prepare('INSERT INTO account (nom, prenom, username, password, question, reponse) VALUES(:nom, :prenom, :username, :password, :question, :reponse)');
        $req_add_user->execute(array('nom' => $nom, 'prenom' => $prenom, 'username' => $username, 'password' => $pass_hache, 'question' => $question, 'reponse' => $reponse));

        header('Location: login.php');
        exit;
}
}
}
}
?>