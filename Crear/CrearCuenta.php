<?php
// Incluir archivo de configuración
require_once "../config.php";

// Definir variables e inicializar con valores vacíos
$login = "";
$nombre_usuario = "";
$password = "";
$confirm_password = "";

$nombre_usuario_err = 
$login_err = "";
$password_err = "";
$confirm_password_err = "";
$error_link ="";

// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Validar inicio de sesión
  if(empty(trim($_POST["login"]))){
      $login_err = "Por favor ingrese un nombre de usuario.";
  //} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["login"]))){
  } elseif(!filter_var(trim($_POST["login"]), FILTER_VALIDATE_EMAIL)){
      $login_err = "Es Necesario un Correo Electronico Valido.";
  } else{
      // Preparar una declaración select
      // consulta para la tabla usuarios
      $sql = "SELECT id FROM usuario WHERE login = ?";
      
      if($stmt = mysqli_prepare($db, $sql)){
          // Vincular variables a la declaración preparada como parámetros
          mysqli_stmt_bind_param($stmt, "s", $param_login);
          
          // Establecer parámetros
          $param_login = trim($_POST["login"]);
          
          // Intento de ejecutar la declaración preparada
          if(mysqli_stmt_execute($stmt)){
              // resultado almacenado
              mysqli_stmt_store_result($stmt);
              
              if(mysqli_stmt_num_rows($stmt) == 1){
                  $login_err = "Este inicio de sesión ya está ocupado.";
              } else{
                  $login = trim($_POST["login"]);
              }
          } else{
              $error_link = "¡Uy! Algo ha ido mal. Por favor, inténtelo de nuevo más tarde.";
              echo $$error_link;
          }
          // Cerrar declaración
          mysqli_stmt_close($stmt);
      }
  }

  // Validar Nombre
  if(empty(trim($_POST["nombre"]))){
      $nombre_usuario_err = "Ingrese un Nombre Valido";     
  }elseif(!preg_match("/^[^<,\"@\/{}()*$%?=>:|;#]*$/i", trim($_POST["nombre"]))){
      $nombre_usuario_err = "Ingrese un Nombre Valido";
  } else{
      $nombre_usuario = trim($_POST["nombre"]);
  }
  
  // Validar contraseña
  if(empty(trim($_POST["password"]))){
      $password_err = "Ingrese una contraseña";     
  } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "La contraseña debe tener al menos 6 caracteres.";
  } else{
      $password = trim($_POST["password"]);
  }
  
  // Validar y confirmar contraseña
  if(empty(trim($_POST["confirm_password"]))){
      $confirm_password_err = "Por favor, confirme la contraseña.";     
  } else{
      $confirm_password = trim($_POST["confirm_password"]);
      if(empty($password_err) && ($password != $confirm_password)){
          $confirm_password_err = "La contraseña no coincide.";
      }
  }
  
  // Comprobar los errores de entrada antes de insertar en la base de datos
  if(empty($nombre_usuario_err) && empty($login_err) && empty($password_err) && empty($confirm_password_err)){
      
      // Preparar una sentencia de inserción
      $sql = "INSERT INTO usuario (nombre,login, password) VALUES (?, ?, ?)";
       
      if($stmt = mysqli_prepare($db, $sql)){
          // Vincular variables a la sentencia preparada como parámetros
          mysqli_stmt_bind_param($stmt, "sss",$param_name, $param_login, $param_password);
          
          // Establecer parámetros
          $param_name = $nombre_usuario;
          $param_login = $login;
          $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
          
          // Intentar ejecutar la sentencia preparada
          if(mysqli_stmt_execute($stmt)){
              // Redirigir a la página de inicio de sesión
              header("location: login.php");
          } else{
              $error_link = "¡Uy! Algo ha ido mal. Por favor, inténtelo de nuevo más tarde.";
              echo $$error_link;

          }

          // Cerrar declaración
          mysqli_stmt_close($stmt);
      }

  }
  
  // Cerrar la conexión
  mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registarse</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="src/css/style.css">
</head>
<body>
  <div class="container">
    <div class="d-flex justify-content-center mt-5">
      <div class="col col-auto"></div>
        <div class="col col-5">
            <div class="row mt-5">
                <div class="card-title"><span class="invalid-feedback"><?php echo $$error_link; ?></span></div>
                <div class="card-body shadow-lg p-5 mb-5 bg-body rounded">
                    <h2 class="display-5 text-center">Registrarse</h2>
                    <div class="text-center"><small class="text-muted">Por favor complete este formulario para crear una cuenta.</small></div>

                     <div class="row">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group mt-4">
                                <label><strong>Nombre Completo</strong></label>
                                <input type="text" name="nombre" class="form-control form-control-sm <?php echo (!empty($$nombre_usuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre_usuario; ?>" required>
                                <span class="invalid-feedback"><?php echo $$nombre_usuario_err; ?></span>
                            </div>    

                            <div class="form-group mt-4">
                                <label><strong>Usuario</strong></label>
                                <input type="text" name="login" class="form-control form-control-sm <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $login; ?>" required>
                                <span class="invalid-feedback"><?php echo $login_err; ?></span>
                            </div>    
                            <div class="form-group mt-4">
                                <label><strong>Contraseña</strong></label>
                                <input type="password" name="password" class="form-control form-control-sm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required>
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group mt-4">
                                <label><strong>Confirmar Contraseña</strong></label>
                                <input type="password" name="confirm_password" class="form-control form-control-sm <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" required>
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group mt-3 mb-4 row justify-content-center">
                                <div class="row col-5 m-2"><input type="submit" class="btn btn-primary" value="Enviar"></div>
                                <div class="row col-5 m-2"><input type="reset" class="btn btn-secondary" value="Borrar"></div>
                            </div>
                            <div class="text-center"><p>¿Ya tiene una cuenta? <a href="login.php">Entre aquí</a>.</p></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</body>
</html>