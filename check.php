<!--chacar tablas y datos de una bd-->
<!DOCTYPE html>
<html lang="es-MX">
<?php
    //Conectara la base de datos local, base de datos usuarios, tabla usuario
    $conexion = mysqli_connect("sql9.freemysqlhosting.net", "sql9581490", "GB4wrJmbX5","sql9581490");
    //Comprobar la conexion
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();
    }
    //Cuando se presione el boton de checar, se enviara las tablas y datos de la base de datos
    if (isset($_POST["checar"])) {
        //comprobar si la contraseña es igual a la registrada
        $sql = "SELECT * FROM usuario";
        $resultado = mysqli_query($conexion, $sql);
        //Mostrar tablas y datos de la base de datos
        $sql = "SELECT * FROM usuario";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Contraseña</th>";
            echo "</tr>";
            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<tr>";
                echo "<td>".$fila["nombre"]."</td>";
                echo "<td>".$fila["contrasena"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Error al comprobar el usuario";
        }
    }
    //cuando se presiona el boton crear, se creara una tabla en la base de datos
    if (isset($_POST["crear"])) {
        //Crear tabla en la base de datos
        $sql = "CREATE TABLE usuario (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(20) NOT NULL,
            contrasena VARCHAR(255) NOT NULL
        )";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo "Tabla creada";
        } else {
            echo "Error al crear la tabla";
        }
    }
    mysqli_close($conexion);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <title>Check</title>
</head>
<body>
    <h1>Check</h1>
    <form action="check.php" method="post">
        <input type="submit" name="checar" value="Checar">
    </form>
    <form action="check.php" method="post">
        <input type="submit" name="crear" value="Crear">
    </form>
</body>
</html>