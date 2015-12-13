<?php 
session_start();
?>



<?php
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['change'])) {
    if ((isset($_POST['mdp_actuel']) && !empty($_POST['mdp_actuel'])) && (isset($_POST['mdp_nouveau']) && !empty($_POST['mdp_nouveau'])) && (isset($_POST['mdp_nouveau_confirm']) && !empty($_POST['mdp_nouveau_confirm']))) {

    	@mysql_connect("localhost", "root", ""); // Connexion à la base de données
 		@mysql_select_db("espace_membres"); // Sélection de la base de données
		$reponse = @mysql_query ("SELECT * FROM membre WHERE login='" . $_SESSION['login'] . "' "); // Requête SQL
    
 		while ($donnees = @mysql_fetch_array($reponse)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
 		{
 			$donnees['pass_md5'];
 			$get_mdp = $donnees['pass_md5'];
 		}

    	if ($get_mdp == md5($_POST['mdp_actuel'])) { // Si le mdp actuel est identique à l'ancien
    		if ($_POST['mdp_nouveau'] == $_POST['mdp_nouveau_confirm']) { // Si le nouveau mdp correspond à la confirmation du nouveau mdp
    			if ($get_mdp != md5($_POST['mdp_nouveau'])) { // Si les mots de passe ne sont pas identiques (actuel et nouveau)
	    			$update_mdp = "UPDATE membre SET pass_md5='" .mysql_real_escape_string(md5($_POST['mdp_nouveau'])). "' WHERE login='" . $_SESSION['login'] . "'";
	    			echo "Mot de passe modifié avec succès !";
	    			mysql_query($update_mdp) or die('Erreur SQL !'.$update_mdp.'<br />'.mysql_error());
	   				mysql_close();
	   				header ('Location: membre.php');
	   			}
	   			else {
	   				echo "Le nouveau mot de passe est identique à l'ancien";
	   			}
    		}
    		else {
    			echo "Les mots de passe ne sont pas identiques !";
    		}
    	}
    	else {
    		echo "Le mot de passe actuel ne correspond pas !";
    	}
    }
    else {
    	echo "Vous devez remplir tout les champs !";
    }
}
?>
<head>
	<meta charset="utf-8" />
</head>
        <form action="changepass.php" method="post">
        Mot de passe actuel: <input type="password" name="mdp_actuel" value="<?php if (isset($_POST['mdp_actuel'])) echo htmlentities(trim($_POST['mdp_actuel'])); ?>"><br />
        Nouveau mot de passe: <input type="password" name="mdp_nouveau" value="<?php if (isset($_POST['mdp_nouveau'])) echo htmlentities(trim($_POST['mdp_nouveau'])); ?>"><br />
        Confirmer le mot de passe: <input type="password" name="mdp_nouveau_confirm" value="<?php if (isset($_POST['mdp_nouveau_confirm'])) echo htmlentities(trim($_POST['mdp_nouveau_confirm'])); ?>"><br />
        <input type="submit" name="change" value="Changer le mot de passe"><br>
        </form>

        <a href="membre.php">Retour</a>