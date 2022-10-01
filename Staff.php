<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php";

$count=0;
function ListarRoles($db){
  $sql = "SELECT @rownum:=@rownum+1 `norow`,  t.*  FROM rol t, (SELECT @rownum:=0) r";
  $result = $db->query($sql);
  $roles = $result->fetch_all(MYSQLI_ASSOC); // fetch data    
  return $roles;
}

function ListarEmpresas($db){
  $sql ="SELECT @rownum:=@rownum+1 `norow`,  C.*  FROM cliente C, (SELECT @rownum:=0) r";
  $result = $db->query($sql);
  echo "<br>".$titulos = $result->fetch_assoc()."</br>";
  $empresas = $result->fetch_all(MYSQLI_ASSOC); // fetch data    
  return $empresas;
}

function ListarRegistro($db){  
  $usuarios = "SELECT 
    u.id_usuario as id, 
    u.nombre_usuario, 
    u.usuario,
    u.es_staff, 
    u.cliente_id, 
    u.rol_id, 
    u.verificado, 
    c.nit_cliente, 
    c.nombre_cliente, 
    r.nombre_rol
  FROM usuario U 
    LEFT JOIN cliente C ON C.id_cliente = U.cliente_id 
    LEFT JOIN rol R ON R.cliente_id = C.id_cliente
    WHERE u.nombre_usuario <> 'SuperUSER';
    "
  
  ;
  // Listar Cuentas
  $count=0; 
  $stmt = $db->prepare($usuarios);
  // $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result(); // get the mysqli result
  // $titulosColumnas = array_keys($result->fetch_assoc());
  $cuentas = $result->fetch_all(MYSQLI_ASSOC); // fetch data    
  return $cuentas;
}

ListarRegistro($db);

