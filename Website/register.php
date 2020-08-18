<?php
session_start();
include('require/bdd.php'); // Fichier PHP contenant la connexion à votre BDD

// S'il y a une session alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])){
header('Location: ../index.php');
exit;
}

// Si la variable "$_Post" contient des informations alors on les traitres
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    
    if (isset($_POST['register'])){
        $nom  = htmlentities(trim($_POST['nom'])); // On récupère le nom
        $prenom = htmlentities(trim($_POST['prenom'])); // on récupère le prénom
        $username = htmlentities(trim($_POST['username']));
        $password = trim($_POST['password']);// On récupère le mail
        $question = htmlentities(trim($_POST['question'])); // On récupère le mail
        $reponse = htmlentities(trim($_POST['reponse'])); // On récupère le mail
        $pass_hache = password_hash($password, PASSWORD_DEFAULT);
    }
        
        if($valid){
            $pass_hache = password_hash($password, PASSWORD_DEFAULT);
            $req_add_user = $bdd->prepare('INSERT INTO account (nom, prenom, username, password, question, reponse) VALUES (:nom, :prenom, :username, :password, :question, :reponse)');
            $req_add_user->execute(array('nom' => $nom,'prenom' => $prenom,'username' => $username,'password' => $pass_hache,'question' => $question,'reponse' => $reponse));
            header('Location: login.php');
        exit;
        }
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
                       <h1>INSCRIPTION</h1>
                       
                       <form  method="post" >
                           
                        <label>Nom : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entrer votre nom" name="nom"  required>
                        
                        <label>Prénom : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entrer votre prénom" name="prenom"  required>
                        
                        <label>Nom d'utilisateur : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username"  required>
                        
                        <label>Mot de passe : <span class="ast">*</span></label>
                            <input type="password" placeholder="Entrer le mot de passe" name="password"  required>
                        
                        <label for="question">Question Secrète : <span class="ast">*</span></label>
                            <select id="question" name="question"  >
                                <option selected disabled >Choissisez une question Secrète</option>
                                <option value="Quel est le nom de votre premier animal de compagnie ?">Quel est le nom de votre premier animal de compagnie ?</option>
                                <option value="Quel est le nom de jeune fille de votre mère ?">Quel est le nom de jeune fille de votre mère ?</option>
                                <option value="Quel est le nom de votre ville natal ?">Quel est le nom de votre ville natal ?</option>
                                <option value="Quel est le nom de votre meilleur/e ami/e ?">Quel est le nom de votre meilleur/e ami/e ?</option>
                            </select>
                        
                        <label>Réponse : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entre votre réponse" name="reponse"  required>
                           <p>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</p>
                           <input type="submit" id='submit' name="register" value="VALIDER" >
                </form>
                       
                       
                        <a href="login.php">Connexion</a>
                        <a href="forgot.php">Mot de passe oublié ?</a>
                   </div>
                    
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>
