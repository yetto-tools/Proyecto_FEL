<?php
// Inicializar la sesión
session_start();
require_once "config.php";

if (!isset($_SESSION["loggedin"])){
  header("location: login.php");
}
else{
  $nombre_usuario = $_SESSION["usuario"]["usuario_nombre"];
  $login          = $_SESSION["usuario"]["correo"];
  $tipo_usuario   = $_SESSION["usuario"]["role"];
  $empresa        = $_SESSION["usuario"]['empresa_nombre'];
  $logo           = "data:".$_SESSION["usuario"]['imagen_formato'].";base64,".$_SESSION["usuario"]['imagen_logo'];
}

//echo '<pre>';
//var_dump($_SESSION);
//echo '</pre>';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("link.php")?>
</head>
<body>
  <?php include("navbar.php") ?>
    <div class="container-fluid">
      <div class="row mt-5 d-flex justify-content-center">
        <div class="col col-md-9">
          <h4 class="bg-info text-white text-center mb-0 py-0"><div class="mb-0"><span class="mx-2">Omisos</span></div></h4>
          <div class="shadow-lg p-4 mb-5 bg-white rounded"></div>
        </div>
      </div>
    </div>
</body>
</html>