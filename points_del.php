<?php
session_start();
$pseudo = $_SESSION['login'];
header ('Location: membre.php');
@mysql_connect("localhost", "root", "");
@mysql_select_db("espace_membres");
//mysql_query("UPDATE membre SET nb_points = nb_points + 10 WHERE login = '$pseudo' ");
@mysql_query("UPDATE membre SET nb_points = nb_points - '10' WHERE login='" . $_SESSION['login'] . "'");
?>

<!--<?php
 //@mysql_connect("localhost", "root", ""); // Connexion à la base de données
 //@mysql_select_db("espace_membres"); // Sélection de la base de données
 //$reponse = @mysql_query ("SELECT * FROM membre WHERE login='" . $_SESSION['login'] . "' "); // Requête SQL
    
 //while ($donnees = @mysql_fetch_array($reponse)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
 //{
//?>
<?php //echo $donnees['nb_points'];?>-->
<!--<?php
 //}
 //@mysql_close(); // On oubli pas de déconnecter la base de données
?>-->

<?php
//echo $donnees['nb_points'];
//echo $pseudo;
?>