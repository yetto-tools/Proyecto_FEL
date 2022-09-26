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
$correo = ""; 
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
      $correo = trim($_POST["login"]);
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
u.correo,
u.password,
r.role,
s.nombre,
e.nit,
e.nombre,
e.direccion,
e.ciudad,
e.pais,
e.telefono,
i.logo,
i.formato,
o.omiso,
o.factura_id
FROM usuario u
LEFT JOIN staff s ON u.id = s.usuario_id
LEFT JOIN role r ON r.id = u.role_id
LEFT JOIN empresa e ON e.id = s.empresa_id
LEFT JOIN imagen i ON i.id  = e.logo_id
LEFT JOIN omiso o ON o.empresa_id = s.empresa_id 
WHERE u.correo =?";

    if($stmt = $db->prepare($sql)){
      $stmt->bind_param("s", $correo);
      
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows == 1){

        $stmt->bind_result(
          $id,
          $correo,
          $hashed_password,
          $role,
          $usuario_nombre, 
          $empresa_nit, 
          $empresa_nombre,
          $empresa_direccion,
          $empresa_ciudad,
          $empresa_pais,
          $empresa_telefono,
          $imagen_logo,
          $imagen_formato,
          $omiso,
          $factura_omiso
        );
        $stmt->fetch();
        // verificamos password
        if(password_verify($password, $hashed_password)){
          session_start();
          $_SESSION['usuario'] = array(
          "id"=>$id,
          "correo"=>$correo,
          "role"=>$role,
          "usuario_nombre"=>$usuario_nombre, 
          "empresa" =>
            array(
              "nit"=>$empresa_nit, 
              "nombre"=>$empresa_nombre,
              "direccion"=>$empresa_direccion,
              "ciudad"=>$empresa_ciudad,
              "pais"=>$empresa_pais,
              "telefono"=>$empresa_telefono,
              "logo" => "data:".$imagen_formato.";base64,".$imagen_logo 
            ),
          "omiso"=>$omiso,
          "factura_omiso"=>$factura_omiso  
          );
           //= $informacion_usuario;
          // var_dump($_SESSION['usuario']);
          // Redirigir al usuario a la página de bienvenida
          header("location: inicio.php");
        }else{
          $login_err = $password_err =  "Error de Contraseña";  
        }
      }
      else{
        $login_err = $email_err  =  "Usuario no Registrado";
      }

      $stmt->close();
    }
    else{

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
            <h2 class="display-4 text-center">LOGIN</h2>
            <div class="text-center"><small class="text-muted">Por favor complete este formulario para ingresar a su cuenta.</small></div>
            <div class="row">
              <?php 
                if(!empty($_SERVER['error'])){
                  echo '<div class="alert alert-danger mt-5">' . $_SERVER['error']    . '</div>'; 
                }
                if(!empty($login_err)){
                  echo '<div class="alert alert-danger mt-5">' . $login_err . '</div>'; 
                }        
              ?>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <div class="form-group mt-4">
                  <label><strong>Nombre de Usuario</strong></label>
                  <input type="text" name="login" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $correo; ?>">
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