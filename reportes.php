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