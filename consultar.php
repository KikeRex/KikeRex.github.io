<!--Consultar los datos de la base de datos-->
<!DOCTYPE html>
<html lang="en">
<?php
    //Conectara la base de datos, tabla usuario con columnas id, nombre y contraseña
    $conexion = mysqli_connect("sql9.freemysqlhosting.net", "sql9581490", "GB4wrJmbX5","sql9581490");
    //Comprobar la conexion
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();
    }
    //Comprobar si el usuario ha enviado el formulario
    if(isset($_POST["consultar"])){
        //Recoger los datos del formulario
        $nombre = $_POST["nombre"];
        $contrasena = $_POST["contrasena"];
        //comprobar si la contraseña es igual a la registrada
        $sql = "SELECT * FROM usuario WHERE nombre = '$nombre'";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            $fila = mysqli_fetch_array($resultado);
            if ($contrasena == $fila["contrasena"]) {
                //Mostrar los datos del usuario
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Nombre</th>";
                echo "<th>Contraseña</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>".$fila["nombre"]."</td>";
                echo "<td>".$fila["contrasena"]."</td>";
                echo "</tr>";
                echo "</table>";
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Error al comprobar el usuario";
        }
        
    }
    //en caso consultar todo
    if(isset($_POST["consultarTodo"])){
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
        }
    }
    mysqli_close($conexion);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <title>Consultas</title>
</head>
<body>
    <?php include "header.html"; ?>
    
    <form action="consultar.php" method="post">
        <h1>Consultas</h1>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena">
        <br>
        <input type="submit" name="consultar" value="Consultar">
        <input type="submit" name="consultarTodo" value="Consultar todo">
    </form>
    
</body>
</html>