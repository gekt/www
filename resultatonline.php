<?php
// on prépare une requête SQL permettant de compter le nombre de tuples (soit le nombre de clients connectés au site) contenu dans la table
$sql = 'SELECT count(*) FROM nb_online';

// on lance la requête SQL (mysql_query) et on affiche un message d'erreur si la requête ne se passait pas bien (or die)
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on récupère le nombre de tuples obtenus
$data = mysql_fetch_array($req);

// on libère l'espace mémoire alloué pour cette requête SQL
mysql_free_result($req);

//echo 'Il y a actuellement ' , $data[0] , ' personne(s) surfant sur ce site.';
?>