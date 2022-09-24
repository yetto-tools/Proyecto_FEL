<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="Inicio.php"><img src="<?php echo empty($logo) ? "" : $logo; ?>"  width="48" height="32" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="navbar-brand"><span class="badge bg-secondary"> / <?php echo opcion_activa()['endpoint']; ?></span></li>
      </ul>
      <ul class="navbar-nav"> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo opcion_activa()['is_active']; ?>" href="Inicio.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="Inicio.php">Inicio</a></li>
            <li><a class="dropdown-item" href="Facturacion.php">Facturacion</a></li>
            <li><a class="dropdown-item" href="Certificacion.php">Certificacion</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Panel de Administracion
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">1 opcion</a></li>
            <li><a class="dropdown-item" href="#">2 opcion</a></li>
            <li><a class="dropdown-item" href="#">3 opcion</a></li>
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
  
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="usuarioActivo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $nombre_usuario." Role: "." [". $tipo_usuario . "]" ; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
