<?php
// Inicializar la sesión
session_start();
if (!isset($_SESSION["login"])){
     header("location: login.php");
  }
  else{
  $nombre_usuario = $_SESSION["nombre_usuario"];
  $login          = $_SESSION["login"];
  $tipo_usuario   = $_SESSION["tipo_usuario"];
  $empresa        = $_SESSION['nombre_empresa'];
}

require_once "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registarse</title>
  <?php include("link.php")?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><?php echo $empresa ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo opcion_activa()['is_active']; ?>" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo opcion_activa()['endpoint']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#"></a></li>
            <li><a class="dropdown-item " href="Facturacion.php">Facturacion</a></li>
            <li><a class="dropdown-item <?php echo opcion_activa()['is_active']; ?>" href="Certificacion.php">Certificacion</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reportes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="reporte_cliente.php">Reporte Cliente</a></li>
            <li><a class="dropdown-item" href="repote_general.php">Reporte General</a></li>
            <li><a class="dropdown-item" href="repote_estatus.php">Reporte Estatus</a></li>
            <li><a class="dropdown-item" href="reporte_sat.php">Reporte SAT</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Otro Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#"></a></li>
            <li><a class="dropdown-item" href="#">Otra acción</a></li>
            <li><a class="dropdown-item" href="#">otro accion</a></li>
          </ul>
        </li>
      </ul>
      <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active"><?php echo $nombre_usuario ." (". $tipo_usuario . ")" ; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Salir</a>
          </li>
        </ul>
      </div>    
    </div>
  </div>
</nav>
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

