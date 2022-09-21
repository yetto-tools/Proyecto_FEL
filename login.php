<?php
// Inicializar la sesión
session_start();

// Comprueba si el usuario ya ha iniciado la sesión, en caso afirmativo, redirígelo a la página de bienvenida
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}


// Include config file
require_once "config.php";

// Definir variables e inicializar con valores vacíos
$login = "";
$email = ""; 
$password= "";
$email_err = "";
$password_err = "";
$login_err = "";


// Procesamiento de los datos del formulario cuando éste se envía
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Comprueba si el nombre de usuario está vacío
  if(empty(trim($_POST["login"]))){
      $email_err = "Por favor, introduzca el nombre de usuario.";
  } else{
      $email = trim($_POST["login"]);
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
      $sql = "SELECT 
                u.id, 
                u.nombre_usuario, 
                u.login, u.password, 
                e.nombre_empresa, 
                t.tipo_usuario 
              FROM usuario u 
                LEFT JOIN tipo_usuario t ON u.id_tipo = t.id_tipo 
                LEFT JOIN empresa e ON e.id_empresa = u.id_empresa 
              WHERE u.login = ?";

      if($stmt = mysqli_prepare($db, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_username);
          
          // Set parameters
          $param_username = $email;
          
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              // Store result
              mysqli_stmt_store_result($stmt);
              // Check if username exists, if yes then verify password
              if(mysqli_stmt_num_rows($stmt) == 1){                    
                  // Bind result variables
                  mysqli_stmt_bind_result($stmt, $id, $usuario ,$correo, $hashed_password, $empresa, $tipo);
                  echo "<p>".password_verify($password, $hashed_password)."</p>";
                  if(mysqli_stmt_fetch($stmt)){
                      if(password_verify($password, $hashed_password)){
                          // Password is correct, so start a new session
                          session_start();
                          
                          // Store data in session variables
                          $_SESSION["loggedin"]       = true;
                          $_SESSION["id"]             = $id;
                          $_SESSION["nombre_usuario"] = $usuario;
                          $_SESSION["login"]          = $correo;
                          $_SESSION["nombre_empresa"] = $empresa;
                          $_SESSION["tipo_usuario"]   = $tipo;

                           
                          // Redirect user to welcome page
                          header("location: index.php");
                      } else{
                          // Password is not valid, display a generic error message
                          $login_err =  "Contraseña no válidos.";

                      }
                  }
              } else{
                  // Username doesn't exist, display a generic error message
                  $login_err = "El usuario No Existe o hay un problema";
              }
          } else{
              echo "¡Oops! Algo ha ido mal. Por favor, inténtelo de nuevo más tarde.";
          }

          // Close statement
          mysqli_stmt_close($stmt);
      }
  }
  
  // Close connection
  mysqli_close($db);
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <?php include("link.php")?>
  
</head>
<body>
  <div class="container">
    <div class="d-flex justify-content-center mt-5">
      <div class="col col-auto"></div>
        <div class="col col-5">
          <div class="row mt-5">
            <div class="card-body shadow-lg p-5 mb-5 bg-body rounded">
              <h2 class="display-4 text-center">LOGIN</h2>
              <div class="text-center"><small class="text-muted">Por favor complete este formulario para ingresar a su cuenta.</small></div>
              <div class="row">
                <?php 
                  if(!empty($login_err)){
                    echo '<div class="alert alert-danger mt-5">' . $login_err . '</div>'; 
                  }        
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                  <div class="form-group mt-4">
                    <label><strong>Nombre de Usuario</strong></label>
                    <input type="text" name="login" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
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
                    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate ahora</a>.</p>
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