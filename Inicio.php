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
          <h4 class="bg-info text-white text-center mb-0 py-0"><div class="mb-0"><span class="mx-2">Omisos</span></div></h4>
          <div class="shadow-lg p-4 mb-5 bg-white rounded"></div>
          <div class="row justify-content-center">
            <div class="col col-md-auto">
              <table class="table table-borderless table-sm table-striped table-hover table-wrapper border">
                <thead class="table-dark text-center sticky-top" id="header-clientes">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" hidden></th>
                    <th scope="col">NIT</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">uuid</th>
                    <th scope="col" >Total</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody id="ListaClientes" class="fixed_header">
                  <?php if ($factura= ListaFacturacion($db,$sql)): ?>
                    <?php foreach($factura as $infoCliente): ?>
                      <tr id="<?= $count+=1; ?>" name="linea">
                        <th scope="row" name="numero"><?= $count; ?></th>
                        <td hidden><input type="number" id="id" name="id" class="" value="<?= $infoCliente['id_factura']; ?>" required readonly></td>
                        <td><input type="text" name="nit" class="form-control form-control-sm" value="<?= $infoCliente['nit']; ?>" disabled readonly required></td>
                        <td><input type="text" name="cliente" class="form-control form-control-sm" value="<?= $infoCliente['nombre']; ?>" disabled readonly required></td>
                        <td><input type="text" name="fecha" class="form-control form-control-sm" value="<?= $infoCliente['direccion']; ?>"  disabled readonly required></td>
                        <td><input type="text" name="fecha" class="form-control form-control-sm" value="<?= $infoCliente['fecha']; ?>"  disabled readonly required></td>

                        <td><textarea name="uuid"  rows="1" cols="90" class="form-control form-control-sm" value="<?= $infoCliente['factura_uuid']; ?>"disabled readonly required><?= $infoCliente['factura_uuid']; ?></textarea></td>
                        <td><input type="text" name="total" class="form-control form-control-sm" value="<?= $infoCliente['total_pagar']; ?>" disabled readonly required></td>
                        <th class="text-center"><input type="button" name="editar" class="btn btn-sm btn-warning" value="&#9998;" tokenID="<?= $infoCliente['id_factura'] ?>"/></th>
                      </tr>
                    <?php endforeach ?>
                    </tr>
                  <?php else: ?>
                    <strong>No data found</strong>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>