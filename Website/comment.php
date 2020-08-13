<?php
session_start();
include('require/bdd.php');
if (!isset($_SESSION['id'])){

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
                   <div class="champs">
                       <h1>COMMENTAIRE</h1>
                       <textarea></textarea>
                       <form>
                        
                           <input type="submit" id='submit' value='VALIDER' >
                        </form>
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>