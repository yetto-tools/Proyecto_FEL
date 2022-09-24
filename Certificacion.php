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
          <h4 class="bg-dark text-white text-center mb-0 py-1"><div class="mb-0"><span class="mx-2"> C e r t i f i c a c i o n</span></div></h4>

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

