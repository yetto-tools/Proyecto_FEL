<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php";
require_once "pdf.php";
// ----------------------------------------------------


// function ListarCertificacion($db, $fechaInicial, $fechaFinal, $id_cliente){
//   $sql = "SELECT * FROM factura WHERE `factura`.`cliente_id` = ? and fecha BETWEEN ? AND ?  ORDER BY NIT";  
//   // Listar Empresas
//   $stmt = $db->prepare($sql);
//   $stmt->bind_param("iss",$id_cliente,$fechaInicial,$fechaFinal);
//   $stmt->execute();
//   $result = $stmt->get_result(); // get the mysqli result
//   //$titulos = $result->fetch_assoc();
//   $clientes = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
//   return $clientes;
// }

if($_GET){
  $fechaInicial = $_GET['fecha-inicial'];
  $fechaFinal = $_GET['fecha-final'];
  $id_cliente = $_GET['id_cliente'];
  CrearCertificacionPDF($id_cliente, $fechaInicial, $fechaFinal, $db);
  
  
}


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

          <form class="shadow-lg p-3 mb-5 bg-white rounded" method="get">
            <div class="row">
              <div class="col-2">
              </div>
              <div class="col-8">
              <input id="id_cliente" name="id_cliente" type="hidden" class="form-control form-control-sm mb-4" required value="<?php echo $empresa['id_cliente'] ?>">  
              <label><strong>FECHA INCIAL</strong></label>
                <input id="fecha-inicial" name="fecha-inicial" type="date" class="form-control form-control-sm mb-4" required>
                <label><strong>FECHA FINAL</strong></label>
                <input id="fecha-final" name="fecha-final" type="date" class="form-control form-control-sm mb-4" required>
              </div>
              <div class="col-2">
              <button id="consultar" type="submit" class="btn btn-success">Consultar</button>
              </div>
            </div>
          </form>
      </div>
    </div>
	</div>
</body>
<script type="text/javascript" src="src/js/Certificacion.js"></script>
</html>

