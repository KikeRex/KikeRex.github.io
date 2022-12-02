<!DOCTYPE html>
<html lang="es-mx">
<?php
    //Conectar a la base de datos para editar el usuario
    $conexion = mysqli_connect("sql9.freemysqlhosting.net", "sql9581490", "GB4wrJmbX5","sql9581490");
    //Comprobar la conexion
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();
    }
    //Comprobar si el usuario ha enviado el formulario
    if (isset($_POST["enviar"])) {
        //Recoger los datos del formulario
        $nombre = $_POST["nombre"];
        $contrasena = $_POST["contrasena"];
        $contrasena2 = $_POST["contrasena2"];
        //comprobar si la contraseña es igual a la registrada
        $sql = "SELECT * FROM usuario WHERE nombre = '$nombre'";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            $fila = mysqli_fetch_array($resultado);
            //comprobar si las contraseña es igual a la registrada
            if ($contrasena == $fila["contrasena"]) {
                //Editar usuario de la base de datos
                $sql = "UPDATE usuario SET contrasena = '$contrasena2' WHERE nombre = '$nombre'";
                $resultado = mysqli_query($conexion, $sql);
                if ($resultado) {
                    echo "Usuario editado";
                } else {
                    echo "Error al editar el usuario";
                }
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Error al comprobar el usuario";
        }
    }
    mysqli_close($conexion);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <title>Editar Usuario</title>
</head>
<body>
    <?php include "header.html"; ?>
    
    <form action="editar.php" method="post">
        <h1>Editar Usuario</h1>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="contrasena">Contraseña actual</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <label for="contrasena2">Nueva contraseña</label>
        <input type="password" name="contrasena2" id="contrasena2" required>
        <input type="submit" name="enviar" value="Editar">
    </form>
    
</body>
</html>