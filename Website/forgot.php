<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include('require/bdd.php');
session_start();
if (!isset($_SESSION['id'])){
    if (!empty($_POST['forgot'])) {
        
    $username = htmlspecialchars(trim($_POST["username"]));
    $req_user = $bdd->prepare("SELECT username FROM account WHERE username = ?");
    $req_user->execute([$username]);
    $result = $req_user->fetch();
        
    if ($username == $result['username']){
        
            $_SESSION['username'] = $result['username'];
            header('Location: forgot2.php');
            
        }else{
        echo 'Mauvais identifiant ou mot de passe';
    }
    }
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
                       
                       <form method="post">
                       <label>Nom d'utilisateur : <span class="ast">*</span></label>
                       <input type="text" name="username" required>
                           <label>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</label>
                           <input type="submit" id='submit' name="forgot" value='SUIVANT' >
                           
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