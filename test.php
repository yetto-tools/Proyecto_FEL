<?php


$path = '/Proyecto_FEL';
$server = gethostname();
$port = $_SERVER['SERVER_PORT'];
$url = 'http://'.$server .":". $port . $path . '/pdf.php?facturaPDF=6';
echo $url;
file_get_contents($url.+'6');
?>