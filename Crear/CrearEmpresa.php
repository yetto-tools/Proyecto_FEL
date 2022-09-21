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
$nombre_empresa = 
$direccion = "";
$nit ="";
$telefono ="";

$login_err = "";
$logo_error = "";
$nombre_empresa_err = "";
$direccion_err = "";
    
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
              <h2 class="display-4 text-center">Crear Empresa</h2>
              <div class="text-center"><small class="text-muted">Por favor complete este formulario para crear una empresa.</small></div>
              <div class="row">
                <?php 
                  if(!empty($login_err)){
                    echo '<div class="alert alert-danger mt-5">' . $login_err . '</div>'; 
                  }        
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <div class="form-group row mt-4">
                    <div class="form-group col">
                        <div class="form-check">
                            <input class="form-check-input form-check-input-sm" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">Es Cliente</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                            <label class="form-check-label" for="flexRadioDefault2">DigitSAT</label>
                            </div>
                        </div>
                    <div class="form-group col">                        
                        <label><strong>Logo de Empresa</strong></label>
                        <input type="file" name="logo_empresa" accept="image/png, image/jpeg" class="form-control form-control-sm <?php echo (!empty($logo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $logo; ?>" >
                        <span class="invalid-feedback"><?php echo $empresa_err; ?></span>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label><strong>Nombre de Empresa</strong></label>
                    <input type="text" name="nombre_empresa" class="form-control form-control-sm  <?php echo (!empty($nombre_empresa_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre_empresa; ?>" require>
                    <span class="invalid-feedback"><?php echo $empresa_err; ?></span>
                  </div>
                  <div class="form-group mt-4">
                    <label><strong>Direccion</strong></label>
                    <input type="text" name="direccion" class="form-control form-control-sm <?php echo (!empty($direccion_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $direccion; ?>">
                    <span class="invalid-feedback"><?php echo $direccion_err; ?></span>
                  </div>

                  <div class="form-group row">
                    <div class="form-group col mt-4">
                        <label><strong>Nit</strong></label>
                        <input type="text" name="nit" class="form-control form-control-sm <?php echo (!empty($nit_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nit; ?>">
                        <span class="invalid-feedback"><?php echo $direccion_err; ?></span>
                    </div>
                    <div class="form-group col mt-4">
                        <label><strong>Telefono</strong></label>
                        <input type="text" name="telefono" class="form-control form-control-sm <?php echo (!empty($telefono_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefono; ?>">
                        <span class="invalid-feedback"><?php echo $direccion_err; ?></span>
                    </div>
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