<?php
 	@mysql_connect("localhost", "root", ""); // Connexion à la base de données
 	@mysql_select_db("espace_membres"); // Sélection de la base de données
	 $reponse = @mysql_query ("SELECT * FROM membre WHERE login='" . $_SESSION['login'] . "' "); // Requête SQL
    
 	while ($donnees = @mysql_fetch_array($reponse)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
 	{
 		$donnees['nb_points'];
 		$pointsBadge = $donnees['nb_points'];
 	}
 	@mysql_close(); // On oubli pas de déconnecter la base de données
?>


<?php
	
if ($pointsBadge >= 100){
  //echo '<img height="20" weight="30" src="/img/badge/badge1.png">';
  $badge1 = '<img height="20" weight="30" title="Bravo tu as reçu le badge" src="/img/badge/badge_points.png">';
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
	
?>
