<?php
session_start();
include('require/bdd.php'); // Fichier PHP contenant la connexion à votre BDD

// S'il y a une session alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $nom = $_SESSION['nom'];
    $nom = strtoupper($nom);
    $prenom = $_SESSION['prenom'];
    $prenom = strtoupper($prenom);
    $username = $_SESSION['username'];
    $question = $_SESSION['question'];
    $reponse = $_SESSION['reponse'];
    
} else{
    header('Location: index.php');
}

// Si la variable "$_Post" contient des informations alors on les traitres
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    
    if (isset($_POST['update'])){
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
            $req_mod_user = "UPDATE account SET nom = '$nom', prenom = '$prenom', username = '$username', password = '$pass_hache', question = '$question', reponse = '$reponse' WHERE id_user = '$id' ";
            $stmt = $bdd->prepare($req_mod_user);
            $stmt->execute();
            $req_user = $bdd->prepare("SELECT * FROM account WHERE username = ?");
            $req_user->execute([$username]);
            $result = $req_user->fetch();
            $_SESSION['id'] = $result['id_user'];
            $_SESSION['nom'] = $result['nom'];
            $_SESSION['prenom'] = $result['prenom'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['question'] = $result['question'];
            $_SESSION['reponse'] = $result['reponse'];
            header('Location: index.php');
        exit;
        }
    }
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
        <?php require "./require/header.php"; ?>
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img class="icon" id="return" src="../img/return.png"></a>
        
           <main id="main-off">
                <img src="./img/login.png">
                       <h1>MON COMPTE</h1>
                       
                       <form  method="post" >
                           <div class="champs"> 
                        <label>Nom : <span class="ast">*</span></label>
                            <input type="text" value="<?php echo "$nom"; ?>" name="nom"  required>
                        </div>
                        <div class="champs">
                        <label>Prénom : <span class="ast">*</span></label>
                            <input type="text" value="<?php echo "$prenom"; ?>" name="prenom"  required>
                        </div>
                        <div class="champs">
                        <label>Nom d'utilisateur : <span class="ast">*</span></label>
                            <input type="text"  value="<?php echo "$username"; ?>" name="username"  required>
                        </div>
                        <div class="champs">
                        <label>Mot de passe : <span class="ast">*</span></label>
                            <input type="password" placeholder="Entrer le mot de passe" name="password"  required>
                        </div>
                        <div class="champs">
                        <label for="question">Question Secrète : <span class="ast">*</span></label>
                            <select id="question" name="question"  >
                                <option selected disabled ><?php echo "$question"; ?></option>
                                <option value="Quel est le nom de votre premier animal de compagnie ?">Quel est le nom de votre premier animal de compagnie ?</option>
                                <option value="Quel est le nom de jeune fille de votre mère ?">Quel est le nom de jeune fille de votre mère ?</option>
                                <option value="Quel est le nom de votre ville natal ?">Quel est le nom de votre ville natal ?</option>
                                <option value="Quel est le nom de votre meilleur/e ami/e ?">Quel est le nom de votre meilleur/e ami/e ?</option>
                            </select>
                        </div>
                        <div class="champs">
                        <label>Réponse : <span class="ast">*</span></label>
                            <input type="text" value="réponse" name="reponse"  required>
                           
                           </div>
                            
                           <input type="submit" id='submit' name="update "value="MODIFIER" >
                </form>
              <p>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</p>
           </main>
        <?php require "./require/footer.php"; ?>
    </body>

</html>