// formulario para guarda
if($_POST){
  $mensaje = "";
  $id =  trim($_POST["id-staff"]);
  $nit = trim($_POST["nuevo-nit"]);
  $cliente = trim($_POST["nuevo-staff"]);
  $direccion = trim($_POST["nueva-direccion"]);
  $telefono = trim($_POST["nuevo-telefono"]);
  $departamento = trim($_POST["nuevo-departamento"]);
  $municipio = trim($_POST["nuevo-municipio"]);  
  $logo = $_POST["base64-logo"];
    // hay un id entonces vamos a actualizar datos del registro
  if($id){
    // comprobamos que los cambos Obligatorios no esten vacios
    try{  
      $db->begin_transaction(/*MYSQLI_TRANS_START_READ_ONLY*/);
      $query_actualizar = "UPDATE `cliente` SET `nit` = '$nit', `nombre` = '$cliente', `direccion` = '$direccion', `telefono` = '$telefono', `municipio` = '$municipio', `departamento` = '$departamento', `logo`  = '$logo' WHERE `id` = '$id' ";
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
      VALUES ('$nit', '$cliente', '$direccion',  '$telefono', '$municipio',  '$departamento', '$logo');";
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
          <h4 class="bg-info text-white text-center mb-0 py-0"><div class="mb-0"><span class="mx-2">Lista de Staff</span></div></h4>
          <div class="shadow-lg p-4 mb-5 bg-white rounded">
            <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="form-staff" class="needs-validation" novalidate>
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
                        <button id="Eliminar" class="btn btn-sm btn-outline-secondary" role="button" disabled>&cross;</button>
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
                            <input type="hidden" id="id-usuario" name="id-usuario" class="form-control form-control-sm bg-light" placeholder="ID Registo" value="" readonly>
                            <div class="valid-feedback">listo!</div>
                            <div class="invalid-feedback">Campo Obligatorio!!</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-md-4 col-form-label bg-light"><strong>Nombre Completo</strong></label>
                      <div class="col-md-6">
                        <div class="row mb-3">
                          <div class="col  pe-0">
                            <input type="text" id="nuevo-staff" name="nuevo-staff" class="form-control form-control-sm mb-2" placeholder="Nombre" required>
                            <div class="valid-feedback">listo!</div>
                            <div class="invalid-feedback">Campo Obligatorio!!</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-md-4 col-form-label bg-light"><strong>Usuario</strong></label>
                      <div class="col-md-6">
                        <div class="row mb-3">
                          <div class="col  pe-0">
                            <input type="text" id="nuevo-usuario" name="nuevo-usuario" class="form-control form-control-sm mb-2" placeholder="usuario" required>
                            <div class="valid-feedback">listo!</div>
                            <div class="invalid-feedback">Campo Obligatorio!!</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <div class="row">
                    <label class="col-md-4 col-form-label bg-light"><strong>contraseña</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col  pe-0">
                           <input type="password" id="nueva-contraseña" name="nueva-contraseña" class="form-control form-control-sm mb-2" placeholder="Escriba una Contraseña">
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
                  <label class="col-md-4 col-form-label bg-light"><strong>Es Staff</strong></label>
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="col  pe-0">
                        <div class="form-check form-switch">
                          <input id="es_staff" name="es_staff" class="form-check-input" type="checkbox" role="switch" value="">
                        </div>
                        <div class="valid-feedback">listo!</div>
                        <div class="invalid-feedback">Campo Obligatorio!!</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Empresa</strong></label>
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="col  pe-0">
                        <select id="opcionesEmpresa" class="form-select form-select-sm" required>
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
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Rol</strong></label>
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="col  pe-0">
                        <select id="opcionesRol" class="form-select form-select-sm" required>
                            <option value="" selected disabled hidden>-- Eliga una Opcion --</option>
                              <?php if ($roles = ListarRoles($db)): ?>
                                <?php foreach($roles as $info): ?>
                                  <option value="<?=$info['id_rol']?>">
                                    <?=$info['nombre_rol']." - ".$info['descripcion']?>
                                  </option>
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
            </div>
          </form>
          <div class="row justify-content-center">
            <div class="col col-md-auto">
              <table class="table table-borderless table-sm table-striped table-hover table-wrapper border">
                <thead class="table-dark text-center sticky-top" id="header-clientes">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" hidden></th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Es Staff</th>
                    <th scope="col" hidden>clitente_id</th>
                    <th scope="col" hidden>rol_id</th>
                    <th scope="col">verifcado</th>
                    <th scope="col" hidden>nit_cliente</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Rol</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody id="ListarRegistro" class="fixed_header">
                  <?php if ($cuentas= ListarRegistro($db)): ?>
                    <?php foreach($cuentas as $info): ?>
                      <tr id="<?= $count+=1; ?>" name="linea">
                        <th scope="row" name="numero">
                          <?= $count; ?>
                        </th>
                        <td hidden>
                          <input type="number" id="id" name="id" class="" 
                          value="<?= $info['id']; ?>" required readonly>
                        </td>
                        <td>
                          <input type="text" name="nombre" class="form-control form-control-sm" 
                          value="<?= $info['nombre_usuario']; ?>" disabled readonly required>
                        </td>
                        <td>
                          <input type="text" name="usuario" class="form-control form-control-sm" 
                          value="<?= $info['usuario']; ?>" disabled readonly required>
                        </td>
                        <td>
                          <input type="text" name="es_Staff" class="form-control form-control-sm" 
                          value="<?= $info['es_staff']==true ? 'SI': 'NO'; ?>" disabled readonly>
                        </td>
                        <td>
                          <input type="text" name="empresa" class="form-control form-control-sm" 
                          value="<?= $info['verificado']==true ? 'SI': 'NO'; ?>" disabled readonly>
                        </td>
                        <td>
                          <input type="text" name="nombre_cliente" class="form-control form-control-sm"
                          data="<?=$info['nombre_cliente']." - ".$info['nit_cliente']?>" 
                          cliente_id="<?= $info['cliente_id']?>"
                          value="<?= $info['nombre_cliente']?>" disabled readonly>
                        </td>
                        <td>
                          <input type="text" name="nombre_rol" class="form-control form-control-sm" 
                          value="<?= $info['nombre_rol']?>" disabled readonly>
                        </td>
                        <th class="text-center">
                          <input type="button" name="editar" class="btn btn-sm btn-warning" 
                          value="&#9998;" tokenID="<?= $info['id'] ?>"/>
                        </th>
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
  <script type="text/javascript" src="src/js/Staff.js"></script>
</html>