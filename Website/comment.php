<?php
session_start();
include('require/bdd.php');
if (isset($_SESSION['id'])){
    $id_user = $_SESSION['id'];
    $nom = $_SESSION['nom'];
    $nom = strtoupper($nom);
    $prenom = $_SESSION['prenom'];
    $prenom = strtoupper($prenom);
    $id_actor = $_POST['id_actor'];
    
    } else{
    header('Location: login.php');
}  

    if(isset($_POST['submit_commentaire'])) {
        
      if(isset($_POST['commentaire']) AND !empty($_POST['commentaire'])) {
         $commentaire = htmlspecialchars($_POST['commentaire']);
          
         if(strlen($commentaire) < 255) {
            $ins = $bdd->prepare('INSERT INTO Comments (id_user, id_actor, comment) VALUES (?,?,?)');
            $ins->execute(array($id_user, $id_actor, $commentaire));
            
         } else {
            $c_msg = "Erreur: Le ommentaire doit faire moins de 255 caractères";
         }
      } else {
         $c_msg = "Erreur: Le champs commentaire doit être complété";
      }
        header('Location: actor.php?id_actor='.$_POST['id_actor']);
        
             
   }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>GBAF</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
        <link rel="stylesheet"  type="text/css" href="css/offline.css">
        <link rel="stylesheet"  type="text/css" href="css/main.css">
        
    </head>
    <body>
           <div id="frame" class="no-frame">
               <header>
                   <img src="img/logo.png" alt="logo">
               <nav>
                       
                       <a><img src="img/user.png" alt="logo utilisateur"> &nbsp; &nbsp; <?php echo "$nom $prenom"; ?></a>
                       <a href="setting.php"><img src="img/settings.png" alt="logo parametres"></a>
                       <a href="disconnect.php"><img src="img/logout.png" alt="logo deconnexion"></a>
                   </nav>
               </header>
               <section id="commentaire">
                   <div id="content">
                       <h1>COMMENTAIRE</h1>
                       	<form method="POST">
                            <input type="hidden" value="<?php echo $id_actor ?>" name="id_actor">
   <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
</form>
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>