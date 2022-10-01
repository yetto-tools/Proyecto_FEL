<?php
// Inicializar la sesión
session_start();
require_once "config.php";

//if (!isset($_SESSION["loggedin"])){
if (session_status() !== PHP_SESSION_ACTIVE){
  header("location: login.php");
}

$_SERVER['error'] = "";


// Include config file


// Definir variables e inicializar con valores vacíos
$usuario = ""; 
$email_err = "";
$password_err = "";
$login_err = "";
$error = "";

// Procesamiento de los datos del formulario cuando éste se envía
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Comprueba si el nombre de usuario está vacío
  if(empty(trim($_POST["login"]))){
      $email_err = "Por favor, introduzca el nombre de usuario.";
  } else{
      $usuario = trim($_POST["login"]);
  }
  
  // Comprueba si la contraseña está vacía
  if(empty(trim($_POST["password"]))){
      $password_err = "Por favor, introduzca su contraseña.";
  } else{
      $password= trim($_POST["password"]);
  }
  
  // Validar las credenciales
  if(empty($email_err) && empty($password_err)){
      // Preparar una sentencia select
    
    $sql = "
      SELECT 
      u.id_usuario,
      u.nombre_usuario, 
      u.usuario, 
      u.contraseña, 
      u.es_staff, 
      u.cliente_id, 
      u.rol_id, 
      u.verificado, 
      c.id_cliente, 
      c.nit_cliente, 
      c.nombre_cliente, 
      c.direccion_cliente, 
      c.telefono_cliente, 
      c.logo_cliente, 
      c.verificado 
      FROM usuario u LEFT JOIN cliente c ON u.cliente_id = id_cliente where usuario = ?;
    ";

    if($stmt = $db->prepare($sql)){
      $stmt->bind_param("s", $usuario);
      
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows == 1){
        $stmt->bind_result(
          $id_usuario, 
          $nombre_usuario,
          $usuario, 
          $contraseña, 
          $es_staff, 
          $cliente_id, 
          $rol_id, 
          $verificado, 
          $id_cliente, 
          $nit_cliente, 
          $nombre_cliente, 
          $direccion_cliente, 
          $telefono_cliente, 
          $logo_cliente, 
          $verificado 
        );
        $stmt->fetch();
        // verificamos password
        if(password_verify($password, $contraseña)){
                      
            (session_status() == PHP_SESSION_ACTIVE) ? session_reset() : session_start();
            //session_start();
            $_SESSION['usuario'] = array(
            "id_usuario" =>  $id_usuario,
            "nombre_usuario" => $nombre_usuario,
            "usuario" =>  $usuario, 
            "es_staff" =>  $es_staff, 
            "cliente_id" =>  $cliente_id, 
            "rol_id" =>  $rol_id,
            "cliente" =>
              array(
              "id_cliente" =>  $id_cliente, 
              "nombre_cliente" =>  $nombre_cliente,
              "nit_cliente" =>  $nit_cliente, 
              "direccion_cliente" =>  $direccion_cliente, 
              "telefono_cliente" =>  $telefono_cliente, 
              "logo_cliente" =>  $logo_cliente, 
              "verificado" =>  $verificado 
              )
            );
            // filtrado de  cuenta activa
            if ($_SESSION['usuario']['cliente']['verificado'] == false){
              $login_err  =  "Emprea No ha sido Verificado por el Staff";
            }
            else{
                header("location: index.html");
            }
        }
        else{
          $login_err = $password_err =  "Error de Contraseña";  
        }
      }
      else{
        $login_err = $email_err  =  "Usuario no Registrado";
      }

      $stmt->close();
    }
    else{
      $error_log =  "Problema Con la Consulta a la Base de Datos";
    }

  }
  // Close connection
  mysqli_close($db);
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("link.php")?>
</head>
<body>
  <div class="container">
    <div class="m-0 vh-100 row justify-content-center align-items-center">
      <div class="col col-auto">
        <div class="row mt-5">
          <div class="card-body shadow-lg p-5 mb-5 bg-body rounded border">
            <h2 class="display-4 text-center"><img src="src/logo.png" width= 192 height=160></h2>
            <div class="text-center"><small class="text-muted">Por favor complete este formulario para ingresar a su cuenta.</small></div>
            <div class="row">
              <div class="justify-content-center align-items-center">
                <?php 
                  if(!empty($_SERVER['error'])){
                    echo '<div class="mt-2 alert alert-danger alert-dismissible" role="alert">'.
                    $_SERVER['error']
                    . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
                  }
                  if(!empty($login_err)){
                    echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
                    $login_err
                    . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
                  }        
                ?>
              <div>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <div class="form-group mt-2">
                  <label><strong>Nombre de Usuario</strong></label>
                  <input type="text" name="login" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usuario; ?>">
                  <span class="invalid-feedback"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group mt-4">
                  <label><strong>Contraseña</strong></label>
                  <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?> ">
                  <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group mt-4 text-center">
                  <input type="submit" class="btn btn-lg btn-block btn-primary" value="Ingresar">
                </div>
                <div class="form-group mt-4 text-center">
                  <p>¿No tienes una cuenta? <a class="btn btn-sm btn-primary" href="Nuevo Cliente.php">Regístrate ahora</a>.</p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>          
      </div>
    </div>
  </div>    

</body>
</html>