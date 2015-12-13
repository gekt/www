<!DOCTYPE html>

<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header ('Location: index.php');
        exit();
    }

    include 'check.php';
    include 'nb_online.php';
    include 'resultatonline.php';
    include 'sessionid.php';
    include 'badgecheck.php';
    include 'bouton_newsAdmin.php';
    include("geoloc/geoipcity.inc");
    include("geoloc/geoipregionvars.php");

    $_SESSION['id'] = $id;
    $pseudo =  $_SESSION['login'];
?>

<html>
    <head>
        <title>Espace membre</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
<?php
        $gi = geoip_open(realpath("geoloc/GeoLiteCity.dat"),GEOIP_STANDARD);

        if ($_SERVER['REMOTE_ADDR'] != '::1') {
            $record = geoip_record_by_addr($gi,$_SERVER['REMOTE_ADDR']);
            $code = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
            $pays = $record->country_name;
            if (!in_array($code, array('FR', 'CH', 'BE', 'CA'), true)) {
                $code = "Unknown";
            }
        }
        else {
            $pays = "Localhost";
            $code = "Unknown";
        }
        geoip_close($gi);
?>

        <aside class="entete">
            <p>hey tu viens de: <?php echo $pays . "\n"; echo '<img height="20" weight="30" src="/img/' . $code . '.png">';?> </p>
            <p>Bienvenue <?php echo htmlentities(trim($_SESSION['login'])); ?> !</p>
<?php
            @mysql_connect("localhost", "root", ""); // Connexion à la base de données
            @mysql_select_db("espace_membres"); // Sélection de la base de données
            $reponse = @mysql_query ("SELECT * FROM membre WHERE login='" . $_SESSION['login'] . "' "); // Requête SQL
            while ($donnees = @mysql_fetch_array($reponse)) { // On boucle pour afficher toutes les données et on met toutes données dans un tableau
?>
                <p>Vos points <?php echo $donnees['nb_points'];?> !<a href="points_add.php"><img height="20" weight="30" src="img/plus.png"/></a><a href="points_del.php"><img height="23" weight="30" src="img/moins.png"/></a></p>
<?php
            }

            $sql = 'SELECT titre, date, membre.login as expediteur, messages.id as id_message FROM messages, membre WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=membre.id ORDER BY date DESC'; // on prépare une requete SQL cherchant tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
            $req = @mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); // lancement de la requete SQL
            $nb = @mysql_num_rows($req);

            if ($nb == 0) { // Si pas de message
?>
                <p>Vous n'avez aucun message.</p>
                <?php
            }
            elseif ($nb == 1) {
?>
                <p>Vous avez <?php echo $nb; ?> message</p>
<?php
            }
            else { // si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
?>
                <p>Vous avez <?php echo $nb; ?> messages</p>
<?php
            }

            @mysql_free_result($req);
            @mysql_close();
?>

            <p>Badge 1 : <?php echo $badge1;?></p>
            <a href="deconnexion.php">
                <img src="img/bouton_deco.png" title="Se deconnecter">
            </a>
            <a href="envoyer.php">
                <img src="img/message.png" title="Envoyer un message" height="27" weight="30" >
            </a>
            <?php echo $boutonNews; ?>
            <div  class="player">Joueurs en ligne GTA: <?php echo $check ?></div>
            <div  class="player">Joueurs en ligne PIXELMON: <?php echo $check2 ?></div>
        </aside>

        <nav>
            <ul>
                <li style="color: blue;"><a href="index.php">Accueil</a></li>
                <li style="color: red;"><a href="#">Forum</a></li>
                <li style="color: green;"><a href="#">Boutique</a></li>
                <li style="color: purple;"><a href="membre.php">Espace Membre</a></li>
                <li style="color: purple;"><a href="shoutbox/shoutbox.php">Shoutbox</a></li>
            </ul>
        </nav>

        <aside class="contenu">
            <p><?php include 'listemessage.php';?></p>
        </aside>

        <aside class="menu">
        </aside>
    </body>
        <footer>
            <aside>Copyright Kevin Torre helped by Julien Thomas and Alexandre Pedro</aside>
        </footer>
</html>