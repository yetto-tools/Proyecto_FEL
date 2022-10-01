<?php
// Inicializar la sesión
session_start();
require_once "config.php";

// Solicita un usuario logeado
//require_once "session_config.php";

// formulario para guarda
if($_POST){
  $mensaje = "";
  // limpiamos de espacios en blaco la entrada de informacion
  $nombre_usuario = trim($_POST["nuevo-nombre"]);
  // limpiamos de espacios en blaco la entrada de informacion
  $usuario = trim($_POST["nuevo-Usuario"]);
  // limpiamos de espacios en blaco la entrada de informacion
  $contraseña = trim($_POST["nuevo-contraseña"]);
  // limpiamos de espacios en blaco la entrada de informacion
  $nit = trim($_POST["nuevo-nit"]);
  // limpiamos de espacios en blaco la entrada de informacion
  $nombre_cliente = trim($_POST["nuevo-cliente"]);
  // limpiamos de espacios en blaco la entrada de informacion
  $direccion_cliente = trim($_POST["nueva-direccion"]);
  // limpiamos de espacios en blaco la entrada de informacion
  $telefono_cliente = trim($_POST["nuevo-telefono"]);
  // limpiamos de espacios en blaco la entrada de informacion
  $logo_cliente = $_POST["base64-logo"];

  // Comprobamos que no Existe un Nit repetido
  try{
    $errores = $error_usuario = $error_nit ="";
    $sql_nit = "SELECT `nit_cliente` FROM `cliente` WHERE `nit_cliente` = '$nit'";
    $sql_usuario ="SELECT `usuario` FROM `usuario` WHERE `usuario` = '$usuario'";
    // VEFICAMOS QUE NO EXISTEAN DUPLICADOS EN EL USUARIO O LA EMPERSA
    if($error_usuario = $db->query($sql_nit)->num_rows ||  $error_nit = $db->query($sql_usuario)->num_rows){
      if($error_usuario){
        $error_usuario = "<p>Ya se registro este NIT: <strong>".$nit."</strong></p>";
      }
      if($error_nit){
        $error_nit = "<p>Ya exites un Usurio llamado: <strong>".$usuario."</strong></p>"; 
      }
      $errores = $error_usuario . $error_nit;
      $mensaje = '<div class="alert alert-warning alert-dismissible" role="alert">'.
        $errores
      . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }else{
      // verificamos que no hay errores en la comprobacion
      if(empty($errores)){
        try{  
          $db->begin_transaction();
            $insertar_cliente = "INSERT INTO `cliente` (`nit_cliente`,`nombre_cliente`,`direccion_cliente`, `telefono_cliente`, `logo_cliente`)
              VALUES ('$nit', '$nombre_cliente','$direccion_cliente', '$telefono_cliente', '$logo_cliente'); ";  
            
            $db->query($insertar_cliente);
            $cliente_id = $db->insert_id;
            if ($cliente_id !== 0){
              $hash  = password_hash($contraseña, PASSWORD_DEFAULT);
              $insertar_usuario = "INSERT INTO `usuario` (`nombre_usuario`,`usuario`,`contraseña`, `cliente_id`) 
              VALUES ('$nombre_usuario', '$usuario', '$hash', '$cliente_id'); ";
              $db->query($insertar_usuario);
            }
            else if($cliente_id == 0){
              $db->rollback();
              throw new Exception("Ocurrio un Problema durante el Registro!!");
            }

          $db->commit();
          $mensaje = '<div class="alert alert-info alert-dismissible" role="alert">'
          ."<p>Se El Usuario: <b>".$usuario." </b>" 
          ."<b> NIT: ".$nit." <b>"
          . "<b> Empresa: ".$nombre_cliente." </b>"
          ."</b></p><p class='fw-bold'>Espere a que el Staff Verifique la informacion</p>"
          . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';    
        } 
        catch (Exception $e) {
          $db->rollback();
          $mensaje = '<div class="alert alert-danger alert-dismissible" role="alert">'.
          $e->getMessage()
          . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
          
        } // FIN CATCH
      }
    } 
  }catch (Exception $e) {
    $mensaje = '<div class="alert alert-danger alert-dismissible" role="alert">'.
    $e->getMessage()
    . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
  } // FIN CATCH
  

} // FIN DE POST

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("link.php")?>
</head>
<body>
  <?php echo session_status(); ?>
  <div class="container-fluid">
    <div class="row mt-5 d-flex justify-content-center">
      <div class="col col-md-9">
        <div class="shadow-lg p-4 mb-5 bg-white rounded">
          <div class="card">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="form-cliente" class="card-body mx-5 needs-validation" novalidate>
              <div class="row mb-2  border-2 border-dark border-bottom mb-4">
                <h4 class="text-center fw-bold border-dark"><span class="">Registrar Nueva Cuenta <span></h4>
                <div class="col col-md-12 mb-2 d-flex justify-content-center">
                  <div class="col col-md-8 text-center">
                    <div class="row">
                      <div id="liveAlertPlaceholder">
                        <div>
                          <?php echo empty($mensaje) ? "": $mensaje;  ?>
                        </div>
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
                          <input type="hidden" id="id-cliente" name="id-cliente" class="form-control form-control-sm bg-light" placeholder="ID Registo" value="" readonly>
                          <div class="valid-feedback">listo!</div>
                          <div class="invalid-feedback">Campo Obligatorio!!</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-4 col-form-label bg-light"><strong>Nombre</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col  pe-0">
                          <input type="text" id="nuevo-nombre" name="nuevo-nombre" class="form-control form-control-sm mb-2" placeholder="Nombre Completo" required>
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
                          <input type="text" id="nuevo-Usuario" name="nuevo-Usuario" class="form-control form-control-sm mb-2" placeholder="correo" required>
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
                          <input type="password" id="nuevo-contraseña" name="nuevo-contraseña" class="form-control form-control-sm mb-2" placeholder="contraseña" required>
                          <div class="valid-feedback">listo!</div>
                          <div class="invalid-feedback">Campo Obligatorio!!</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-4 col-form-label bg-light"><strong>Nit</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col  pe-0">
                          <input type="text" id="nuevo-nit" name="nuevo-nit" class="form-control form-control-sm mb-2" placeholder="NIT" required>
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
                          <input type="text" id="nuevo-cliente" name="nuevo-cliente" class="form-control form-control-sm mb-2" placeholder="cliente" required>
                          <div class="valid-feedback">listo!</div>
                          <div class="invalid-feedback">Campo Obligatorio!!</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-4 col-form-label bg-light"><strong>Direccion</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col  pe-0">
                          <textarea type="text" id="nueva-direccion" name="nueva-direccion" class="form-control form-control-sm mb-2"  rows="2" cols="90" class="form-control form-control-sm" placeholder="Direccion" required></textarea>
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
                    <label class="col-md-4 col-form-label bg-light"><strong>Telefono</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col  pe-0">
                          <input type="text" id="nuevo-telefono" name="nuevo-telefono" class="form-control form-control-sm mb-2" placeholder="Telefono">
                          <div class="valid-feedback">listo!</div>
                          <div class="invalid-feedback">Campo Obligatorio!!</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-4 col-form-label bg-light"><strong>Logo</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col pe-0">
                          <input type="file" id="nuevo-logo" name="nuevo-logo"  accept="image/png, image/gif, image/jpeg" class="form-control form-control-sm mb-2">
                          <input type="hidden" id="base64-logo" name="base64-logo" value="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAQAAACMha5pAAAAlklEQVR42u3PAQ0AAAwCoNu/9Gu4CQ3IzYq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6urq6unqXBx4gAIE1+BdCAAAAAElFTkSuQmCC">
                          <div class="valid-feedback">listo!</div>
                          <div class="invalid-feedback">Campo Obligatorio!!</div>
                          <div class="text-small"><span id="img-size" class="small">tamaño: 0 KB</span></div>
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
              <div class="row mt-2 ">
                <div class="col-md-12 mb-3 d-flex justify-content-center">
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-lg">Registrar</button>
                  </div>

                  <div class="col-auto ms-5">
                    <a href="inicio.php" class="btn btn-primary btn-lg" >Inicio</a>
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript" src="src/js/LoginNuevoCliente.js"></script>
</html>