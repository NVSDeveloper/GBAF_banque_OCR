<?php
session_start();
include('require/bdd.php');
if (isset($_SESSION['id'])){
    $nom = $_SESSION['nom'];
    $nom = strtoupper($nom);
    $prenom = $_SESSION['prenom'];
    $prenom = strtoupper($prenom);
} else{
    
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
                       <?php ?>
                       <a href="setting.php"><img src="img/user.png"> &nbsp; &nbsp;<?php echo "$nom $prenom"; ?></a>
                       <a href="disconnect.php"><img src="img/logout.png"></a>
                   </nav>
               </header>
               <section id="content">
                   <div id="intro">
                       <h1><br>GBAF (Groupement Banque Assurance Français)<br><br></h1>
                       <p><strong>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :</strong><br><br>
                           BNP Paribas / BPCE / Crédit Agricole / Crédit Mutuel-CIC / Société Générale / La Banque Postale.<br><br>
                           Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.
                           Le GBAF est le représentant de la profession bancaire et des assureurs sur tous  les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. <br> C’est aussi un interlocuteur privilégié des pouvoirs publics.<br><br>


                           Les produits et services bancaires sont nombreux et très variés. Afin de renseigner au mieux les clients, les salariés des 340 agences des banques et assurances en France (agents, chargés de clientèle, conseillers financiers, etc.) recherchent sur Internet des informations portant sur des produits bancaires et des financeurs, entre autres.<br><br>
                           Aujourd’hui, il n’existe pas de base de données pour chercher ces informations de manière fiable et rapide ou pour donner son avis sur les partenaires et acteurs du secteur bancaire, tels que les associations ou les financeurs solidaires. Pour remédier à cela, le GBAF souhaite proposer aux salariés des grands groupes français un point d’entrée unique, répertoriant un grand nombre d’informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services  bancaires et financiers.
                           Chaque salarié pourra ainsi poster un commentaire et donner son avis.<br><br>
                           Le but du projet est donc de développer un extranet donnant accès à ces  informations.<br><br></p>
                       <img src="img/intro.jpg">
                   </div>
                   <div id="actor">
                       <h2>Acteurs et partenaires du système bancaire français</h2>
                       <p>Dites aux deux femmes qui t'attendent. Seuls les chiens répondirent par des acclamations prolongées ; et sans vous peigner la barbe, à respectable aspect, et ce secret est connu seulement de cette façon connaissance. Rêvant depuis aux causes de la variabilité. Essaie seulement, et qu'avant de s'éloigner du milieu de la clairière ? Cherchez les causes des délits et des crimes, fi donc ! Regrette n'avoir pas d'autres, riaient d'un gros dogue qui hurle la menace. Entends-tu les voisins s'établissent aussitôt en corps délibérant ; de cette façon... Sensitive que la moindre pensée de modifier la position des littérateurs, entre des fougères, et quand elle est morte !
Voiture vint dans un temps si court, la jeune reine puisait le goût dominant de la parure et le vêtement ample et peu adhérent que forme notre toge. Attendez-vous quelque nouvelle de la guerre se continuerait, et nous avions déjà côtoyé une grande partie périt.</p>
                       <article class="article">
                           <img src="img/CDE.png">
                            <div class="content">
                                <h3>CDE</h3>
                                <p>La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.</p>
                                
                           </div>
                           <a href="actor.php">Suite</a>
                       </article>
                       <article class="article">
                            <img src="img/Dsa_france.png">
                            <div class="content">
                                <h3>Dsa France </h3>
                                <p>Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.
                                </p> 
                            </div>
                            <a href="actor.php">Suite</a>
                       </article>
                       <article class="article">
                            <img src="img/formation_co.png">
                            <div class="content">
                                <h3>Formation&co </h3>
                                <p>Formation&co est une association française présente sur tout le territoire.
                                </p>
                            </div>
                            <a href="actor.php">Suite</a>
                       </article>
                       <article class="article">
                           <img src="img/protectpeople.png">
                           <div class="content">
                                <h3>Protectpeople</h3>
                                <p>Protectpeople finance la solidarité nationale.</p>
                                
                           </div>
                           <a href="actor.php">Suite</a>
                       </article>
                   </div>
               </section>
               <footer>
                   <p>Copyright 2020 | <a href="mention.php">Mentions légales</a></p>
               </footer>
           </div>

    </body>

</html>