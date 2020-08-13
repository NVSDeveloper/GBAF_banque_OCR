<?php
session_start();
include('require/bdd.php');
if (!isset($_SESSION['id'])){

    header('Location: login.php');
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
           <div id="frame">
               <header>
                   <img src="img/logo.png">
                   <nav>
                    
                       <a href="disconnect.php"><img src="img/user.png"> &nbsp; &nbsp;NOM PRENOM</a>
                       <a href="account.php"><img src="img/settings.png"></a>
                       <a href="disconnect.php"><img src="img/logout.png"></a>
                   </nav>
               </header>
               <section id="content">
                   <div id="detail_actor">
                       <img src="img/CDE.png">
                       <h2><br>Nom Acteur<br><br></h2>
                       <a href="http://www.CDe.fr">lien vers site</a>
                       <p>contenu textuel</p>
                   </div>
                   <div id="comment">
                       <div id="top-comment">
                       <h2>nbrs de commentaires</h2>
                        <div id="reaction">
                       <input type="button" value="Nouveau"> <!-- bouton qui rend visible l'encart nouveau commentaire -->
                       <p>nb+</p>
                       
                       <p>nb-</p><!--like dislike-->
                       <!-- countdown nombre de dislike-->
                            </div>
                        </div>
                       <div id="last-comment">
                       <article>
                           <div class="head-comment">
                           <h4>NOM</h4>
                           <label>DATE d'envoi</label>
                           </div>
                           <p>texte</p>
                           
                       </article><!--commentaire-->
                       <article>
                           <div class="head-comment">
                           <h4>NOM</h4>
                           <label>DATE d'envoi</label>
                           </div>
                           <p>texte</p>
                           
                       </article><!--commentaire-->
                       <article>
                           <div class="head-comment">
                           <h4>NOM</h4>
                           <label>DATE d'envoi</label>
                           </div>
                           <p>texte</p>
                           
                       </article><!--commentaire-->
                           </div>
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>