<?php
session_start();
include('require/bdd.php');
if (isset($_SESSION['id'])){

    header('Location: index.php');
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
                   <div class="champs">
                       <h1>MOT DE PASSE OUBLIE</h1>
                       <form>
                       <label>Nom d'utilisateur : <span class="ast">*</span></label>
                       <input type="text" >
                           <label>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</label>
                           <input type="submit" id='submit' value='SUIVANT' >
                           
                        <a href="register.php">S'inscrire</a>
                        <a href="login.php">Connexion</a>
                        </form>
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>