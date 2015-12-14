<?php 
include 'M_checkisread.php';
?>



<?php
            @mysql_connect("localhost", "root", ""); // Connexion à la base de données
            @mysql_select_db("espace_membres"); // Sélection de la base de données
            $reponse = @mysql_query ("SELECT * FROM membre WHERE login='" . $_SESSION['login'] . "' "); // Requête SQL
            while ($donnees = @mysql_fetch_array($reponse)) { // On boucle pour afficher toutes les données et on met toutes données dans un tableau
?>
               
<?php
            }

            $sql = 'SELECT titre, date, membre.login as expediteur, messages.id as id_message FROM messages, membre WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=membre.id ORDER BY date DESC'; // on prépare une requete SQL cherchant tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
            $req = @mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); // lancement de la requete SQL
            $nb = @mysql_num_rows($req);
            $nb = $i;

            if ($nb == 0) { // Si pas de message
?>
                <?php
            }
            elseif ($nb == 1) {
?>

     <link rel="stylesheet" type="text/css" href="style.css">
  	<div class="achievement-banner">
    <div class="achievement-icon">
        <span class="icon"><span class="icon-trophy"></span></span>
    </div>
    <div class="achievement-text">
    	<p class="achievement-notification">Vous avez <?php echo $nb;?> nouveau message</p>
    	<p class="achievement-name"></p>
    	<script>var snd = new Audio("musique/M_received.mp3"); // buffers automatically when created
        snd.play();</script>
    </div>
  </div>
<?php
            }
            else { // si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
?>
     <link rel="stylesheet" type="text/css" href="style.css">
  	<div class="achievement-banner">
    <div class="achievement-icon">
        <span class="icon"><span class="icon-trophy"></span></span>
    </div>
    <div class="achievement-text">
    	<p class="achievement-notification">Vous avez <?php echo $nb;?> nouveaux messages</p>
    	<p class="achievement-name"></p>
    	<script>var snd = new Audio("musique/M_received.mp3"); // buffers automatically when created
        snd.play();</script>
    </div>
  </div>
<?php
            }

            @mysql_free_result($req);
            @mysql_close();
?>


