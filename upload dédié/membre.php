
<?php
session_start();
if (!isset($_SESSION['login'])) {
	header ('Location: index.php');
	exit();
}
?>
<?php
$pseudo =  $_SESSION['login'];
?>
<?php 
include 'check.php';  //include page php
?>

<html>
<head>
<title>Espace membre</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
include("geoloc/geoipcity.inc");
include("geoloc/geoipregionvars.php");

$gi = geoip_open(realpath("geoloc/GeoLiteCity.dat"),GEOIP_STANDARD);

if ($_SERVER['REMOTE_ADDR'] != '::1') {
	$record = geoip_record_by_addr($gi,$_SERVER['REMOTE_ADDR']);
	$code = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
	$pays = $record->country_name;
	if (!in_array($code, array('FR', 'CH', 'BE', 'CA'), true)) {
		$code = "unknown";
	}
} else {
	$pays = "Switzerland";
	$code = "ch";
}

//echo "hey tu viens de "; 
//echo $record->country_name . "\n";

geoip_close($gi);

?>


  <aside class="entete">
  	<!--<img src="https://minotar.net/avatar/<?php echo $pseudo ?>/20"/>-->
  	<p>hey tu viens de: <?php echo $pays . "\n"; echo '<img height="20" weight="30" src="/img/' . $code . '.png">';?> </p>
	<p>Bienvenue <?php echo htmlentities(trim($_SESSION['login'])); ?> !</p>
	<?php
 	@mysql_connect("localhost", "root", "dhNJ7W476Z"); // Connexion à la base de données
 	@mysql_select_db("esmembre"); // Sélection de la base de données
	 $reponse = @mysql_query ("SELECT * FROM membre WHERE login='" . $_SESSION['login'] . "' "); // Requête SQL
    
 	while ($donnees = @mysql_fetch_array($reponse)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
 	{
	?>
	<p>Vos points <?php echo $donnees['nb_points'];?> !</p>
	<?php
 	}
 	@mysql_close(); // On oubli pas de déconnecter la base de données
	?>
	
	
	<a href="deconnexion.php">
	<img src="img/bouton_deco.png">
	</a>

            <div  class="player">Joueurs en ligne GTA: <?php echo $check ?></div>
            <div  class="player">Joueurs en ligne PIXELMON: <?php echo $check2 ?></div>
       </aside>

        <nav>
            <ul>
                <li style="color: blue;"><a href="index.php">Accueil</a></li>
                <li style="color: red;"><a href="#">Forum</a></li>
                <li style="color: green;"><a href="#">Boutique</a></li>
                <li style="color: purple;"><a href="membre.php">Espace Membre</a></li>
            </ul>
        </nav>

        <?php
        /* PHP */
        ?>
        <aside class="contenu">
            <p></p>

        </aside>

        <aside class="menu">
        </aside>

</body>
    <footer>
        <aside>Copyright Kevin Torre helped by Julien Thomas and Alexandre Pedro</aside>
    </footer>
</html>