<?php
        $result = $db->query("SELECT * FROM rol  where id_rol = '$rol' ");
        $info = $result->fetch_assoc();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand bg-dark" href="Inicio.php">
        <small><?php echo $nombre_usuario?> 
          <small>
            <?php echo"[". $info['nombre_rol'] . "]"?>
          </small>
        </small>
      </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="navbar-brand"><span class="badge bg-secondary"> / <?php echo opcion_activa()['endpoint']; ?></span></li>
      </ul>

      <ul class="navbar-nav active"> 

        <?php if($info['nombre_rol'] == 'Cliente' || $info['nombre_rol'] == 'SuperUser'): ?>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle <?php echo opcion_activa()['is_active']; ?>" href="Inicio.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu Principal
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="Inicio.php">Inicio</a></li>
              <li><a class="dropdown-item" href="Facturacion.php">Facturacion</a></li>
              <li><a class="dropdown-item" href="Ventas.php">Clientes Ventas</a></li>
              <li><a class="dropdown-item" href="Productos.php">Productos</a></li>            
              <li><a class="dropdown-item" href="Certificacion.php">Certificacion</a></li>
            </ul>
          </li>
        <?php endif ?>
        <?php if($info['nombre_rol'] == 'Staff' || $info['nombre_rol'] == 'SuperUser'): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pantalla Staff
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="Roles.php">Roles</a></li>  
          <li><a class="dropdown-item" href="Nuevo Cliente.php">Crear Staff y Clientes</a></li>  
          <li><a class="dropdown-item" href="Clientes.php">Clientes</a></li>
          <li><a class="dropdown-item" href="Estatus.php">Estatus</a></li>
          </ul>
        </li>
        <?php endif ?>
        <?php if($info['nombre_rol'] == 'Super Visor' || $info['nombre_rol'] == 'SuperUser'): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reportes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="reporte_cliente.php">Reporte Cliente</a></li>
            <li><a class="dropdown-item" href="repote_general.php">Reporte General</a></li>
            <li><a class="dropdown-item" href="repote_estatus.php">Reporte Estatus</a></li>
            <li><a class="dropdown-item" href="reporte_sat.php">Reporte SAT</a></li>
          </ul>
        </li>
        <?php endif ?>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="usuarioActivo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            
            <?php echo $empresa['nombre_cliente'] ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
