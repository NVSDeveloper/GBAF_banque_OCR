<?php
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
            header('Location: forgot_etape2.php');
            
        }else{
        echo 'identifiant inconnu';
    }
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
            
            
            <img src="./img/forgot.png">
            
            
                <form method="post">
            
                    <div class="champs">
                        <label>Nom d'utilisateur : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username"  required>
                    </div>

                    <input type="submit" id='submit' name="forgot" value='VALIDER' ><br>
                           
                </form>
            
            <a id="register" href="register.php">INSCRIPTION</a>
            <a id="register" href="login.php">DEJA INSCRIT ?</a>
            
            <label>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</label><br>
            
        </main>
        
        
        <?php require "./require/footer.php"; ?>
        
    </body>

</html>

 