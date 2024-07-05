<?php // BD
// Credenciales del servidor
$nombreServidor = "localhost";
$credenciales = array(
    "Database" => "salon",
    "Uid" => "sa",
    "PWD" => "123456789"
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'REALS</title>
    <link rel="stylesheet" href="../CSS/Style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style = "background-color: #E3E4E5;">
    <div>
        <ul>
            <li><a class="active" href="clientes.php"><img alt = "HTML 5 Icon" src = "../IMG/icono.png" class = "icono"></a></li>
            <li><a href="contratos.php">Contratos</a></li>
            <li><a href="clientes.php">Clientes</a></li>
            <li class="iconoLogin"><a href="index.html"><img class="iconoLoginImg" alt="iconoLogin" src="../IMG/login_icono_Salir.png"></a></li>
        </ul>
    </div>
    <div>
        <br>
        <br>
        <?php
            $conexion = sqlsrv_connect($nombreServidor, $credenciales);

            if ($conexion === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            $consultaTmp = "SELECT * FROM ContratosPorClientes";
            $stmt  = sqlsrv_query($conexion, $consultaTmp);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            echo <<< EOT
            <table border = "1"> <!-- ContratoPorClientes -->
                <tr>
                    <th>Id_Contrato</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                </tr>
            EOT;

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                    echo "<td>" . $row['ID_contrato'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['correo'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        ?>
    </div>
</body>
</html>