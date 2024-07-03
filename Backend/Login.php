<?php
// Configuración de la conexión a la base de datos
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
        // Inicio de sesión exitoso
        echo "Inicio de sesión exitoso. Bienvenido, " . $row['nombre'] . "!";
        // Aquí puedes redirigir al usuario a otra página o iniciar una sesión
        // header("Location: pagina_protegida.php");
    } else {
        // Inicio de sesión fallido
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    sqlsrv_free_stmt($stmt);
}

sqlsrv_close($conn);
?>