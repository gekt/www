<?php
 	@mysql_connect("localhost", "root", ""); // Connexion à la base de données
 	@mysql_select_db("espace_membres"); // Sélection de la base de données
	$reponse = @mysql_query ("SELECT * FROM membre WHERE login='" . $_SESSION['login'] . "' "); // Requête SQL
    
 	while ($donnees = @mysql_fetch_array($reponse)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
 	{
 		$donnees['nb_points'];
 		$pointsBadge = $donnees['nb_points'];
 	}
?>

<?php
	
if ($pointsBadge >= 100) {
  //echo '<img height="20" weight="30" src="/img/badge/badge1.png">';
  $badge1 = '<img height="20" weight="30" title="Bravo tu as reçu le badge" src="/img/badge/badge_points.png">';
  @mysql_select_db("espace_membres");
  $get_badge = @mysql_query ("SELECT * FROM badge WHERE pseudo='" . $_SESSION['login'] . "' ");
  while ($data = @mysql_fetch_array($get_badge)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
  {
 		$badge_1 = $data['badge_1'];
 	}
  if ($badge_1 == 0) {
    ?>
  	<div class="achievement-banner">
    <div class="achievement-icon">
        <span class="icon"><span class="icon-trophy"></span></span>
    </div>
    <div class="achievement-text">
    	<p class="achievement-notification">Badge 100 points</p>
    	<p class="achievement-name">25G &ndash; Obtenir 100 points</p>
    	<script>var snd = new Audio("musique/GTAsong.mp3"); // buffers automatically when created
        snd.play();</script>
    </div>
  </div>
      <?php
  $update_badge = @mysql_query("UPDATE badge SET badge_1='1' WHERE pseudo='" . $_SESSION['login'] . "'");
  mysql_query($update_badge);
  }
}
else {

	$restant = 100 - $pointsBadge;
	//echo "Tu n'a pas assez de points pour obtenir ce badge!";
	if ($restant == 1) {
		$badge1 = '<img height="20" weight="30" title="Il te faut encore '.$restant.' point pour débloquer ce succès !" src="/img/badge/badge_points_incomplet.png">';
	}
	else {
		$badge1 = '<img height="20" weight="30" title="Il te faut encore '.$restant.' points pour débloquer ce succès !" src="/img/badge/badge_points_incomplet.png">';
	}
}
	
 	@mysql_close(); // On oubli pas de déconnecter la base de données
?>