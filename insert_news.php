<?php 
session_start();
?>



<?php
// on teste si le formulaire a été validé
if (isset($_POST['go']) && $_POST['go']=='Poster la news') {
	// on se connecte à notre base
	$base = @mysql_connect ('localhost', 'root', '');
	@mysql_select_db('espace_membres', $base);

	// on teste la déclaration de nos variables
	if (!isset($_POST['titre']) || !isset($_POST['news'])) {
	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
	if (empty($_POST['titre']) || empty($_POST['news'])) {
		$erreur = 'Au moins un des champs est vide.';
	}
	// si tout est bon, on peut commencer l'insertion dans la base
	else {
		// lancement de la requête d'insertion
		$sql = 'INSERT INTO news VALUES("", "'.@mysql_escape_string($_SESSION['login']).'", "'.@mysql_escape_string($_POST['titre']).'", "'.date("Y-m-d H:i:s").'", "'.@mysql_escape_string($_POST['news']).'")';

		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		@mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.@mysql_error());

		// on ferme la connexion à la base de données
		@mysql_close();

		// on redirige vers la page d'accueil du site (attention, cette redirection ne fonctionne qui si vous avez placé cette page dans un répertoire à partir de la racine du site). Si ce n'est pas le cas, veuillez entrer ici le bon chemin d'accès afin de retomber sur la page d'accueil du site.
		header('Location: ../index.php');
		// on termine le script courant
		exit();
	}
	}
}
?>
<html>
<head>
<title>Insertion d'une nouvelle news</title>
</head>

<body>

<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="insert_news.php" method="post">
<table>
<tr><td>

</td></tr><tr><td>
[b]Titre :[/b]
</td><td>
<input type="text" name="titre" maxlength="50" size="50" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>">
</td></tr><tr><td>
[b]News :[/b]
</td><td>
<textarea name="news" cols="50" rows="10"><?php if (isset($_POST['news'])) echo htmlentities(trim($_POST['news'])); ?></textarea>
</td></tr><tr><td><td align="right">
<input type="submit" name="go" value="Poster la news">
</td></tr></table>
</form>
<?php
// on affiche les erreurs éventuelles
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>