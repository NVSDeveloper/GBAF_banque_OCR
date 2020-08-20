<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
include('require/bdd.php');
if (isset($_SESSION['id'])){
    $id_user = $_SESSION['id'];
    $nom = $_SESSION['nom'];
    $nom = strtoupper($nom);
    $prenom = $_SESSION['prenom'];
    $prenom = strtoupper($prenom);
    $id_actor = $_GET['id_actor'];
   if(isset($_GET['push'])) {
       $push = $_GET['push'];
   }else{
       $push = NULL;
   }
    
} else{
    header('Location: login.php');
}
//Requete vote déja réaliser
$req_like_done = $bdd->prepare("SELECT * FROM vote WHERE id_actor = ? AND id_user = ? ");
$req_like_done->execute([$id_actor,$id_user]);
$occ = $req_like_done->RowCount();


if ($push == 'like' && $occ === 0){
    
$req_like = $bdd->prepare("INSERT INTO vote(id_user, id_actor, vote) VALUE (:id_user, :id_actor, :vote)");
$req_like->execute(array('id_user' => $_SESSION['id'],'id_actor' => $id_actor,'vote' => 1));
    //header("Location: ".$_SERVER['REQUEST_URI']);
}


if ($push == 'dislike' && $occ === 0){
   
$req_dislike =  $bdd->prepare("INSERT INTO vote(id_user, id_actor, vote) VALUE (:id_user, :id_actor, :vote)");
$req_dislike->execute(array('id_user' => $_SESSION['id'],'id_actor' => $id_actor,'vote' => 2));
   
}
//Requete vote déja réaliser
$req_like_done = $bdd->prepare("SELECT * FROM vote WHERE id_actor = ? AND id_user = ? ");
$req_like_done->execute([$id_actor,$id_user]);
$occ = $req_like_done->RowCount();


// Requete nombres likes
$req_like = $bdd->prepare("SELECT * FROM vote WHERE vote = 1 AND id_actor = ? ");
$req_like->execute([$id_actor]);
$like = $req_like->RowCount();



// Requete nombres dislikes
$req_dislike = $bdd->prepare("SELECT * FROM vote WHERE vote = 2 AND id_actor = ? ");
$req_dislike->execute([$id_actor]);
$dislike = $req_dislike->RowCount();
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
                             $req_actor = $bdd->prepare("SELECT * FROM actors WHERE id_actor = ?");
                            $req_actor->bindValue(1, $id_actor, PDO::PARAM_INT);
                             $req_actor->execute();
                   if($req_actor->rowCount() < 1){
                      header('Location: 404.php');
                       
                   }
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
                            $requete = $bdd->prepare("SELECT COUNT(id_comment) FROM Comments WHERE id_actor = '$id_actor'");
                            $requete->execute();
                            
                       while ($occurancy = $requete->fetch()) {

                       ?>
                       <h2><?php echo $occurancy[0];?> COMMENTAIRES</h2>
                           <?php }?>
                           
                        <div id="reaction">
                            <form method="post" action="comment.php">
                                <input type="hidden" value="<?php echo $id_actor ?>" name="id_actor">
                                <button class="button" type="submit" name="new">
                                NOUVEAU</button>
                            </form>
                            
                            <?php
                                
                            
                            if($occ == 0){
                                
                            ?>
                       <a href="actor.php?id_actor=<?php echo $id_actor ?>&push=like" name="like"><img src="img/like.png"></a><p><?php echo $like;?></p>
                            
                        <a href="actor.php?id_actor=<?php echo $id_actor ?>&push=dislike" name="dislike"><img src="img/dislike.png"></a><p><?php echo $dislike;?></p>
                            
                       <?php }else{
                                
                            ?>
                         <a ><img src="img/like.png"></a><p><?php echo $like;?></p>
                            
                        <a><img src="img/dislike.png"></a><p><?php echo $dislike;?></p>
                            
                         <?php }   ?>
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