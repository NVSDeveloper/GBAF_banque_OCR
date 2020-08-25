<?php
include('require/bdd.php');
//Verifier si la personne est déjà connecter. Si oui, rediriger vers la page index.php
if (!isset($_SESSION['id'])){
    //Si les deux champs sont remplis, mettre dans des variables les valeurs entrées
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $req_user = $bdd->prepare("SELECT * FROM account WHERE username = ?");
    $req_user->execute([$username]);
    $result = $req_user->fetch();
   
    //Si le nom d'utilisateur correspont à un utilisateur enregister et si le mot de passe correspond, connecter la personne en créent une session.
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
        <link rel="stylesheet"  type="text/css" href="css/main.css">
        
    </head>
    
    <body>
        
        <?php require "./require/header-off.php"; ?>
        
        <main id="main-off">
            
            <img src="./img/login.png">
            
            
                <form action="login.php" method="post">
                   <div class="champs">        
                    <label>Nom d'utilisateur : <span class="ast">*</span></label><br>
                    <input type="text" name="username" placeholder="Dupont" required><br>
                   </div>   
                    <div class="champs">
                    <label>Mot de passe : <span class="ast">*</span></label><br>
                    <input type="password" name="password" placeholder="***********" required><br>
                    </div>       
                    <a href="forgot.php">Mot de passe oublié ?</a>
                   
                    <input type="submit" id='submit' value='CONNEXION' ><br>
                           
                </form>
            
            <a id="register" href="register.php">INSCRIPTION</a>
            
            <label>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</label><br>
        </main>
        
        <?php require "./require/footer.php"; ?>
        
    </body>

</html>