<?php
require_once "config.php";
//buscar nit cliente factura
if (!empty($_GET['cliente'])){
  $id_cliente = $_GET['cliente'];
  function buscarCliente($db, $id_cliente){
    $sql = "SELECT * FROM `lista_cliente` WHERE lista_cliente_nit = '$id_cliente';";      
    $result = $db->query($sql);
    $clientes = $result->fetch_assoc();
    return $clientes;
  }
  // retorn json con datos cliente factura
  header('Content-type: application/json');
  echo json_encode( $data = buscarCliente($db, $id_cliente));
 
}

if (!empty($_GET['producto'])){
  $codigo = $_GET['producto'];
  function buscarProducto($db, $codigo){
    $sql = "SELECT * FROM `producto` WHERE codigo = '$codigo';";  
    $result = $db->query($sql);
    $producto = $result->fetch_assoc();
    return $producto;
  }
  // retorna json con datos producto
  header('Content-type: application/json');
  echo json_encode( $data = buscarProducto($db, $codigo));
 
}

// Funcion Elimiar Producto
if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
  parse_str(file_get_contents('php://input'),$_DELETE);
  $value = $_DELETE["id-producto"];
  $response = array("resultado"=> $value);
  $stmt = $db->prepare("DELETE FROM producto WHERE id_producto = ?;");
  $stmt->bind_param("i", $value);
  $stmt->execute();
  $stmt->close();
  header('Content-type: application/json');
  echo json_encode();
  
}





// if (!empty($_GET['producto'])){
//   $codigo_producto = $_GET['cliente'];
//   function ListaClientes($db, $codigo_producto){
//     $sql = "SELECT * FROM `producto` WHERE codigo_producto = '$codigo_producto';";  
//     // Listar Empresas
//     $count=0;
//     $stmt = $db->prepare($sql);
//     // $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result(); // get the mysqli result
//     //$titulos = $result->fetch_assoc();
//     $clientes = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
//     return $clientes;
//   }
//   header('Content-type: application/json');
//   echo json_encode( $data = ListaClientes($db, $id_cliente));
 
// }


?>