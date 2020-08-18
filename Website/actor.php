<?php
session_start();
include('require/bdd.php');
if (isset($_SESSION['id'])){
    $nom = $_SESSION['nom'];
    $nom = strtoupper($nom);
    $prenom = $_SESSION['prenom'];
    $prenom = strtoupper($prenom);
    $id_actor = $_GET['id_actor'];
    
} else{
    header('Location: login.php');
}


    $req_actor = $bdd->prepare("SELECT * FROM actors WHERE id_actor = '$id_actor'");
    $req_actor->execute(['id_actor']);
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
           <div id="frame">
               <header>
                   <img src="img/logo.png">
                   <nav>
                    
                       <a><img src="img/user.png"> &nbsp; &nbsp;<?php echo "$nom $prenom"; ?></a>
                       <a href="setting.php"><img src="img/settings.png"></a>
                       <a href="disconnect.php"><img src="img/logout.png"></a>
                   </nav>
               </header>
               <section id="content">
                   <?php 
                            include('require/bdd.php');
                             $req_actor = $bdd->prepare("SELECT * FROM actors WHERE id_actor = '$id_actor'");
                             $req_actor->execute(['id_actor']);
                             while ($donnees = $req_actor->fetch()) 
                             { 
                       ?>
                   <div id="detail_actor">
                       <img src="img/<?php echo $donnees['logo'];?>">
                       <h2><br><?php echo $donnees['name'];?><br><br></h2>
                       <a href="<?php echo $donnees['link'];?>">lien vers site</a>
                       <p><?php echo $donnees['content'];?></p>
                   </div>
                   <?php }?>
                   
                   
                   <div id="comment">
                       
                       <div id="top-comment">
                           <?php 
                            include('require/bdd.php');
                            $requete = $bdd->prepare("SELECT COUNT(id_comment) FROM Comments");
                            $requete->execute();
                            
                       while ($occurancy = $requete->fetch()) {

                       ?>
                       <h2><?php echo $occurancy[0];?> COMMENTAIRES</h2>
                           <?php }?>
                        <div id="reaction">
                       <input type="button" value="Nouveau"> <!-- bouton qui rend visible l'encart nouveau commentaire -->
                       <p>nb+</p>
                       
                       <p>nb-</p><!--like dislike-->
                       <!-- countdown nombre de dislike-->
                            </div>
                        </div>
                       <div id="last-comment">
                           <?php 
                            include('require/bdd.php');
                             $req_comments = $bdd->prepare("SELECT a.nom AS name_user,  c.date AS date_send, c.comment AS comment FROM Comments c INNER JOIN account a ON c.id_user = a.id_user WHERE id_actor = '$id_actor'");
                            $req_comments->execute(['id_actor']);
                             while ($allcomments = $req_comments->fetch()) 
                             { 
                       ?>
                       <article>
                           <div class="head-comment">
                           <h4><?php echo $allcomments['name_user'];?></h4>
                           <label><?php echo $allcomments['date_send'];?></label>
                           </div>
                           <p><?php echo $allcomments['comment'];?></p>
                           
                       </article>
                           <?php }?>
                           </div>
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>