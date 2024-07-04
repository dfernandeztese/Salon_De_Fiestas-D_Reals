<?php
$nombreHost = 'localhost';
$nombreUsuario = 'root';
$pwd = '';
$nombreBD = 'salon';

$tipoEvento = $_POST["tipoEvento"];
$canInvitados = $_POST["cantidadInvitados"];
$colores = $_POST["colores"];

$cremas = $_POST["cremas"];
$pastas = $_POST["pastas"];
$platoFuerte = $_POST["platoFuerte"];

$invitadosAdultos = $_POST["invitadosAdultos"];
$invitadosNinios = $_POST["invitadosNinios"];

$fecha = $_POST["apartadoEvento"];
$horario = $_POST["horario"];
$horario_Ini = "11:00";
$horario_Fin = "13:00";

$numPlatillos = $_POST["numPlatillos"];

$servicio = $_POST["servicio"];

$nombre = $_POST["nombre"];
$apPaterno = "?";
$apMaterno = "?";
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];

$conexionDB = mysqli_connect($nombreHost, $nombreUsuario, $pwd, $nombreBD) or die("¡ERROR! - NO SE PUDO CONECTAR AL SERVIDOR :(");
// Tipo_eventos
$guardarTipoEvento = "INSERT INTO Tipo_eventos (nombre) VALUES ('".$tipoEvento."')";
$sector1 = mysqli_query($conexionDB, $guardarTipoEvento) or die ("ACABA DE SUCEDER UN ERROR AL MOMENTO DE REGISTRAR LA SOLICITUD (SECTOR 1)");

$iD_tipoE = "SELECT ID_tipoE FROM Tipo_eventos ORDER BY ID_tipoE DESC LIMIT 1";

if ($stmt = $conexionDB->prepare($iD_tipoE)) {
    $stmt->execute();
    $stmt->bind_result($iD_tipoE);
    while ($stmt->fetch()) {}
    $stmt->close();
}

// Comida
$guardarComida = "INSERT INTO Comida (ID_OEntrada, ID_OMedio, ID_OFuerte, cantidad) VALUES ('".$cremas."','".$pastas."','".$platoFuerte."','".$numPlatillos."')";
$sector2 = mysqli_query($conexionDB, $guardarComida) or die ("ACABA DE SUCEDER UN ERROR AL MOMENTO DE REGISTRAR LA SOLICITUD (SECTOR 2)");

$ID_menu = "SELECT ID_menu FROM Comida ORDER BY ID_menu DESC LIMIT 1";

if ($stmt = $conexionDB->prepare($ID_menu)) {
    $stmt->execute();
    $stmt->bind_result($ID_menu);
    while ($stmt->fetch()) {}
    $stmt->close();
}

// Eventos
$guardarEventos = "INSERT INTO Eventos (fecha, hora_ini, hora_fin, personas, tipo_evento, ID_menu) VALUES ('".$fecha."','".$horario_Ini."','".$horario_Fin."','".$canInvitados."','".$iD_tipoE."','".$ID_menu."')";
$sector3 = mysqli_query($conexionDB, $guardarEventos) or die ("ACABA DE SUCEDER UN ERROR AL MOMENTO DE REGISTRAR LA SOLICITUD (SECTOR 3)");

$ID_evento = "SELECT ID_evento FROM Eventos ORDER BY ID_evento DESC LIMIT 1";

if ($stmt = $conexionDB->prepare($ID_evento)) {
    $stmt->execute();
    $stmt->bind_result($ID_evento);
    while ($stmt->fetch()) {}
    $stmt->close();
}

// Cliente
$guardarCliente = "INSERT INTO Cliente (nombre, apellido_p, apellido_m, telefono) VALUES ('".$nombre."','".$apPaterno."','".$apMaterno."','".$telefono."')";
$sector4 = mysqli_query($conexionDB, $guardarCliente) or die ("ACABA DE SUCEDER UN ERROR AL MOMENTO DE REGISTRAR LA SOLICITUD (SECTOR 3)");

$ID_cliente = "SELECT ID_cliente FROM Cliente ORDER BY ID_cliente DESC LIMIT 1";

if ($stmt = $conexionDB->prepare($ID_cliente)) {
    $stmt->execute();
    $stmt->bind_result($ID_cliente);
    while ($stmt->fetch()) {}
    $stmt->close();
}

// Contratos
$guardarContratos = "INSERT INTO Contratos (ID_cliente, ID_evento) VALUES ('".$ID_cliente."','".$ID_evento."')";
$sector4 = mysqli_query($conexionDB, $guardarContratos) or die ("ACABA DE SUCEDER UN ERROR AL MOMENTO DE REGISTRAR LA SOLICITUD (SECTOR 3)");

$ID_contrato = "SELECT ID_contrato FROM Contratos ORDER BY ID_contrato DESC LIMIT 1";

if ($stmt = $conexionDB->prepare($ID_contrato)) {
    $stmt->execute();
    $stmt->bind_result($ID_contrato);
    while ($stmt->fetch()) {}
    $stmt->close();
}

echo "Información guardada con exito, Su N° de contrato es: ".$ID_contrato
?>