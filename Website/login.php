<?php
include('require/bdd.php');
if (!isset($_SESSION['id'])){
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $req_user = $bdd->prepare("SELECT * FROM account WHERE username = ?");
    $req_user->execute([$username]);
    $result = $req_user->fetch();
   
        
    if ($username == $result['username']){
        
        if(password_verify($_POST['password'], $result['password'])){
           session_start();
            $_SESSION['id'] = $result['id_user'];
            $_SESSION['nom'] = $result['nom'];
            $_SESSION['prenom'] = $result['prenom'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['question'] = $result['question'];
            $_SESSION['reponse'] = $result['reponse'];
            
            
            header('Location: index.php');
        }
        
    }else{
        echo 'Mauvais identifiant ou mot de passe';
    }
   
    }
}else{
    header('Location: index.php');
}
  
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>GBAF</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
        <link rel="stylesheet"  type="text/css" href="css/offline.css">
    </head>
    <body>
           <div id="frame">
               <header>
                   <img src="img/logo.png" alt="logo">
               </header>
               <section id="content">
                   <div class="champs">
                       <h1>CONNEXION</h1>
                       <form action="login.php" method="post">
                       <label>Nom d'utilisateur : <span class="ast">*</span></label><br>
                       <input type="text" name="username" required><br>
                       <label>Mot de passe : <span class="ast">*</span></label><br>
                       <input type="password" name="password" required><br>
                           <label>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</label><br>
                           <input type="submit" id='submit' value='CONNEXION' ><br>
                           
                               
                        <a href="register.php">S'inscrire</a>
                        <a href="forgot.php">Mot de passe oublié ?</a>
                           
                        </form>
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>
