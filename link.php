<?php
function opcion_activa(){
  $opcion = substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], '/' )+1);
  return  $menu = array(
            "opcion" => $opcion, 
            "is_active" => 'active',
            "endpoint" => explode(".php", $opcion)[0]
          );
  }
?>
<!--  bootstrap local -->
<link rel="stylesheet" type="text/css" href="src/bootstrap-5.2.1-dist/css/bootstrap.min.css">
<!-- js bootstrap -->
<script type="text/javascript" src="src/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
<!--  css personalizado -->
<link rel="stylesheet" type="text/css" href="src/css/style.css">

