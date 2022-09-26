<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php"
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