<?php
// Inicializar la sesión
session_start();
require_once "config.php";
require_once "session_config.php";
$sql = "SELECT e.id, e.nit, e.nombre, e.direccion, e.ciudad, e.pais, e.telefono, i.logo, i.formato, i.tamaño  FROM empresa e LEFT JOIN imagen i ON i.id =e.logo_id";
//$db->query("INSERT into imagen (logo,nombre,tamaño,formato) VALUES ('$toImgBase64','$imagen_nombre','$imagen_tamaño','$imagen_formato')");

// Listar Empresas
$count=0;
$stmt = $db->prepare($sql);
// $stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
//$titulos = $result->fetch_assoc();
$empresas = $result->fetch_all(MYSQLI_ASSOC); // fetch data

// formulario para guarda

// Procesamiento de los datos del formulario cuando éste se envía
if($_SERVER["REQUEST_METHOD"] == "POST"){
  /* Comprueba si el nombre de usuario está vacío */
  if( isset($_POST["nuevo-nit"]) && isset($_POST["nuevo-empresa"]) && isset($_POST["nueva-direccion"])  ){
    $id =  isset($_POST["id-empresa"]) ? trim($_POST["id-empresa"]) : NULL;
    $nit = trim($_POST["nuevo-nit"]);
    $empresa = trim($_POST["nuevo-empresa"]);
    $direccion = trim($_POST["nueva-direccion"]);
    $telefono = trim($_POST["nuevo-telefono"]);
    $departamento = trim($_POST["nuevo-departamento"]);
    $municipio = trim($_POST["nuevo-municipio"]);

    /* NULL, '989898-9', 'Solucom, S.A.', '10 avenida 5-48, Nueva Monserrat Zona 4 Mixco', 'Guatemala', 'Guatemala', '7892-6896', NULL */

    // funcion para grabar si hay una imagen 
    if(!empty($_FILES['nuevo-logo'])){
      //leemos almacemanos los datos en variables
      $imagen_nombre   = $_FILES["nuevo-logo"]["name"];
      $imagen_data     = $_FILES["nuevo-logo"]["tmp_name"];
      $imagen_tamaño   = $_FILES["nuevo-logo"]["size"];
      $imagen_formato  = $_FILES["nuevo-logo"]["type"];
      // leemos la imagen y la converitmos en base64
      $read = fopen($imagen_data, "rb");
      $buffer = fread($read, $imagen_tamaño);
      $toImgBase64 = base64_encode($buffer);
      fclose($read);
      try{
      $db->begin_transaction(/*MYSQLI_TRANS_START_READ_ONLY*/);
          $db->query("INSERT INTO `imagen` (`logo`, `nombre`, `tamaño`, `formato`) 
          VALUES ('$toImgBase64','$imagen_nombre','$imagen_tamaño','$imagen_formato')");
          // recuperamos el id de la imagen insertada
          $logo_id = $db->insert_id;
          echo $db->insert_id;
          // insertamos los datos de empresa en la tabla
          $db->query("INSERT INTO `empresa` 
          (`id`, `nit`, `nombre`, `direccion`, `ciudad`, `pais`, `telefono`, `logo_id`) 
          VALUES ('$id', '$nit', '$empresa', '$direccion',  '$municipio',  '$departamento',  '$telefono',  '$logo_id')");
        $db->commit();
        echo " commit insert ";
      } catch (Exception $e) {
        echo $e;
        $db->rollback();
        throw $e; // but the error must be handled anyway
        
      }
    }
  }
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
      <div class="row mt-5 d-flex justify-content-center">
        <div class="col col-md-9">
          <h4 class="bg-info text-white text-center mb-0 py-0"><div class="mb-0"><span class="mx-2">Lista de Empresas</span></div></h4>
          <div class="shadow-lg p-4 mb-5 bg-white rounded">
            <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="form-empresa" class="needs-validation" novalidate>
            <div class="row mb-4">

              <div class="col col-md-12 mb-4">
                <div class="row col-inline">
                  <div class="col-md text-start">
                    <input type="button" id="nuevo" class="btn btn-sm btn-primary" value="&plus; Nuevo" />
                  </div>                
                  <div class="col-md text-end me-5">
                    <button id="guardar" class="btn btn-sm btn-outline-secondary" role="button" disabled>&check; Guardar Cambios</button>
                  </div>
                </div>
              </div>

              <div class="col col-md-6">
                <div class="row">
                    <label class="col-md-4 col-form-label bg-light"><strong>ID Registro</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col  pe-0">
                          <input type="text" id="id-empresa" name="id-empresa" class="form-control form-control-sm" placeholder="ID Registo" value="" readonly disabled>
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
                           <input type="text" id="nuevo-empresa" name="nuevo-empresa" class="form-control form-control-sm mb-2" placeholder="empresa" required>
                          <div class="valid-feedback">listo!</div>
                          <div class="invalid-feedback">Campo Obligatorio!!</div>

                          </div>
                      </div>
                    </div>
                </div>
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
                    <label class="col-md-4 col-form-label bg-light"><strong>Region</strong></label>
                    <div class="col-md-6">
                      <div class="row mb-3">
                        <div class="col  pe-0">
                          <input type="text" id="nuevo-departamento" name="nuevo-departamento" class="form-control form-control-sm mb-2" placeholder="Deptamento" >
                          <div class="valid-feedback">listo!</div>
                          <div class="invalid-feedback">Campo Obligatorio!!</div>

                        </div>
                        <div class="col  pe-0">
                          <input type="text" id="nuevo-municipio" name="nuevo-municipio" class="form-control form-control-sm mb-2" placeholder="Municipio">
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
                          <div class="valid-feedback">listo!</div>
                          <div class="invalid-feedback">Campo Obligatorio!!</div>
                          <div class="text-small">
                            <span id="img-size" class="small">tamaño: 0 KB</span>
                          </div>
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
            </form>

            <div class="row justify-content-center">
              <div class="col col-md-auto">
                <table class="table table-borderless table-sm table-striped table-hover table-wrapper border">
                  <thead class="table-dark text-center sticky-top" id="header-empresas">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col" hidden></th>
                      <th scope="col">NIT</th>
                      <th scope="col">Empresa</th>
                      <th scope="col" hidden>Telefono</th>
                      <th scope="col">Direccion</th>
                      <th scope="col" hidden>Depto</th>
                      <th scope="col" hidden>Municipio</th>
                      <th scope="col">logo</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody id="ListaEmpresas" class="fixed_header">
                    <?php if ($empresas): ?>
                        <?php foreach($empresas as $row): ?>
                          <tr id="<?= $count+=1; ?>" name="linea">
                            <th scope="row" name="numero"><?= $count; ?></th>
                            <td hidden><input type="number" id="id" name="id" class="" value="<?= $row['id']; ?>" required readonly></td>
                            <td><input type="text" name="nit" class="form-control form-control-sm" value="<?= $row['nit']; ?>" disabled readonly required></td>
                            <td><input type="text" name="empresa" class="form-control form-control-sm" value="<?= $row['nombre']; ?>" disabled readonly required></td>
                            <td hidden><input type="text" name="telefono" class="form-control form-control-sm" value="<?= $row['telefono']; ?>" disabled readonly required></td>
                            <td><textarea name="direccion"  rows="1" cols="90" class="form-control form-control-sm" value="<?= $row['direccion']; ?>"  disabled readonly required><?= $row['direccion']; ?></textarea></td>
                            <td hidden><input type="text" name="departamento" class="form-control form-control-sm" value="<?= $row['ciudad']; ?>" disabled readonly required></td>
                            <td hidden><input type="text" name="municipio" class="form-control form-control-sm" value="<?= $row['pais']; ?>" disabled readonly required></td>
                            <td><img name="logo-preview"  width="48" height="34" src="<?= convertir_a_img_src($row['logo'], $row['formato'])?>"></td>
                            <th class="text-center"><input type="button" name="editar" class="btn btn-sm btn-warning" value="&#9998;" tokenID="<?= $row['id'] ?>"/></th>
                          </tr>
                        <?php endforeach ?>
                      </tr>
                    <?php else: ?>
                      No data found
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="src/js/ListaEmpresa.js"></script>
</html>
