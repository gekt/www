<?php 
session_start();
$pseudo = $_SESSION['login']
?>

<?php
if (!isset($_SESSION['login'])) {
    header ('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Chat</title>
        
        <link rel="stylesheet" href="http://cdn.jsdelivr.net/emojione/1.3.0/assets/css/emojione.min.css"/>
        <link rel="stylesheet" href="./assets/css/styles.css" />

    </head>
    
    <body>
     
        <div class="shoutbox">
            
            <h1>Chat <img src='./assets/img/refresh.png'/></h1>
            
            <ul class="shoutbox-content"></ul>
            
            <div class="shoutbox-form">
                <h2>Poster un message <span>×</span></h2>
                
                <form action="./publish.php" method="post">
                    <label for="shoutbox-name">pseudo</label> <input type="text" disabled="disabled" id="shoutbox-name" value=<?php echo $pseudo; ?> name="name"/>
                    <label class="shoutbox-comment-label" for="shoutbox-comment">message </label> <textarea id="shoutbox-comment" name="comment" maxlength='240'></textarea>
                    <input type="submit" value="Shout!" onclick="window.location.reload();" />
                </form>
                <p><a href="../membre.php"><img height="100" weight="100" src="../img/em.png"/></a></p>
            </div>
            
        </div>

        <!---<footer>
            <a class="tz" href="http://tutorialzine.com/2015/01/shoutbox-php-jquery/">Tutorial: Making a Shoutbox with PHP and jQuery</a>
            <div id="tzine-actions"></div>
            <span class="close">✕</span>
        </footer>

        <!-- Include jQuery and the EmojiOne library -->
        <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="http://cdn.jsdelivr.net/emojione/1.3.0/lib/js/emojione.min.js"></script>
        <script src="./assets/js/script.js"></script>

    </body>
    
</html>