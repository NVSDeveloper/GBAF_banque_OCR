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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>GBAF</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
        <link rel="stylesheet"  type="text/css" href="css/offline.css">
    </head>
    <body>
           <div id="frame">
               <header>
                   <img src="img/logo.png">
               </header>
               <section id="content">
                   <div id="disconnect" class="champs">
                       <h1>CONFIRMATION</h1>
                       <p>Votre commentaire à bien été envoyé.<br><br>Vous aller être rediriger vers l&apos;accueil</p>
                       <meta http-equiv="refresh" content="5;index.php">
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>