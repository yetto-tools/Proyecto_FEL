<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php";

$count=0;
$sql ="";
if($empresa["id_cliente"] ==1){
  $sql = "SELECT * FROM lista_cliente";  
}
else{
  $sql = "SELECT * FROM lista_cliente WHERE '{$empresa["id_cliente"]}';";  
}
function ListarNITVentas($db,$sql){
  // Listar Empresas
  $stmt = $db->prepare($sql);
  // $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result(); // get the mysqli result
  //$titulos = $result->fetch_assoc();
  $nitVentas = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
  return $nitVentas;
}

ListarNITVentas($db,$sql);
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
          <h4 class="bg-warning text-white text-center mb-0 py-0"><div class="mb-0"><span class="mx-2">Crear Cliente</span></div></h4>
          <div class="shadow-lg p-4 mb-5 bg-white rounded">
            <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="form-producto" class="needs-validation" novalidate>
            <div class="row mb-2">
            <div class="col col-md-12 mb-2 d-flex justify-content-center">
              <div class="col col-md-8 text-center">
                <div class="row">                
                  <div id="liveAlertPlaceholder">
                    <div>
                      <?php echo empty($mensaje) ? "": $mensaje;  ?></div></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col col-md-12 mb-4">
                    <div class="row">
                      <div class="col col-md-3 text-start">
                        <input type="button" id="nuevo" class="btn btn-sm btn-primary" value="Nuevo &plus;" />
                      </div>                
                      <div class="col col-md-3 text-center">
                      </div>                
                      <div class="col col-md-4 text-center">
                        <button id="guardar" class="btn btn-sm btn-outline-secondary" role="button" disabled>Guardar Cambios &check;</button>
                      </div>
                      <div class="col col-md-1 text-end">
                        <button id="elilminar" type="button" class="btn btn-sm btn-outline-secondary" role="button" disabled>&cross;</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col col-md-6">
                  <div class="row" hidden>
                      <label class="col-md-4 col-form-label bg-light" ><strong>ID Registro</strong></label>
                      <div class="col-md-6" >
                        <div class="row mb-3">
                          <div class="col  pe-0">
                            <input type="hidden" id="id_lista_clientes" name="id_lista_clientes" class="form-control form-control-sm bg-light" placeholder="ID Registo" value="" readonly>
                            <div class="valid-feedback">listo!</div>
                            <div class="invalid-feedback">Campo Obligatorio!!</div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <label class="col-md-4 col-form-label bg-light"><strong>Codigo</strong></label>
                      <div class="col-md-6">
                        <div class="row mb-3">
                          <div class="col  pe-0">
                            <input type="text" id="nuevo-codigo" name="nuevo-codigo" class="form-control form-control-sm mb-2" placeholder="codigo de producto" required>
                            <div class="valid-feedback">listo!</div>
                            <div class="invalid-feedback">Campo Obligatorio!!</div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <label class="col-md-4 col-form-label bg-light"><strong>Descripcion</strong></label>
                      <div class="col-md-6">
                          <div class="row mb-3">
                              <div class="col  pe-0">
                                  <textarea type="text" id="nueva-descripcion" name="nueva-descripcion" class="form-control form-control-sm mb-2"  rows="2" cols="90" class="form-control form-control-sm" placeholder="descripcion" required></textarea>
                                  <div class="valid-feedback">listo!</div>
                                  <div class="invalid-feedback">Campo Obligatorio!!</div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-4 col-form-label bg-light"><strong>Precio</strong></label>
                        <div class="col-md-6">
                          <div class="row mb-3">
                            <div class="col  pe-0">
                              <input type="number" id="nuevo-precio" name="nuevo-precio" min="0.01" max="999999.99" step="0.01" class="form-control form-control-sm mb-2" placeholder="precio de producto" required>
                              <div class="valid-feedback">listo!</div>
                              <div class="invalid-feedback">Campo Obligatorio!!</div>
                            </div>
                          </div>
                        </div>
                    </div>
              </div>
              <!-- 2nd col -->
              <div class="col col-md-6">
             
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Imagen</strong></label>
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="col pe-0">
                        <input type="file" id="nuevo-logo" name="nuevo-logo"  accept="image/png, image/gif, image/jpeg" class="form-control form-control-sm mb-2">
                        <input type="hidden" id="base64-logo" name="base64-logo" value="">
                        <div class="valid-feedback">listo!</div>
                        <div class="invalid-feedback">Campo Obligatorio!!</div>
                        <div class="text-small">
                          <span id="img-size" class="small">tamaño: 0 KB</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Vista Previa</strong></label>
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="col  pe-0">
                        <img id="img-preview" alt="imagen-vista-previa" class="img-circle rounded mx-auto d-block border" alt="logo" width="160" height="128" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAQAAACMha5pAAAAlklEQVR42u3PAQ0AAAwCoNu/9Gu4CQ3IzYq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6unqXBx4gAIE1+BdCAAAAAElFTkSuQmCC" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <div class="row justify-content-center">
            <div class="col col-md-auto">
              <table class="table table-borderless table-sm table-striped table-hover table-wrapper border">
                <thead class="table-dark text-center sticky-top" id="header-clientes">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" hidden></th>
                    <th scope="col">NIT</th>
                    <th scope="col">Nombre</th>
                    <th scope="col" >Direccion</th>
                    <th scope="col" hidden>id_empresa</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody id="ListaProductos" class="fixed_header">
                  <?php if ($productos= ListarNITVentas($db,$sql)): ?>
                    <?php foreach($productos as $infoProducto): ?>
                      <tr id="<?= $count+=1; ?>" name="linea">
                        <th scope="row" name="numero"><?= $count; ?></th>
                        <td hidden><input type="number" name="id" class="" value="<?= $infoProducto['id']; ?>" required readonly></td>
                        <td><input type="text" name="nit" class="form-control form-control-sm" value="<?= $infoProducto['lista_cliente_nit']; ?>" disabled readonly required></td>
                        <td><input type="text" name="nombre" class="form-control form-control-sm" value="<?= $infoProducto['lista_cliente_nombre']; ?>" disabled readonly required></td>
                        <td><textarea name="direccion"  rows="1" cols="90" class="form-control form-control-sm" value="<?= $infoProducto['lista_cliente_direccion']; ?>"disabled readonly required><?= $infoProducto['lista_cliente_direccion']; ?></textarea></td>
                        <td <?php $empresa["id_cliente"]==1 ? "hidden" :"" ?>><input type="text" name="EmpreasFactura" class="form-control form-control-sm" value="<?= $infoProducto['cliente_id']; ?>" disabled readonly required></td>
                        <th class="text-center"><input type="button" name="editar" class="btn btn-sm btn-warning" value="&#9998;" tokenID="<?= $infoProducto['id_lista_clientes'] ?>"/></th>
                      </tr>
                    <?php endforeach ?>
                    </tr>
                  <?php else: ?>
                    <strong>No hay Informacion Disponible</strong>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
  <script type="text/javascript" src="src/js/Productos.js"></script>
</html>