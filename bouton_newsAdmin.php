<?php
 	@mysql_connect("localhost", "root", ""); // Connexion à la base de données
 	@mysql_select_db("espace_membres"); // Sélection de la base de données
	 $reponse = @mysql_query ("SELECT * FROM membre WHERE login='" . $_SESSION['login'] . "' "); // Requête SQL
    
 	while ($donnees = @mysql_fetch_array($reponse)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
 	{
 		$donnees['grade_site'];
 		$gradesite = $donnees['grade_site'];
 	}
 	@mysql_close(); // On oubli pas de déconnecter la base de données
?>


<?php
	
if ($gradesite == 1){
  //echo '<img height="20" weight="30" src="/img/badge/badge1.png">';
  $boutonNews = '<a href="insert_news.php"><img src="img/news.png" title="Poster une news" height="27" weight="30" ></a>';
}
else {

	$boutonNews = '';
}
	
?>
