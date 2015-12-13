<?php 

$ip = "62.210.244.80"; //GTA
$port = 36598;
        $check = file_get_contents('https://api.razex.de/server/status/' . $ip . ':' . $port . '', NULL, NULL, 128, 1);
        	//var_dump($check);
            if(empty($check['error'])) { 
                //print_r  ($online);
            }
            else {
                $online = "0";
                echo "0";
            }



?>

<?php 

$ip2 = "62.210.244.80"; //pixelmon
$port2 = 25565;
        $check2 = file_get_contents('https://api.razex.de/server/status/' . $ip2 . ':' . $port2 . '', NULL, NULL, 128, 1);
        //var_dump($check);
            if(empty($check2['error'])) { 
                //print_r  ($online2);
            }
            else {
                $online2 = "0";
                echo "0";
            }



?>
<!--GTA -->
<?php
$playerlist = file_get_contents('http://api-minecraft.net/API/php/query/playerlist/playerlist.php?ip=62.210.244.80&port=35462'); 
?>