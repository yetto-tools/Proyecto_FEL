<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registarse</title>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">


    <a class="navbar-brand" href="#"><?php ECHO $_SESSION['username'] ?> (CLIENTE)</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pantalla Clientes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#"></a></li>
            <li><a class="dropdown-item" href="Facturacion.php">Facturacion</a></li>
            <li><a class="dropdown-item" href="Certificacion.php">Certificacion</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Salir
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#"></a></li>
            <li><a class="dropdown-item" href="#">Otra acción</a></li>
            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
          </ul>
        </li>
      </ul>
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

