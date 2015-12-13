<!DOCTYPE html>

<?php
    include 'check.php';
    include 'nb_online.php';
    include 'resultatonline.php';
?>

<?php
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') { // on teste si le visiteur a soumis le formulaire de connexion
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
        $base = @mysql_connect ('localhost', 'root', '');
        mysql_select_db ('espace_membres', $base);

        // on teste si une entrée de la base contient ce couple login / pass
        $sql = 'SELECT count(*) FROM membre WHERE login="'.mysql_real_escape_string($_POST['login']).'" AND pass_md5="'.mysql_real_escape_string(md5($_POST['pass'])).'"';
        $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        $data = mysql_fetch_array($req);

        mysql_free_result($req);
        mysql_close();

        if ($data[0] == 1) { // si on obtient une réponse, alors l'utilisateur est un membre
            session_start();
            $_SESSION['login'] = $_POST['login'];
            header('Location: membre.php');
            exit();
        }
        elseif ($data[0] == 0) { // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
            $erreur = "<script language='Javascript'> alert('Pseudo ou mot de passe incorrect.'); </script>";
        }
        else { // sinon, alors la, il y a un gros problème :)
            $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
        }
    }
    else {
    $erreur = 'Au moins un des champs est vide.';
    }
}
?>

<html>
    <head>
        <title>Mon site de test</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php
    session_start();
    if (isset($_SESSION['login'])) {
    // le login a été enregistré dans la session, j'affiche le lien du profil
?> 
        <aside class="entete">
                <a href="deconnexion.php">
                    <img src="img/bouton_deco.png">
                </a>
            <div  class="player">Joueurs en ligne GTA: <?php echo $check ?></div>
            <div  class="player">Joueurs en ligne PIXELMON: <?php echo $check2 ?></div>
            <p>il y a <?php echo $data[0]; ?> personne actuellement sur le site !</p>
        </aside>
<?php
    }
    else {
?>
        <!-- pas de login en session : proposer la connexion !-->
        <aside class="entete">
            <form action="index.php" method="post">
                Pseudo: <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
                MDP: <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
                <input type="submit" name="connexion" value="Connexion"><br>
                <input type="button" name="s'inscrire" value="S'inscrire" onclick="self.location.href='inscription.php'">
            </form>
<?php
                if (isset($erreur)) echo '<br /><br />',$erreur;
?>
            <div class="player">Joueurs en ligne GTA: <?php echo $check ?></div>
            <div class="player">Joueurs en ligne PIXELMON: <?php echo $check2 ?></div>
            <p>il y a <?php echo $data[0]; ?> personne actuellement sur le site !</p>
       </aside>
<?php
    }     
?>
    <nav>
        <ul>
            <li style="color: blue;"><a href="index.php">Accueil</a></li>
            <li style="color: red;"><a href="#">Forum</a></li>
            <li style="color: green;"><a href="#">Boutique</a></li>
<?php
            if (isset($_SESSION['login'])) {
?>    
                <li style="color: purple;"><a href="membre.php">Espace Membre</a></li>
                <li style="color: purple;"><a href="shoutbox/shoutbox.php">Shoutbox</a></li>
<?php
            }
?>
        </ul>
    </nav>
        <aside class="contenu">
            <p>
<?php
            include ('news.php'); // on inclut l'affichage de nos news
?>
            </p>
        </aside>

        <aside class="menu">
        </aside>

    </body>
    <footer>
        <aside>Copyright Kevin Torre helped by Julien Thomas and Alexandre Pedro</aside>
    </footer>
</html>