<!--Crear un formulario para dar de baja un nuevo usuario-->
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
        //comprobar si la contraseña es igual a la registrada
        $sql = "SELECT * FROM usuario WHERE nombre = '$nombre'";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            $fila = mysqli_fetch_array($resultado);
            /*
            if (password_verify($contrasena, $fila["contrasena"])) {
                //Eliminar usuario de la base de datos
                $sql = "DELETE FROM usuario WHERE nombre = '$nombre'";
                $resultado = mysqli_query($conexion, $sql);
                if ($resultado) {
                    echo "Usuario eliminado";
                } else {
                    echo "Error al eliminar el usuario";
                }
                
            //$sql = "DELETE FROM usuario WHERE nombre = '$nombre'";
            } else {
                echo "Contraseña incorrecta";
            }
            */
            $sql = "DELETE FROM usuario WHERE nombre = '$nombre'";
            $resultado = mysqli_query($conexion, $sql);
            if ($resultado) {
                echo "Usuario eliminado";
            } else {
                echo "Error al eliminar el usuario";
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
    <title>baja</title>
</head>
<body>
    <?php include "header.html"; ?>
    
    <form action="baja.php" method="post">
        <h1>Baja</h1>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena">
        <br>
        <input type="submit" name="enviar" value="Eliminar">
    </form>
    
</body>
</html>