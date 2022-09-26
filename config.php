<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');


try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    if (!$db) {
        die("<h2>No conectado: " . $db->error."</h2>");
    } else {
        $db_selected = $db->select_db(DB_NAME);
        if (!$db_selected) {
            die ('<h2>Error : ' . $db->error.'  </h2>');
        }
    }
}
catch(Exception $e){
    exit("<h2> Hay Problemas: <br>".$e->getMessage()."</h2>");
}
// obtener nombre del archivo sin extensio
function seTitlePage(){
    $opcion = substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], '/' )+1);
    return explode(".php", $opcion)[0];
}
// mostar ruta seleccionada
  function opcion_activa(){
    $opcion = substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], '/' )+1);
  return  $menu = array(
            "opcion" => $opcion,
            "is_active" => 'active',
            "endpoint" => explode(".php", $opcion)[0]
          );
  }

  function convertir_a_img_src($blob,$formato){
    return "data:".$formato.";base64,".$blob;
  }

?>