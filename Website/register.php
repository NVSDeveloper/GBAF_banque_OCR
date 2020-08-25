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
    
    
    if (isset($_POST['register'])){
        $nom  = htmlentities(trim($_POST['nom'])); // On récupère le nom
        $prenom = htmlentities(trim($_POST['prenom'])); // on récupère le prénom
        $username = htmlentities(trim($_POST['username']));// on récupère le nom d'utilisateur
        $password = trim($_POST['password']);// On récupère le mot de passe
        $question = htmlentities(trim($_POST['question'])); // On récupère la question
        $reponse = htmlentities(trim($_POST['reponse'])); // On récupère la reponse
        $pass_hache = password_hash($password, PASSWORD_DEFAULT);
        
    // Si tout est remplis, inserer les données dans la base account
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
        <link rel="stylesheet"  type="text/css" href="css/main.css">
        
    </head>
    
    <body>
        
        <?php require "./require/header-off.php"; ?>
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img class="icon" id="return" src="../img/return.png"></a>
        <main id="main-off">
            
            
            <img src="../img/register.png">
            
            
                <form method="post">
                   <div class="champs">
                       <label>Nom : <span class="ast">*</span></label>
                        <input type="text" placeholder="Entrer votre nom" name="nom"  required>
                    </div>   
                    <div class="champs"> 
                        <label>Prénom : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entrer votre prénom" name="prenom"  required>
                    </div>
                    <div class="champs">
                        <label>Nom d'utilisateur : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username"  required>
                    </div>
                    <div class="champs">  
                        <label>Mot de passe : <span class="ast">*</span></label>
                        <input type="password" placeholder="Entrer le mot de passe" name="password"  required>
                    </div>
                    <div class="champs"> 
                        <label for="question">Question Secrète : <span class="ast">*</span></label>
                            <select id="question" name="question"  >
                                <option selected disabled >Choissisez une question Secrète</option>
                                <option value="Quel est le nom de votre premier animal de compagnie ?">Quel est le nom de votre premier animal de compagnie ?</option>
                                <option value="Quel est le nom de jeune fille de votre mère ?">Quel est le nom de jeune fille de votre mère ?</option>
                                <option value="Quel est le nom de votre ville natale ?">Quel est le nom de votre ville natale ?</option>
                                <option value="Quel est le nom de votre meilleur/e ami/e ?">Quel est le nom de votre meilleur/e ami/e ?</option>
                            </select>
                    </div>
                    <div class="champs"> 
                        <label>Réponse : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entre votre réponse" name="reponse"  required>
                    </div>
                          
                    <a href="forgot.php">Mot de passe oublié ?</a>
                   
                    <input type="submit" id='submit' name="register" value='INSCRIPTION' ><br>
                           
                </form>
            
            <a id="register" href="login.php">DEJA INSCRIT ?</a>
            
            
            <label>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</label><br>
            
        </main>
        
        <?php require "./require/footer.php"; ?>
        
    </body>

</html>

 