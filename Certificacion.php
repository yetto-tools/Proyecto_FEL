<?php
// Inicializar la sesión
session_start();

if (!isset($_SESSION["loggedin"])){
  header("location: login.php");
}
else{
  $nombre_usuario = $_SESSION["usuario"]["usuario_nombre"];
  $login          = $_SESSION["usuario"]["correo"];
  $tipo_usuario   = $_SESSION["usuario"]["role"];
  $empresa        = $_SESSION["usuario"]['empresa_nombre'];
}
require_once "config.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("link.php")?>
</head>
<body>
  <?php include("navbar.php") ?>
	<div class="container">
		<div class="text-center">
			<h1>Certificacion</h1>
		</div>
    <div class="row">
      <div class="col col-md-2"></div>
      <div class="col col-md-8">
          <form class="shadow-lg p-3 mb-5 bg-white rounded">
            <div class="row">
              <div class="col-2">
              </div>
              <div class="col-8">
                <label><strong>FECHA INCIAL</strong></label>
                <input type="date" class="form-control form-control-sm mb-4" required>
                <label><strong>FECHA FINAL</strong></label>
                <input type="date" class="form-control form-control-sm mb-4" required>
              </div>
              <div class="col-2">
              </div>
            </div>
            <div class="row">
              <div class="col-2"></div>
              <div class="col-8">
                <table class="table table-sm">
                  <thead class="table-dark">
                    <th>Fecha</th>
                    <th>N° Factura</th>
                    <th>Cliente</th>
                    <th>Status</th>
                    <th>Monto</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-2"></div>
            </div>
          </form>
      </div>
    </div>
	</div>
</body>
</html>

