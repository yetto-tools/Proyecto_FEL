<?php
include "../config.php";
$login = $login_err = "";
$tipo  = $tipo_err  = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

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
    


}



?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <?php include ("../link.php"); ?>
</head>
<body>
  <div class="container">
    <div class="d-flex justify-content-center mt-5">
      <div class="col col-auto"></div>
        <div class="col col-8">
          <div class="row mt-5">
            <div class="card-body shadow-lg p-5 mb-5 bg-body rounded">
              <h2 class="display-4 text-center">Crear Tipo de Usuario</h2>
              <div class="text-center"><small class="text-muted">Por favor complete este formulario para crear una tipo de usuario.</small></div>
              <div class="row">
                <?php 
                  if(!empty($login_err)){
                    echo '<div class="alert alert-danger mt-5">' . $login_err . '</div>'; 
                  }        
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <div class="form-group row mt-4">
                    <div class="form-group col row">
                        <label><strong>Es Staff?</strong></label>
                        <div class="form-check col-auto"></div>
                        <div class="form-check col-3">
                            <input class="form-check-input form-check-input-sm" type="radio" name="esStaff" id="stafftrue" value ="1" checked>
                            <label class="form-check-label" for="stafftrue">Si</label>
                        </div>
                        <div class="form-check col-3">
                            <input class="form-check-input" type="radio" name="esStaff" id="stafffaslse"  value="0">
                            <label class="form-check-label" for="stafffaslse">No</label>
                            </div>
                        </div>
                        <div class="form-group col">
                                <label><strong>Tipo de Usuario</strong></label>
                                <input type="text" name="tipo_usuario" class="form-control form-control-sm <?php echo (!empty($tipo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tipo; ?>">
                                <span class="invalid-feedback"><?php echo $tipo_err; ?></span>
                        </div>
                        <div class="form-group col">
                            <label><strong>Descripcion</strong></label>
                            <input type="text" name="tipo_usuario" class="form-control form-control-sm <?php echo (!empty($tipo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tipo; ?>">
                            <span class="invalid-feedback"><?php echo $tipo_err; ?></span>
                        </div>
                </div>

                  <div class="form-group mt-4 text-center">
                    <input type="submit" class="btn btn-lg btn-block btn-primary" value="Crear">
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