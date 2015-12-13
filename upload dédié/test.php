<?php
session_start();
if (!isset($_SESSION['login'])) {
	header ('Location: index.php');
	echo "Vous devez etre connécté";
	exit();
}
?>	