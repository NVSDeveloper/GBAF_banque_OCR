<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include('require/bdd.php');
session_start();

    $username = $_SESSION['username'];
    $req_user = $bdd->prepare("SELECT * FROM account WHERE username = ?");
    $req_user->execute([$username]);
    $result = $req_user->fetch();
    $question = $result['question'];
    $reponse = $result['reponse'];
if(!empty($_POST['forgot2'])) {
    
    if ($_POST['reponse_user'] === $result['reponse']){
        $password = trim($_POST['password']);
        $pass_hache = password_hash($password, PASSWORD_DEFAULT);
        
        $req_update_user = $bdd->prepare("UPDATE account SET password = '".$pass_hache."' WHERE id_user = '".$result['id_user']."'");
        $req_update_user->execute();
        header('Location: confirm_forgot.php');
    }
    }else{
        echo 'Mauvaise réponse';
}
?>
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
                       <label>Nom d'utilisateur : </label>
                           <p><?php echo "$username"; ?></p>
                        <label>Question Secrète : </label>
                            <p><?php echo "$question"; ?></p>
                           <label>Réponse : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entre votre réponse" name="reponse_user"  required>
                           <label>Nouveau Mot de passe : <span class="ast">*</span></label>
                            <input type="password" placeholder="Entrer le mot de passe" name="password"  required>
                           <label>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</label>
                           <input type="submit" id='submit' name="forgot2" value='SUIVANT' >
                           
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