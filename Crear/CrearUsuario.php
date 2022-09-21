<?php

// // Inicializar la sesión
// session_start();

// // Comprueba si el usuario ya ha iniciado la sesión, en caso afirmativo, redirígelo a la página de bienvenida
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
// {
//   header("location: index.php");
//   exit;
// }

include "../config.php";
$login = "";
$logo ="";
$empresas = array();
$nombre_usuario = "";
$nombre_empresa ="";
$password ="";
$confirm_password = "";
$direccion ="";
$nit ="";

$login_err = "";
$logo_error = "";
$nombre_empresa_err = "";
$empresa_err = "";
$password_err = "";
$confirm_password_err = "";
$tabla = "";

function ListarEmpresas($db){
    $sql = "SELECT * FROM empresa";
    if ($result = $db->query($sql)){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
         echo "<option value={$row['id_empresa']}>{$row['id_empresa']} - {$row['nombre_empresa']}</option>";
        }
    }
}
function ListarUsuarios($db){
    $sql = "SELECT * FROM tipo_usuario";
    if ($result = $db->query($sql)){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
         echo "<option value={$row['id_tipo']}>{$row['id_tipo']} - {$row['tipo_usuario']}</option>";
        }
    }
}
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

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
              <h2 class="display-4 text-center">Crear Usuario</h2>
              <div class="text-center"><small class="text-muted">Por favor complete este formulario para crear una empresa.</small></div>
              <div class="row">
                <?php 
                  if(!empty($login_err)){
                    echo '<div class="alert alert-danger mt-5">' . $login_err . '</div>'; 
                  }        
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <div class="form-group row mt-4">
                    <div class="form-group col row">
                        <label><strong>Es Staff</strong></label>
                        <div class="form-check col-auto"></div>
                        <div class="form-check col-3">
                            <input class="form-check-input form-check-input-sm" type="radio" name="esStaff" id="stafftrue" checked>
                            <label class="form-check-label" for="stafftrue">Si</label>
                        </div>
                        <div class="form-check col-3">
                            <input class="form-check-input" type="radio" name="esStaff" id="stafffaslse" >
                            <label class="form-check-label" for="stafffaslse">No</label>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label><strong>Empresa</strong></label>
                            <select class="form-select form-select-sm">
                                <?php ListarEmpresas($db); ?>
                            </select>
                        </div>
                        <div class="form-group col">
                        <label><strong>Tipo de Usuario</strong></label>
                        <select class="form-select form-select-sm">
                            <?php ListarUsuarios($db); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label><strong>Nombre</strong></label>
                    <input type="text" name="nombre" class="form-control form-control-sm  <?php echo (!empty($nombre_empresa_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre_empresa ; ?>" require>
                    <span class="invalid-feedback"><?php echo $empresa_err; ?></span>
                  </div>
                  <div class="form-group mt-4">
                    <label><strong>Correo</strong></label>
                    <input type="text" name="direccion" class="form-control form-control-sm <?php echo (!empty($direccion_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $direccion; ?>">
                    <span class="invalid-feedback"><?php echo $direccion_err; ?></span>
                  </div>

                  <div class="form-group row">
                    <div class="form-group col mt-4">
                        <label><strong>Contraseña</strong></label>
                        <input type="password" name="nit" class="form-control form-control-sm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group col mt-4">
                        <label><strong>Confirmar Contraseña</strong></label>
                        <input type="password" name="telefono" class="form-control form-control-sm <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
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