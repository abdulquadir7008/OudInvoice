<?php include("config.php");
ob_start();
if(isset($_REQUEST['lang'])){
	$_SESSION['lang'] = $_REQUEST['lang'];
	
}
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>