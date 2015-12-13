<?php 
include 'check.php';  //include page php
include 'nb_online.php';
include 'resultatonline.php';
?>

<?php
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {

    $base = @mysql_connect ('localhost', 'root', '');
    mysql_select_db ('espace_membres', $base);

    // on teste si une entrée de la base contient ce couple login / pass
    $sql = 'SELECT count(*) FROM membre WHERE login="'.mysql_real_escape_string($_POST['login']).'" AND pass_md5="'.mysql_real_escape_string(md5($_POST['pass'])).'"';
    $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    $data = mysql_fetch_array($req);

    mysql_free_result($req);
    mysql_close();

    // si on obtient une réponse, alors l'utilisateur est un membre
    if ($data[0] == 1) {
        session_start();
        $_SESSION['login'] = $_POST['login'];
        header('Location: membre.php');
        exit();
    }
    // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
    elseif ($data[0] == 0) {
        $erreur = "<script language='Javascript'> alert('Compte non reconnu.'); </script>";
    }
    // sinon, alors la, il y a un gros problème :)
    else {
        $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
    }
    }
    else {
    $erreur = 'Au moins un des champs est vide.';
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Mon site de test</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

    <?php
    session_start();
    if (isset($_SESSION['login']))
    {
        // le login a été enregistré dans la session, j'affiche le lien du profil
       // echo "tu es co";
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
    else
    {
        ?>
       <aside class="entete">
              <form action="index.php" method="post">
              Pseudo: <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
              MDP: <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
              <input type="submit" name="connexion" value="Connexion"><br>
              <input type="button" name="s'inscrire" value="S'inscrire" onclick="self.location.href='inscription.php'">
               <!--<a href="inscription.php">Vous inscrire</a> -->
            </form>
            <?php
                if (isset($erreur)) echo '<br /><br />',$erreur;
            ?>
            <div  class="player">Joueurs en ligne GTA: <?php echo $check ?></div>
            <div  class="player">Joueurs en ligne PIXELMON: <?php echo $check2 ?></div>
            <p>il y a <?php echo $data[0]; ?> personne actuellement sur le site !</p>
       </aside>

        <?php
        // pas de login en session : proposer la connexion
        //echo "tu n'est pas co";
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

        <?php
        /* PHP OK */
        ?>
        <aside class="contenu">
        <p><?php
        // on inclut l'affichage de nos news
        include ('news.php');
        ?></p>
        </aside>

        <aside class="menu">
        </aside>

    </body>
    <footer>
        <aside>Copyright Kevin Torre helped by Julien Thomas and Alexandre Pedro</aside>
    </footer>
</html>