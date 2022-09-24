    if($stmt = $db->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_username);
      // Set parameters
      $param_username = $email;
          
      // Attempt to execute the prepared statement
      if($stmt->execute($stmt)){
        // Store result
        $stmt->store_result();
        // Check if username exists, if yes then verify password
        if($stmt->num_rows == 1){
          
          // Bind result variables
          $stmt->bind_result($id, $usuario ,$correo, $hashed_password, $empresa, $tipo);
          
          if($stmt->stmt_fetch()){
            // verificamos password
            if(password_verify($password, $hashed_password)){
              // La contraseña es correcta, así que inicia una nueva sesión
              session_start();
              // Store data in session variables
              $_SESSION["loggedin"]       = true;
              $_SESSION["id"]             = $id;
              $_SESSION["nombre_usuario"] = $usuario;
              $_SESSION["login"]          = $correo;
              $_SESSION["nombre_empresa"] = $empresa;
              $_SESSION["tipo_usuario"]   = $tipo;
                   
              // Redirigir al usuario a la página de bienvenida
              header("location: inicio.php");
            } else{
              // Password is not valid, display a generic error message
              $login_err =  "Contraseña no válidos.";
            }
          }
        } else{
          // La contraseña no es válida, muestra un mensaje de error genérico
            $login_err = "El usuario No Existe o hay un problema";
          }
        } else{
          $stmt->close();
        }          
      } else {
        $_SESSION['error'] = "¡Oops! Algo ha ido mal. Por favor, inténtelo de nuevo más tarde.";
    }
