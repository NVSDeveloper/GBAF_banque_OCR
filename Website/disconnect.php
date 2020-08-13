<?php
session_start();
include('require/bdd.php');
// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

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
                       <h1>DECONEXION</h1>
                       <p>Vous avez été déconnecté.<br><br>Vous allez être redirigé vers la page de connexion.</p>
                       <meta http-equiv="refresh" content="5;login.php">
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>