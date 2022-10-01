<?php
  if (session_status() !== PHP_SESSION_ACTIVE || !isset($_SESSION["usuario"])){
    header("location: login.php");
  }
  if(session_status() === PHP_SESSION_NONE){
    session_start();
  }
  else {
  
    $nombre_usuario = $_SESSION["usuario"]["nombre_usuario"];
    $login          = $_SESSION["usuario"]["usuario"];
    $rol           = $_SESSION["usuario"]["rol_id"];
    $empresa        = $_SESSION["usuario"]["cliente"];
    $logo_cliente   = $_SESSION["usuario"]["cliente"]["logo_cliente"];
  }
?>