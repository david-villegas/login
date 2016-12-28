<?php

 $host_db = "localhost";
 $user_db = "root";
 $pass_db = "";
 $db_name = "bd_pruebas";
 $tbl_name = "t_usuarios";
 
 $form_pass = $_POST['password'];
 
 //$hash = password_hash($form_pass, PASSWORD_BCRYPT); //la variable $hash almacena la función password_hash(); la cual utiliza como parámetros la variable $form_pass y el algoritmo de encriptacion CRYPT_BLOWFISH.

 $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

 if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

 $buscarUsuario = "SELECT * FROM $tbl_name
 WHERE nom_user = '$_POST[username]' ";

 $result = $conexion->query($buscarUsuario);

 $count = mysqli_num_rows($result);

 if ($count == 1) {
 echo "<br />". "El Nombre de Usuario ya ha sido tomado." . "<br />";

 echo "<a href='inicio.html'>Por favor escoga otro Nombre</a>";
 }
 else{

 $query = "INSERT INTO t_usuarios (nom_user, pass_user)
           VALUES ('$_POST[username]', '$_POST[password]')";
           // VALUES ('$_POST[username]', '$hash')"; //Se habilita cuando se utiliza la variable $hash descrita al inicio
 if ($conexion->query($query) === TRUE) {
 
 echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 echo "<h4>" . "Bienvenido: " . $_POST['username'] . "</h4>" . "\n\n";
 echo "<h5>" . "Hacer Login: " . "<a href='login.html'>Login</a>" . "</h5>"; 
 }

 else {
 echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
   }
 }
 mysqli_close($conexion);
?>