<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php";


if($_POST){
 $nit= trim($_POST['cliente_id']);
 if($nit != ""){
  ReporteClientes($nit, $db);
 }
}
function ListarEmpresas($db){
  $sql ="SELECT *  FROM cliente C";
  $result = $db->query($sql);
  $empresas = $result->fetch_all(MYSQLI_ASSOC); // fetch data    
  return $empresas;
}


?>
<!DOCTYPE html>
<html>

<head>
<?php include("link.php")?>
</head>
<body>
<?php include("navbar.php") ?>
<div class="container-fluid">
      <div class="row mt-5 d-flex justify-content-center">
        <div class="col col-md-9">
        
          <div class="shadow-lg p-4 mb-5 bg-white rounded">
            
            <form method ="get" action="ReportesPDF.php">
              <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Nit</strong></label>
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="col  pe-0">
                      <select id="opcionesEmpresa" name ="Reporte-Cliente" class="form-select form-select-sm" required>
                            <option value="" selected disabled hidden>-- Eliga una Opcion --</option>
                            <?php if ($clientes = ListarEmpresas($db)): ?>
                              <?php foreach($clientes as $info): ?>
                                <option value="<?=$info['id_cliente']?>"><?= $info['id_cliente']." - ".$info['nombre_cliente']." - ".$info['nit_cliente']?></option>
                              <?php endforeach ?>
                            <?php else: ?>
                              <strong>No hay Informacion Disponible</strong>
                            <?php endif ?>
                          </select>
                        </div>
                        </div>
                      <div class="row justify-content-center">
                      <div class="col col-md-9 mt-2 text-center d-grid gap-2 "><input type="submit" id="Generar" class="btn btn-sm btn-success" value="Generar Reporte" /></div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>


</body>


</html>