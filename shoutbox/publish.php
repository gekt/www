<?php 
session_start();
$pseudo = $_SESSION['login']
?>


<?php

require 'vendor/autoload.php';

// Configure the data store

$dir = __DIR__.'/data';

$config = new \JamesMoss\Flywheel\Config($dir, array(
    'formatter' => new \JamesMoss\Flywheel\Formatter\JSON,
));

$repo = new \JamesMoss\Flywheel\Repository('shouts', $config);
    
// Store the posted shout data to the data store

if(isset($_POST["name"]) && isset($_POST["comment"])) {
    
    $name = $pseudo;
    $name = $pseudo;

    $comment = htmlspecialchars($_POST["comment"]);
    $comment = str_replace(array("\n", "\r"), '', $comment);
    
    // Storing a new shout

    $shout = new \JamesMoss\Flywheel\Document(array(
        'text' => $comment,
        'name' => $name,
        'createdAt' => time()
    ));
    
    $repo->store($shout);
    
}
