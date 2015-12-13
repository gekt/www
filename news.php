<?php
// on se connecte à notre base
$base = @mysql_connect ('localhost', 'root', '');
@mysql_select_db('espace_membres', $base);

// lancement de la requête. on sélectionne les news que l'on va ordonner suivant l'ordre "inverse" des dates (de la plus récente à la plus vieille : DESC) tout en ne sélectionnant que le nombre voulu de news à afficher (LIMIT)
$sql = 'SELECT auteur, titre, date, texte_news FROM news ORDER BY date DESC;';

// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
$req = @mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on compte le nombre de news stockées dans la base de données
$nb_news = mysql_num_rows($req);

if ($nb_news == 0) {
	//echo 'Aucune news enregistrée.';
	?>
	<p>Aucune news enregistrée.</p>
	<?php
}
else {
	// si on a au moins une news, on l'affiche
	while ($data = mysql_fetch_array($req)) {

	// on décompose la date
	sscanf($data['date'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);

	// on affiche les résultats
	//echo '<br />News de : ' , htmlentities(trim($data['auteur'])) , '<br />';
	//echo 'Titre : ' , htmlentities(trim($data['titre'])) , '<br />';
	//echo 'Postée le : ' , $jour , '/' , $mois , '/' , $an , ' à ' , $heure , ':' , $min , ':' , $sec , '<br /><br />';
	//echo 'News : ' , (htmlentities(trim($data['texte_news']))) , '<br />';
	?>
		<p class="news"><?php echo 'Titre : ' , htmlentities(trim($data['titre'])) , '<br />'; ?></p>
		<p class="news"><?php echo 'News : ' , (htmlentities(trim($data['texte_news']))) , '<br />'; ?></p>
		<p class="news"><?php echo '<br />News de : ' , htmlentities(trim($data['auteur'])) , '<br />'; ?></p>
		<p class="news"><?php echo 'Postée le : ' , $jour , '/' , $mois , '/' , $an , ' à ' , $heure , ':' , $min , ':' , $sec , '<br /><br />'; ?></p>
	<?php
	}
}
// on libère l'espace mémoire alloué à cette requête
mysql_free_result ($req);

// on ferme la connexion à la base de données
mysql_close ();
?>
