<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php";

$count=0;

function ListarEmpresas($db){
  $sql ="SELECT *   FROM cliente;";
  $result = $db->query($sql);
  $empresas = $result->fetch_all(MYSQLI_ASSOC); // fetch data    
  return $empresas;
}

function ListaPermisos($db){
  $sql = "SELECT R.id_rol, 
    R.nombre_rol, 
    R.cliente_id, 
    C.nombre_cliente, 
    R.descripcion, 
    R.permiso_id 
  FROM 
    rol R LEFT JOIN cliente C ON 
    C.id_cliente = R.cliente_id;";  
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result(); // get the mysqli result
  $clientes = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
  return $clientes;
}

ListaPermisos($db);

// formulario para guarda
if($_POST){
  $mensaje = "";
  $id_rol =  trim($_POST["id-rol"]);
  $nit = trim($_POST["nuevo-nit"]);
  $cliente = trim($_POST["nuevo-rol"]);
  $descripcion = trim($_POST["nueva-descripcion"]);
  $cliente = trim($_POST["nuevo-cliente_id"]);
  $departamento = trim($_POST["nuevo-permiso_id"]);
  

    // hay un id entonces vamos a actualizar datos del registro
  if($id_rol){
    // comprobamos que los cambos Obligatorios no esten vacios
    try{  
      $db->begin_transaction(/*MYSQLI_TRANS_START_READ_ONLY*/);
      $query_actualizar = "UPDATE `cliente` SET `nit` = '$nit', `nombre` = '$cliente', `direccion` = '$descripcion', `telefono` = '$cliente', `municipio` = '$municipio', `departamento` = '$departamento', `logo`  = '$logo' WHERE `id` = '$id_rol' ";
      $db->query($query_actualizar);
      $db->commit();
      $mensaje = '<div class="alert alert-info alert-dismissible" role="alert">'.
      "Registro Actualizado Correctamente"
      . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    } 
    catch (Exception $e) {
      $mensaje = '<div class="alert alert-danger alert-dismissible" role="alert">'.
      $e->getMessage()
      . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
      $db->rollback();
    } // FIN CATCH
  }
    // Si no hay ID crear nuevo datos
  else{
    try{
      $db->begin_transaction(/*MYSQLI_TRANS_START_READ_ONLY*/);
      $query_insertar = "INSERT INTO `cliente` (`nit`, `nombre`, `direccion`,  `telefono`, `municipio`, `departamento`, `logo` )  
      VALUES ('$nit', '$cliente', '$descripcion',  '$cliente', '$municipio',  '$departamento', '$logo');";
      $mensaje = '<div class="alert alert-success" role="alert">'.$query_insertar.'</div>';
      $db->query($query_insertar);
      $db->commit();
      $mensaje = '<div class="alert alert-success alert-dismissible" role="alert">'.
      "Registro Creado Correctamente"
      . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    }
    catch (Exception $e) {
      $mensaje = '<div class="alert alert-danger alert-dismissible" role="alert">'.
      $e->getMessage()
      . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
      $db->rollback();
    } // FIN CATCH
  } // FIN ELSE NUEVO REGISTRO
} // FIN DE POST

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
          <h4 class="bg-danger text-white text-center mb-0 py-0"><div class="mb-0"><span class="mx-2">Lista de Roles</span></div></h4>
          <div class="shadow-lg p-4 mb-5 bg-white rounded">
            <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="form-cliente" class="needs-validation" novalidate>
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
                        <button id="eliminar" class="btn btn-sm btn-outline-secondary" role="button" disabled>&cross;</button>
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
                            <input type="hidden" id="id-rol" name="id-rol" class="form-control form-control-sm bg-light" placeholder="ID Registo" value="" readonly>
                            <div class="valid-feedback">listo!</div>
                            <div class="invalid-feedback">Campo Obligatorio!!</div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <label class="col-md-4 col-form-label bg-light"><strong>Rol</strong></label>
                      <div class="col-md-6">
                        <div class="row mb-3">
                          <div class="col  pe-0">
                            <input type="text" id="nuevo-rol" name="nuevo-rol" class="form-control form-control-sm mb-2" placeholder="rol" required>
                            <div class="valid-feedback">listo!</div>
                            <div class="invalid-feedback">Campo Obligatorio!!</div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <label class="col-md-4 col-form-label bg-light"><strong>Telefono</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col  pe-0">
                           <input type="tel"  id="nuevo-cliente_id" name="nuevo-cliente_id" class="form-control form-control-sm mb-2" placeholder="Ej. 2439-5689">
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
                           <textarea type="text" id="nueva-descripcion" name="nueva-descripcion" class="form-control form-control-sm mb-2"  rows="2" cols="90" class="form-control form-control-sm" placeholder="Direccion" required></textarea>
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
                <label class="col-md-4 col-form-label bg-light"><strong>Empresa</strong></label>
                <div class="col-md-6">
                  <div class="row mb-3">
                    <div class="col  pe-0">
                      <select id="opcionesEmpresa"  name ="cliente_id" class="form-select form-select-sm" required>
                          <option value="" selected disabled hidden>-- Eliga una Opcion --</option>
                          <?php if ($clientes = ListarEmpresas($db)): ?>
                            <?php foreach($clientes as $info): ?>
                              <option value="<?=$info['id_cliente']?>"><?=$info['nombre_cliente']." - ".$info['nit_cliente']?></option>
                            <?php endforeach ?>
                          <?php else: ?>
                            <strong>No hay Informacion Disponible</strong>
                          <?php endif ?>
                      </select>
                      <div class="valid-feedback">listo!</div>
                      <div class="invalid-feedback">Campo Obligatorio!!</div>
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
                    <th scope="col">ROL</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Empresa</th>
                    <th scope="col" hidden>Depto</th>
                    <th scope="col" hidden>Municipio</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody id="ListaPermisos" class="fixed_header">
                  <?php if ($clientes= ListaPermisos($db)): ?>
                    <?php foreach($clientes as $infoCliente): ?>
                      <tr id="<?= $count+=1; ?>" name="linea">
                        <th scope="row" name="numero"><?= $count; ?></th>
                        <td hidden><input type="number" id="id" name="id" class="" value="<?= $infoCliente['id_rol']; ?>" required readonly></td>
                        <td><input type="text" name="nit" class="form-control form-control-sm" value="<?= $infoCliente['nombre_rol']; ?>" disabled readonly required></td>
                        <td><textarea name="direccion"  rows="1" cols="90" class="form-control form-control-sm" value="<?= $infoCliente['descripcion']; ?>"disabled readonly required><?= $infoCliente['descripcion']; ?></textarea></td>
                        <td hidden><input type="text" name="cliente_id" class="form-control form-control-sm" value="<?= $infoCliente['cliente_id']; ?>" disabled readonly required></td>
                        <td hidden><input type="text" name="permiso_id" class="form-control form-control-sm" value="<?= $infoCliente['permiso_id']; ?>" disabled readonly required></td>
                        <td ><input type="text" name="cliente" class="form-control form-control-sm" value="<?= $infoCliente['nombre_cliente']; ?>" disabled readonly required></td>
                        <th class="text-center"><input type="button" name="editar" class="btn btn-sm btn-warning" value="&#9998;" tokenID="<?= $infoCliente['id_rol'] ?>"/></th>
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
  <script type="text/javascript" src="src/js/Clientes.js"></script>
</html>