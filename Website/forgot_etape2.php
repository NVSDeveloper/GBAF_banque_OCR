<?php
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
        header('Location: login.php');
    }else{
        echo 'Mauvaise réponse';
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
                            <p><?php echo "$username"; ?></p>
                    </div>
                    <div class="champs"> 
                        <label for="question">Question Secrète : <span class="ast">*</span></label>
                                <p><?php echo "$question"; ?></p>
                    </div>
                    <div class="champs"> 
                        <label>Réponse : <span class="ast">*</span></label>
                            <input type="text" placeholder="Entre votre réponse" name="reponse"  required>
                    </div>
                    <div class="champs">  
                        <label>Mot de passe : <span class="ast">*</span></label>
                        <input type="password" placeholder="Entrer le mot de passe" name="password"  required>
                    </div>
                    
                    <input type="submit" id='submit' value='VALIDER' ><br>
                        
                </form>
            
            <label>Tout les champs avec un  <span class="ast">*</span> sont obligatoire !</label><br>
            
        </main>
        
        <?php require "./require/footer.php"; ?>
        
    </body>

</html>