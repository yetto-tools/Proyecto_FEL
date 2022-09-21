<?php


function opcion_activa($opcion){
  if (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], '/' )+1) === $opcion){
    return  $arrayName = array("opcion" => $opcion, "is_active" => 'active');
  }
  else{
    return  $arrayName = array("opcion" => $opcion, "is_active" => '');
  }
}



echo opcion_activa("reset.php")['is_active'];



function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    $result = vsprintf('%s%s-%s-%s-%s%s%s%s', str_split(strtoupper(bin2hex($data)), 4));
    
    return $result;
}


echo guidv4();
// A0E1B324-1FA4-3E20-0C18B9413D6EA510
// 50d1f482-f7c8-434e-b12312f522276d9f

define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('DATABASE', 'Proyect_FEL');
 
try {
    $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
session_start();
 
    
    $login = 'admin@admin.com';
    $password = '123456';
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    echo "<p>".$password_hash."</p>";
 
    $stmt = $connection->prepare("
        SELECT 
            u.id,
            u.nombre_usuario, 
            u.login, 
            e.nombre_empresa, 
            u.password, 
            t.tipo_usuario
        FROM usuario u 
            LEFT JOIN tipo_usuario t ON u.id_tipo = t.id_tipo 
            LEFT JOIN empresa e ON e.id_empresa = u.id_empresa 
        WHERE u.login=:login
    ");
    $stmt->bindParam("login", $login, PDO::PARAM_STR);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $status = password_verify('123456', $result['password']);

    echo "<pre>"."estatus: ".$status."</pre>";

    if ($stmt->rowCount() > 0) {
        echo '<p class="error">The email address is already registered!</p>';
        echo '<p><input type="number" value="'.$result['id'].'"></input></p>';
        echo '<p><input type="text" value="'.$result['nombre_usuario'].'"></input></p>';
        echo '<p><input type="email" value="'.$result['login'].'"></input></p>';
        echo '<p><input type="email" value="'.$result['nombre_empresa'].'"></input></p>';
        echo '<p><input type="email" value="'.$result['tipo_usuario'].'"></input></p>';
    }
    else{
        echo '<p class="error">Not registered!</p>';
    }

    
        

 
?>