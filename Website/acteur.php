<?php
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

    if(isset($_POST['submit_commentaire'])) {
        
      if(isset($_POST['commentaire']) AND !empty($_POST['commentaire'])) {
         $commentaire = htmlspecialchars($_POST['commentaire']);
          
         if(strlen($commentaire) < 255) {
            $ins = $bdd->prepare('INSERT INTO Comments (id_user, id_actor, comment) VALUES (?,?,?)');
            $ins->execute(array($id_user, $id_actor, $commentaire));
            
         } else {
            $c_msg = "Erreur: Le commentaire doit faire moins de 255 caractères";
         }
      } else {
         $c_msg = "Erreur: Le champs commentaire doit être complété";
      }
        header('Location: acteur.php?id_actor='.$_POST['id_actor']);
        
             
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
        
        <?php require "./require/header.php"; ?>
        
        <main id="main">
            
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
                   <div id="intro-actor">
                       <img src="img/<?php echo $donnees['logo'];?>">
                       <h2><br><?php echo $donnees['name'];?><br><br></h2>
                       <a href="<?php echo $donnees['link'];?>">lien vers <?php echo $donnees['name'];?>.fr</a>
                       <p><?php echo $donnees['content'];?></p>
                   </div>
                   <?php }?>
                   
                   
                   <div id="comment">
                       
                       <div class="top-comment">
                        <?php 
                            include('require/bdd.php');
                            $requete = $bdd->prepare("SELECT COUNT(id_comment) FROM Comments WHERE id_actor = '$id_actor'");
                            $requete->execute();
                            
                       while ($occurancy = $requete->fetch()) {

                       ?> 
                       <h2><?php echo $occurancy[0];?> COMMENTAIRES</h2>
                        <?php }?>   
                           
                        <div id="reaction">
                            <a id="lien-new" href="#mobile">NOUVEAU</a>
                            <?php
                                
                            
                            if($occ == 0){
                                
                            ?>
                       <a href="acteur.php?id_actor=<?php echo $id_actor ?>&push=like" name="like"><img src="img/like.png"></a><p><?php echo $like;?></p>
                            
                        <a href="acteur.php?id_actor=<?php echo $id_actor ?>&push=dislike" name="dislike"><img src="img/dislike.png"></a><p><?php echo $dislike;?></p>
                            
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
                           <?php 
                           if($com_send == 0){ ?>
                           <div class="top-comment">
                           <h2> AJOUTER UN COMMENTAIRE</h2>
                            </div>
                
                       	<form id="mobile" method="POST">
                            
                            <input type="hidden" value="<?php echo $id_actor ?>" name="id_actor">
                            <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
                            <input type="submit" value="ENVOYER" name="submit_commentaire" />
                        </form>
                           <?php } ?>
                           </div>
                   </div>
                    
               
        </main>
        
        <?php require "./require/footer.php"; ?>
        
    </body>

</html>