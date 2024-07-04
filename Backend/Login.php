<?php  // BD
// Credenciales
$serverName = "localhost";
$connectionOptions = array(
    "Database" => "salon",
    "Uid" => "sa",
    "PWD" => "123456789"
);

// Conexión a la base de datos
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar el nombre de usuario y la contraseña
    $tsql = "SELECT * FROM Administrador WHERE nombre = ? AND contrasenia = ?";
    $params = array($username, $password);

    $stmt = sqlsrv_query($conn, $tsql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($row) {
        //echo "Inicio de sesión exitoso. Bienvenido, " . $row['nombre'] . "!";
        echo <<< EOT
            <meta http-equiv="Refresh" content="0; url='../Administrador/clientes.html'" />
        EOT;
    } else {
        //echo "Nombre de usuario o contraseña incorrectos.";
        echo <<< EOT
            <script>
                alert('Nombre de usuario o contraseña incorrectos');
                history.go(-1)
            </script>
        EOT;
    }

    sqlsrv_free_stmt($stmt);
}

sqlsrv_close($conn);
?>