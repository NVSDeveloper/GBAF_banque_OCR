<?php
session_start();
include('require/bdd.php');
if (isset($_SESSION['id'])){
    $nom = $_SESSION['nom'];
    $nom = strtoupper($nom);
    $prenom = $_SESSION['prenom'];
    $prenom = strtoupper($prenom);
} else{
    header('Location: login.php');
}

?>
<header>
    
    <a href="index.php"><img id="logo" src="../img/logo_desktop.png"></a>
    
</header>
