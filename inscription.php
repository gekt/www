<?php 
include 'check.php';  //include page php
?>

<?php
// on teste si le visiteur a soumis le formulaire
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
    // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm']))) {
    // on teste les deux mots de passe
    if ($_POST['pass'] != $_POST['pass_confirm']) {
        $erreur = 'Les 2 mots de passe sont différents.';
    }
    else {
        $base = @mysql_connect ('localhost', 'root', '');
        mysql_select_db ('espace_membres', $base);

        // on recherche si ce login est déjà utilisé par un autre membre
        $sql = 'SELECT count(*) FROM membre WHERE login="'.mysql_real_escape_string($_POST['login']).'"';
        $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        $data = mysql_fetch_array($req);

        if ($data[0] == 0) {
        $sql = 'INSERT INTO membre VALUES("", "'.mysql_real_escape_string($_POST['login']).'", "'.mysql_real_escape_string(md5($_POST['pass'])).'","0")';
        mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

        session_start();
        $_SESSION['login'] = $_POST['login'];
        header('Location: membre.php');
        exit();
        }
        else {
        $erreur = 'Un membre possède déjà ce login.';
        }
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
       <aside class="entete">
            <form action="inscription.php" method="post">
            Inscription à l'espace membre :<br />
            Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
            Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
            Confirmation du mot de passe : <input type="password" name="pass_confirm" value="<?php if (isset($_POST['pass_confirm'])) echo htmlentities(trim($_POST['pass_confirm'])); ?>"><br />
            <input type="submit" name="inscription" value="Inscription">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
            <!--<a class="inscrire" href="inscription.php">Vous inscrire</a> -->
            <div  class="player">Joueurs en ligne GTA: <?php echo $check ?></div>
            <div  class="player">Joueurs en ligne PIXELMON: <?php echo $check2 ?></div>
       </aside>

        <nav>
            <ul>
                <li style="color: blue;"><a href="index.php">Accueil</a></li>
                <li style="color: red;"><a href="#">Forum</a></li>
                <li style="color: green;"><a href="#">Boutique</a></li>
                <?php
                session_start();
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