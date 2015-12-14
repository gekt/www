<?php
	$i = 0;
 	@mysql_connect("localhost", "root", ""); // Connexion à la base de données
 	@mysql_select_db("espace_membres"); // Sélection de la base de données
	$reponse = @mysql_query ("SELECT * FROM messages WHERE id_destinataire='" . $id . "' AND isread=1"); // Requête SQL
    //mysql_query($reponse) or die('Erreur SQL ! '.$reponse.'<br />'.mysql_error());
 	while ($donnees = @mysql_fetch_array($reponse)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
 	{
 		$isread = ++$i;
 	}

 	if ($i == 0) {
 		$read = "Vous n'avez aucun nouveau message";

 	}
 	elseif ($i == 1) {
 		$read = "Vous avez " . $isread . " nouveau message";

 	}
 	else {
 		$read = "Vous avez " . $isread . " nouveaux messages";
 	}

?>

