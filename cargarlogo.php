<?php
session_start();

if (!isset($_SESSION["loggedin"])){
  header("location: login.php");
}
else{
  $nombre_usuario = $_SESSION["usuario"]["usuario_nombre"];
  $login          = $_SESSION["usuario"]["correo"];
  $tipo_usuario   = $_SESSION["usuario"]["role"];
  $empresa        = $_SESSION["usuario"]['empresa_nombre'];
  $imagen_logo    = $_SESSION["usuario"]['imagen_logo'];
  $imagen_tipo    = $_SESSION["usuario"]['imagen_formato'];
}

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    var_dump($_FILES['imagen']);
    if(!empty($_FILES['imagen'])){
        $imagen_nombre   = $_FILES["imagen"]["name"];
        $imagen_data     = $_FILES["imagen"]["tmp_name"];
        $imagen_tamaño   = $_FILES["imagen"]["size"];
        $imagen_formato  = $_FILES["imagen"]["type"];
        
        // leemos la imagen y la converitmos en base64
        $read = fopen($imagen_data, "rb");
        $buffer = fread($read, $imagen_tamaño);
        $toImgBase64 = base64_encode($buffer);
        fclose($read);

        //Insert imagen datos binario
        $insert = $db->query("INSERT into imagen (logo,nombre,tamaño,formato) VALUES ('$toImgBase64','$imagen_nombre','$imagen_tamaño','$imagen_formato')");
        
        if($insert){
            $id_img_guardada = $db->insert_id;

            echo "Imagen Guardad. ". $id_img_guardada;

            $result = $db->query("SELECT * FROM imagen where id= {$id_img_guardada}");
            if ($result->num_rows > 0){
              $img = $result->fetch_assoc();
              $logo =  "data:".$img["formato"].";base64,".$img['logo'];
            }
        }else{
            echo "La carga del archivo ha fallado, inténtelo de nuevo.";
        } 
    }else{
        echo "Por favor, seleccione un archivo de imagen para cargar.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("link.php")?>
</head>
<body>
  <?php include("navbar.php")?>
  <div class="row">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="formuladioImagen" enctype="multipart/form-data" class="form">
        <div class="col col-sm-4"><p>Seleccione la imagen que desea cargar:</p></div>
        <div class="col col-sm-4">
          <input type="file" id="logo" name="imagen" class="form-control form-control-sm" required />
        </div>
        <div class="col col-sm-4"><input type="submit" name="submit" class="btn btn-primary" value="Enviar Imagen"/></div>
      </form>
  </div>
  <img id="img" src="" width=98 height=98 />
  <img id="img" src="<?php echo $logo; ?>" width=98 height=98 />
</body>
<script type="text/javascript">
    // ver imagen
    // const previewImg = document.querySelector('#logo').addEventListener('change',(evt) =>
    // {
        
    //     var tgt = evt.target || window.event.srcElement,
    //     files = tgt.files;
    
    //     // FileReader support
    //     if (FileReader && files && files.length) {
    //         var fr = new FileReader();
    //         fr.onload = function () {
    //             document.querySelector('#img').src = fr.result;
    //         }
    //         fr.readAsDataURL(files[0]);
    //     }
    
    //     // Not supported
    //     else {
    //         // fallback -- perhaps submit the input to an iframe and temporarily store
    //         // them on the server until the user's session ends.
    //     }
    //});

</script>
</html>