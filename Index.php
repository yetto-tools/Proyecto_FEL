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

//echo '<pre>';
//var_dump($_SESSION);
//echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registarse</title>
  <?php include("link.php");?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="Index.php"><?php echo $empresa ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo opcion_activa()['is_active']; ?>" href="index.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo opcion_activa()['endpoint']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#"></a></li>
            <li><a class="dropdown-item" href="Facturacion.php">Facturacion</a></li>
            <li><a class="dropdown-item" href="Certificacion.php">Certificacion</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php opcion_activa("reportes.php"); ?>" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
		<div class="text-center mb-5">
			<h1>Reportes</h1>
		</div>
		<div class="row mt-3">
			<div class="card-body">
				<div class="row shadow-lg p-5 mb-5 bg-body rounded">
					<div class="col-3">
						<div class="col">
							<div><button class="btn btn-lg btn-warning">Reporte Cliente</button> </div>
						</div>
					</div>
					<div class="col-3">
						<div class="col"> 
							<div><button class="btn btn-lg btn-warning">Reporte General</button> </div>
						</div>
					</div>
					<div class="col-3">
						<div class="col">
							<div><button class="btn btn-lg btn-warning">Reporte Estatus</button> </div>
						</div>
					</div>
					<div class="col-3">
						<div class="col">
							<div><button class="btn btn-lg btn-warning">Reporte SAT</button> </div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</body>
</html>

