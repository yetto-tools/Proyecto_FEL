<?php
  if (session_status() !== PHP_SESSION_ACTIVE || !isset($_SESSION["usuario"])){
    header("location: login.php");
  }
  if(session_status() === PHP_SESSION_NONE){
    session_start();
  }
  else {
  
    $nombre_usuario = $_SESSION["usuario"]["usuario_nombre"];
    $login          = $_SESSION["usuario"]["correo"];
    $role   = $_SESSION["usuario"]["role"];
    $empresa        = $_SESSION["usuario"]["empresa"];
  }

?>