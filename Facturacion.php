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
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Facturacion</title>
  <?php include("link.php")?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
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
            <li><a class="dropdown-item <?php echo opcion_activa()['is_active']; ?>" href="Facturacion.php">Facturacion</a></li>
            <li><a class="dropdown-item" href="Certificacion.php">Certificacion</a></li>
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
            <a class="nav-link active"><?php echo $nombre_usuario ." (". $tipo_usuario . ")"; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Salir</a>
          </li>
        </ul>
      </div>    
    </div>
  </div>
</nav>
	<div class="container-fluid">
    <div class="row mt-5 d-flex justify-content-center">
      <div class="col col-md-9">
          <h6 class="bg-dark text-white text-center my-0"><span class="mx-2">F a c t u r a c i o n</span><span class="mx-2"> E l e c t r o n i c a</span></h6>
          <form class="shadow-lg p-3 mb-5 bg-white rounded"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
            <div class="row mb-4">
              <div class="col col-md-6 ">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAQAAACMha5pAAAAlklEQVR42u3PAQ0AAAwCoNu/9Gu4CQ3IzYq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6unqXBx4gAIE1+BdCAAAAAElFTkSuQmCC" class="img-fluid img-thumbnail rounded mx-auto d-block border" alt="logo" width="128" height="128">
              </div>
              <div class="col col-md-6">
                <div class="row">
                  <p id="nitFacturacion" name="nitFacturacion" class="h6">Su NIT</p>
                  <p id="nombreFacturacion" name="nombreFacturacion" class="h6">Su Empresa</p>
                  <p id="direccionFacturacion" name="direccionFacturacion" class="h6">Su Direccion</p>
                  <p id="" name="" class="h6">Guatemala,Guatemala</p>
                  <p id="TelefonoFacturacion" name="TelefonoFacturacion" class="h6">(502) 5555-5555</p>
                </div>
              </div>
            </div>
            <div class="row mb-4">       
              <div class="col col-md-6">
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Nit</strong></label>
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="col  pe-0">
                          <input type="text" id="nit" name="nit" class="form-control form-control-sm" placeholder="NIT" required>
                      </div>
                      <div class="col-auto ps-1">
                          <input type="button" id="buscar" name="buscar" class="btn btn-sm btn-primary" value="&#128269;">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Nombre</strong></label>
                  <div class="col-md-6 "><input type="text" id="nombre" name="nombre" class="form-control form-control-sm mb-4" placeholder="NOMBRE" required></div>
                </div>                
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Direccion</strong></label>
                  <div class="col-md-6 "><input type="text" id="direccion" nombre="direccion" class="form-control form-control-sm" placeholder="DIRECCION" required></div>
                </div>
              </div>
              <div class="col col-md-6">
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Factura N°</strong></label>
                  <div class="col-md-6 "><input type="text" id="numeroFactura" name="numeroFactura" class="form-control form-control-sm mb-4" placeholder="N° Factura" required></div>
                </div>
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Fecha:</strong></label>
                  <div class="col-md-6 "><input type="date" id="fecha" name="fecha" class="form-control form-control-sm mb-4" required></div>
                </div>                
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Total a pagar</strong></label>
                  <div class="col-md-6 "><input type="number" id="totalAPagar" name="totalAPagar" min="0.1" value="0.00" step="any" class="form-control form-control-sm " required></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <table class="table table-borderless table-sm table-striped table-hover table-wrapper border">
                  <thead class="table-dark text-center sticky-top" id="header-productos">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Codigo</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Monto</th>
                      <th scope="col"></th>                      
                    </tr>
                  </thead>
                  <tbody id="ListaProductos" class="fixed_header">
                    <tr id="1" name="linea">
                      <th scope="row" name="numero">1</th>
                      <td ><input type="text" name="producto" class="form-control form-control-sm" placeholder="Codigo" required></td>
                      <td ><textarea name="descripcion"  rows="1" class="form-control form-control-sm" placeholder="Descripcion" required></textarea></td>
                      <td ><input type="number" name="cantidad" min="1" value="1" class="form-control form-control-sm"></td>
                      <td ><input type="number" name="precio" min="0.1" value="0.00" step="any" class="form-control form-control-sm" required></td>
                      <td ><input type="number" name="monto" min="0.1" value="0.00" step="any" class="form-control form-control-sm" disabled readonly required></td>
                      <th class="text-center"><input type="button" name="quitar" class="btn btn-sm btn-danger disabled" value="&Cross;"/></th>
                    </tr> 
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row mb-4 ">
              <div class="col col-md-2 mb-4 pe-0">
                <input type="button" id="agregar" name="agregar" class="btn btn-sm btn-primary" value="+"/>
              </div>
              <div class="col col-md-10 ">
                <!-- <div class="row d-flex justify-content-end"> -->
                <div class="row">
                    <div class="col col-md-2 bg-light">
                      <input type="number" id="subtotal" name="Subtotal" min="0.1" value="0.00" step="any" class="form-control form-control-sm" disabled readonly required hidden>
                    </div>
                    <div class="col col-md-2">
                      <input type="number" id="subtotal" name="Subtotal" min="0.1" value="0.00" step="any" class="form-control form-control-sm" disabled readonly required>
                    </div>
                    <div class="col col-md-1 me-0"></div>
                    <div class="d-flex justify-content-end">
                  </div>

                <!--                   
                  <div class="col col-md-5 border">
                    <div class="row  me-0">
                      <div class="col col-md-6 bg-light align-text-bottom"></div>
                      <div class="col col-md-5">
                      </div>
                    </div> 
                    <div class="row me-0">
                      <div class="col col-md-6 bg-light align-text-bottom"><p class="fw-bolder">Descuento Q.</p></div>
                      <div class="col col-md-5">
                        <input type="number" id="descuento" name="Descuento" min="0.0" value="0.00" step="any" class="form-control form-control-sm" class="form-control form-control-sm" required>
                      </div>
                    </div>
                    <div class="row me-0">
                      <div class="col col-md-6 bg-light align-text-bottom"><p class="fw-bolder">Total Q.</p></div>
                      <div class="col col-md-5">
                        <input type="number" id="total" name="total" min="0.1" value="0.00" step="any" class="form-control form-control-sm" class="form-control form-control-sm" disabled readonly required>
                      </div>
                    </div>
                  </div>
                  -->            
                </div>
              </div>
            </div>
          </div>          
        </form>
      </div>
    </div>
	</div>
</body>
<script type="text/javascript" src="src/js/Facturacion.js"></script>
</html>

