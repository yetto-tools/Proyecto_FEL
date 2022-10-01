<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php";

$count=0;
$sql ="";
if($empresa["id_cliente"] ==1){
  $sql = "SELECT * FROM factura";  
}
else{
  $sql = "SELECT * FROM factura WHERE '{$empresa["id_cliente"]}';";  
}
function ListaFacturacion($db,$sql){
  // Listar Empresas
  $stmt = $db->prepare($sql);
  // $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result(); // get the mysqli result
  //$titulos = $result->fetch_assoc();
  $nitVentas = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
  return $nitVentas;
}

ListaFacturacion($db,$sql);
if($_POST){
  $id         = trim($_POST["id_lista_clientes"]);
  $nit        = trim($_POST["lista_cliente_nit"]);
  $nombre     = trim($_POST["lista_cliente_nombre"]);
  $direcion   = trim($_POST["lista_cliente_direccion"]);
  $cliente_id = $empresa["id_cliente"];
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
        
          <div class="shadow-lg p-4 mb-5 bg-white rounded">
            <div class="row justify-content-center">

            <?php 
            echo"<img src=".$logo_cliente.">";
            
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>