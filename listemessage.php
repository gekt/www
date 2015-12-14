    <?php //messagerie
            @mysql_connect("localhost", "root", ""); // Connexion à la base de données
            @mysql_select_db("espace_membres"); // Sélection de la base de données
        // on prépare une requete SQL cherchant tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
        $sql = 'SELECT titre, date, membre.login as expediteur, messages.id as id_message FROM messages, membre WHERE id_destinataire="'.$id.'" AND id_expediteur=membre.id ORDER BY date DESC';
        // lancement de la requete SQL
        $req = @mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        $nb = @mysql_num_rows($req);

        if ($nb == 0) {
            ?>
    <!--<p>Vous n'avez aucun message.</p>-->
    <?php
        }
        else {
        // si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
        while ($data = @mysql_fetch_array($req)) {
            ?>
            <p>
            <?php echo $data['date'] ?>: <a href="lire.php?id_message=<?php echo $data['id_message'];?>"> <?php echo stripslashes(htmlentities(trim($data['titre'])))?> </a>[ Message de <?php echo stripslashes(htmlentities(trim($data['expediteur'])))?> ]<br />
            </p>
        <!--echo $data['date'] , ' - <a href="lire.php?id_message=' , $data['id_message'] , '">' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message de ' , stripslashes(htmlentities(trim($data['expediteur']))) , ' ]<br />';-->
        <?php
        }
    }
    @mysql_free_result($req);
    @mysql_close();

    //fin de messagerie?>
