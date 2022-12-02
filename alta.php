<!--Crear un formulario para dar de alta un nuevo usuario-->
<!DOCTYPE html>
<html lang="es">
<?php
    //Conectara la base de datos local, base de datos usuarios, tabla usuario
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
        $recon = $_POST["recon"];
        //comprobar si la contraseña es igual a la confirmacion
        if ($contrasena == $recon) {
            //Cifrar la contraseña
            //$contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
            //Insertar usuario en la base de datos
            $sql = "INSERT INTO usuario (nombre, contrasena) VALUES ('$nombre', '$contrasena')";
            $resultado = mysqli_query($conexion, $sql);
            if ($resultado) {
                echo "Usuario registrado";
            } else {
                echo "Error al registrar el usuario";
            }
        } else {
            echo "Las contraseñas no coinciden";
        }
    }
    mysqli_close($conexion);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <title>Registro</title>
</head>
<body>
    <!--Importar el archivo header.html-->
    <?php include "header.html"; ?>
    <form action="alta.php" method="post">
        <h1>Registro</h1>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena">
        <br>
        <label for="recon">Confirmar contraseña</label>
        <input type="password" name="recon" id="recon">
        <br>
        <input type="submit" name="enviar" value="Registrar">
    </form>
    
</body>
</html>