<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php";

if($_POST){
  $nit            = $_POST["nit"];
  $nombre         = $_POST["nombre"];
  $direccion      = $_POST["direccion"];
  $numeroFactura  = $_POST["numeroFactura"];
  $fecha          = $_POST["fecha"];
  $total_pagar    = $_POST["totalAPagar"];
  $descuento      = $_POST["Descuento"];
  $iva_factura    = $_POST["IVA"];
  $total          = $_POST["total"];
  $id_cliente     = $empresa["id_cliente"];
  $uuid           = $_POST["numeroFactura"];
  // Creamos un array Vacio. para guardar el detalle de la factura
  $detalleFactura = (array) null;
//CONVERTIMOS A UNA LINEA los registros
  for($index = 0 ; $index < count($_POST["productos"]); $index++ ){
    array_push($detalleFactura,
      array(
        "producto"  =>  $_POST["productos"][$index],
        "descripcion" =>  $_POST["descripciones"][$index],
        "cantidad"  =>  $_POST["cantidades"][$index],
        "precio"  =>  $_POST["precios"][$index],
        "monto" =>  $_POST["montos"][$index]
      )
    );

  }
  
  // if(empty($errores)){
    try{
      $db->begin_transaction();
        $sql_factura = "INSERT INTO `factura`
        (`nit`, `nombre`, `direccion`, `factura_uuid`, `fecha`, `descuento`, `total_factura`, `iva_factura`, `total_pagar`, `cliente_id` )
        VALUES (
          '$nit',
          '$nombre',
          '$direccion',
          '$uuid',
          '$fecha',
          '$total_pagar',
          '$descuento',
          '$iva_factura',
          '$total',
          '$id_cliente'
        );";
        var_dump($sql_factura);
        $db->query($sql_factura);
        
        $correlativo = $db->insert_id;
        $sql_detalle = "";
        $uuid ="";
        var_dump($correlativo);
        if ($correlativo !== 0){
          $contardor_linea = 0;
          $result = $db->query("select  factura_uuid   from factura WHERE id_factura ='$correlativo'");
          $uuid =  $result->fetch_assoc()['factura_uuid'];
          foreach ($detalleFactura as $linea) {
            $contardor_linea++;
            $sql_detalle .= "INSERT INTO `factura_detalle` ( `factura_id`, `factura_uuid`, `no_linea`, `codigo`, `descripcion`, `cantidad`, `precio`, `monto` )
            VALUES (
            '{$factura_id}',
            '{$uuid}',
            '$contardor_linea',
            '{$linea['producto']}',
            '{$linea['descripcion']}',
            '{$linea['cantidad']}',
            '{$linea['precio']}',
            '{$linea['monto']}');";
          }
          $db->query($sql_detalle);
        }
        else if($factura_id == 0){
          $db->rollback();
          throw new Exception("Ocurrio un Problema durante el Registro!!");
        }
        
        var_dump($sql_detalle);

        $db->commit();
      $mensaje = '<div class="alert alert-info alert-dismissible" role="alert">'
      ."<b> NIT: ".$nit." <b>"
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


?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include("link.php")?>
</head>
<body>
  <?php include("navbar.php") ?>
  <div class="container-fluid">
    <div class="row">
      <div id="liveAlertPlaceholder">
        <div>
          <?php echo empty($mensaje) ? "": $mensaje;  ?></div></div>
        </div>
      </div>
    </div>
  </div>
	<div class="container-fluid">
    <div class="row mt-5 d-flex justify-content-center">
      <div class="col col-md-auto">
          <h4 class="bg-dark text-white text-center mb-0 py-1"><div class="mb-0"><span class="mx-2">F a c t u r a c i o n</span><span class="mx-2"> E l e c t r o n i c a</span></div></h4>
          <form class="shadow-lg p-4 mb-5 bg-white rounded"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
            <div class="row mb-4">
              <div class="col col-md-6">
                <img src="<?php echo $empresa['logo_cliente'] ?>" class="img-circle rounded mx-auto d-block border" alt="logo" width="160" height="128">
              </div>
              <div class="col col-md-6">
                <div class="row">
                  <p id="nitFacturacion" name="nitFacturacion" class="h6"><span class="fw-bold me-3 text-end"><?php echo htmlspecialchars($empresa["nit_cliente"]); ?></span></p>
                  <p id="nombreFacturacion" name="nombreFacturacion" class="h6"><span class="fw-bold me-3 text-end"><?php echo htmlspecialchars($empresa["nombre_cliente"]); ?></span></p>
                  <p id="direccionFacturacion" name="direccionFacturacion" class="h6"><span class="fw-bold me-3 text-end"><?php echo htmlspecialchars($empresa["direccion_cliente"]);?></span></p>
                  <p id="ciudadPaisFacturacion" name="ciudadPaisFacturacion" class="h6"><span class="fw-bold me-3 text-end">Guatemala,Guatemala</span></p>
                  <p id="TelefonoFacturacion" name="TelefonoFacturacion" class="h6"><span class="fw-bold me-3 text-end"><?php echo htmlspecialchars($empresa["telefono_cliente"]); ?></span></p>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col col-md-6">
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Nit</strong></label>
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="col  pe-0">
                          <input type="text" id="nit" name="nit" class="form-control form-control-sm mb-2" placeholder="NIT" required>
                      </div>
                      <div class="col-auto ps-1">
                          <input type="button" id="buscar" name="buscar" class="btn btn-sm btn-primary" value="&#128269;">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Nombre</strong></label>
                  <div class="col-md-6 "><input type="text" id="nombre" name="nombre" class="form-control form-control-sm mb-4" placeholder="NOMBRE" required></div>
                </div>
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Direccion</strong></label>
                  <div class="col-md-6 "><input type="text" id="direccion" name="direccion" class="form-control form-control-sm" placeholder="DIRECCION" required></div>
                </div>
              </div>
              <div class="col col-md-6">
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Factura N°</strong></label>
                  <div class="col col-lg-7"><input type="text" id="numeroFactura" name="numeroFactura" class="form-control form-control-sm mb-4 bg-ligh fs-bold" placeholder="N° Factura" readonly></div>
                </div>
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Fecha:</strong></label>
                  <div class="col-md-6 "><input type="date" id="fecha" name="fecha" class="form-control form-control-sm mb-4" required></div>
                </div>
                <div class="row">
                  <label class="col-md-4 col-form-label bg-light"><strong>Total a pagar</strong></label>
                  <div class="col-md-6 "><input type="number" id="totalAPagar" name="totalAPagar" min="0.0" value="0.00" step="any" class="form-control form-control-sm "></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <table class="table table-borderless table-sm table-striped table-hover table-wrapper border">
                  <thead class="table-dark text-center sticky-top" id="header-productos">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Codigo</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Monto</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody id="ListaProductos" class="fixed_header">
                    <tr id="1" name="linea">
                      <th scope="row" name="numero">1</th>
                      <td ><input type="text" name="productos[]" class="form-control form-control-sm" placeholder="Codigo" required></td>
                      <td name="descripcion"><textarea name="descripciones[]" rows="1" class="form-control form-control-sm" placeholder="Descripcion" required></textarea></td>
                      <td ><input type="number" name="cantidades[]" min="1" value="1" class="form-control form-control-sm"></td>
                      <td ><input type="number" name="precios[]" min="0.1" value="0.00" step="any" class="form-control form-control-sm" required></td>
                      <td ><input type="number" name="montos[]" min="0.1" value="0.00" step="any" class="form-control form-control-sm text-muted fw-bold bg-light" readonly required></td>
                      <th class="text-center"><input type="button" name="quitar" class="btn btn-sm btn-danger disabled" value="&Cross;"/></th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row mb-4 ">
              <div class="col col-md-2 mb-4">
                <input type="button" id="agregar" name="agregar" class="btn btn-sm btn-primary" value="+"/>
              </div>
              <div class="col col-md-10 ">
                <div class="row d-flex justify-content-end ">
                    <div class="col col-md-6">
                      <div class="row d-flex justify-content-center">
                        <div class="col col-md-4 bg-light"><p class="fw-bolder">SubTotal Q.</p></div>
                        <div class="col col-md-5 ms-3"><input type="number" id="subtotal" name="Subtotal" min="0.1" value="0.00" step="any" class="form-control form-control-sm text-muted fw-bold bg-light" readonly required></div>
                      </div>
                      <div class="row d-flex justify-content-center">
                        <div class="col col-md-4  bg-light  bg-light"><p class="fw-bolder">Desc. Q.</p></div>
                        <div class="col col-md-5 ms-3"><input type="number" id="descuento" name="Descuento" min="0.0" value="0.00" step="any" class="form-control form-control-sm" required></div>
                      </div>
                      <div class="row d-flex justify-content-center">
                        <div class="col col-md-4  bg-light  bg-light "><p class="fw-bolder">Total Sin IVA. Q.</p></div>
                        <div class="col col-md-5 ms-3"><input type="number" id="totalSinIVA" name="totalSinIVA" min="0.0" value="0.00" step="any" class="form-control form-control-sm text-muted fw-bold bg-light" readonly required></div>
                      </div>
                      <div class="row d-flex justify-content-center">
                        <div class="col col-md-4  bg-light  bg-light "><p class="fw-bolder">IVA. Q.</p></div>
                        <div class="col col-md-5 ms-3"><input type="number" id="IVA" name="IVA" min="0.0" value="0.00" step="any" class="form-control form-control-sm text-muted fw-bold bg-light" readonly required></div>
                      </div>
                      <div class="row d-flex justify-content-center">
                        <div class="col col-md-4  bg-light mt-2 border-2 border-top border-dark"><p class="fw-bolder">Total Q.</p></div>
                        <div class="col col-md-5 ms-3 mt-2"><input type="number" id="total" name="total" min="0.1" value="0.00" step="any" class="form-control form-control-sm text-muted fw-bold bg-light" readonly required></div>
                      </div>
                      <div class="row d-flex justify-content-center">
                        <div class="col col-md-9 mt-2 text-center d-grid gap-2 "><input type="submit" class="btn btn-sm btn-success" value="Firmar" /></div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
	</div>
</body>
<script type="text/javascript" src="src/js/Facturacion.js"></script>
</html>

