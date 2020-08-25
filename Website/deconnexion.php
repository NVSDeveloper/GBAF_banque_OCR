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
        <link rel="stylesheet"  type="text/css" href="css/main.css">
    </head>
    <body>
        <?php require "./require/header-off.php"; ?>
           <main id="main-off">
               <img src="./img/login.png">
                       <h1>DECONNEXION</h1>
                       <p>Vous avez été déconnecté.<br><br>Vous allez être redirigé vers la page de connexion.</p>
                       
                    <meta http-equiv="refresh" content="5;login.php">
                  
               
           </main>
        <?php require "./require/footer.php"; ?>
    </body>

</html>