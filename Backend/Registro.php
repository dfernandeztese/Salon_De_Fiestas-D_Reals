<?php
// Credenciales del servidor
$nombreServidor = "localhost";
$credenciales = array(
    "Database" => "salon",
    "Uid" => "sa",
    "PWD" => "123456789"
);

$conexion = sqlsrv_connect($nombreServidor, $credenciales);

if ($conexion === false) {
    die(print_r(sqlsrv_errors(), true));
} 

$salon = $_POST["salon"];
$tipoEvento = $_POST["tipoEvento"];
$colAdorno = $_POST["colAdorno"];

// Menu
$entradas =$_POST["entradas"];
$medios = $_POST["medios"];
$fuertes = $_POST["fuertes"];
$costo = $_POST["costo"];

$numAdultos = $_POST["adultos"];
$numNinos = $_POST["ninos"];
$fechaSeleccionada = $_POST["fechaSeleccionada"];
$horarioSeleccionadoIni = $_POST["horarioSeleccionadoIni"];
$horarioSeleccionadoFin = $_POST["horarioSeleccionadoFin"];
$numPlatillos = $_POST["numPlatillos"];

// Entrada
$consultaEntrada = "SELECT ID_OEntrada FROM Entradas WHERE entrada = '".$entradas."'";
$stmtEntrada  = sqlsrv_query($conexion, $consultaEntrada);

if ($stmtEntrada === false) {
    die(print_r(sqlsrv_errors(), true));
}

$idEntrada = 0;
while ($row = sqlsrv_fetch_array($stmtEntrada, SQLSRV_FETCH_ASSOC)) {
    $idEntrada = $row['ID_OEntrada'];
}

// Medios
$consultaMedios = "SELECT ID_OMedio FROM Medios WHERE platoMedio = '".$medios."'";
$stmtMedios  = sqlsrv_query($conexion, $consultaMedios);

if ($stmtMedios === false) {
    die(print_r(sqlsrv_errors(), true));
}

$idMedio = 0;
while ($row = sqlsrv_fetch_array($stmtMedios, SQLSRV_FETCH_ASSOC)) {
    $idMedio = $row['ID_OMedio'];
}

// Fuertes
$consultaFuertes = "SELECT ID_OFuerte FROM Fuertes WHERE platoFuerte = '".$fuertes."'";
$stmtFuertes  = sqlsrv_query($conexion, $consultaFuertes);

if ($stmtFuertes === false) {
    die(print_r(sqlsrv_errors(), true));
}

$idFuerte = 0;
while ($row = sqlsrv_fetch_array($stmtFuertes, SQLSRV_FETCH_ASSOC)) {
    $idFuerte = $row['ID_OFuerte'];
}

// Comida
$registroComida = "INSERT INTO Comida (ID_OEntrada, ID_OMedio, ID_OFuerte, cantidad)  VALUES (?, ?, ?, ?)";
$paramComida = array($idEntrada, $idMedio, $idFuerte, $numPlatillos);

$stmtComida = sqlsrv_query($conexion, $registroComida, $paramComida);

if ($stmtComida === false) {
    die(print_r(sqlsrv_errors(), true));
} 

$idComidaTmp = "SELECT TOP 1 ID_menu FROM Comida ORDER BY ID_menu DESC";
$stmtComidaTmp  = sqlsrv_query($conexion, $idComidaTmp);

if ($stmtComidaTmp === false) {
    die(print_r(sqlsrv_errors(), true));
}

$idComida = 0; // ID_menu
while ($row = sqlsrv_fetch_array($stmtComidaTmp, SQLSRV_FETCH_ASSOC)) {
    $idComida = $row['ID_menu'];
}


$musica = "";
$costoMusica = 0;

$meseros = "";
$costoMeseros = 0;

$barra = "";
$costoBarra = 0;

$parking = "";
$costoParking = 0;

// Datos Personales
$nombre = $_POST["nombre"];
$apellidoP = $_POST["aPaterno"];
$apellidoM = $_POST["aMaterno"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];

$verificarExistencia = array("musica", "meseros", "barra", "parking");

// Servicios_salon
$consulta1 = "SELECT ID_salon FROM Salones WHERE ubicacion = '".$salon."'";
$stmt1  = sqlsrv_query($conexion, $consulta1);

if ($stmt1 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$idSalon = 0;
while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
    $idSalon = $row['ID_salon'];
}

// Servicios
$idMusica = 0;
$idMeseros = 0;
$idBarra = 0;
$idParking = 0;

for($a = 0; $a < count($verificarExistencia); $a++){
    if(isset($_POST[$verificarExistencia[$a]]) == true){
        // MUSICA
        if(strcmp($verificarExistencia[$a],"musica") == 0){
            $musica = $_POST[$verificarExistencia[$a]];
            // Id
            $idMusicaTmp = "SELECT ID_servicio FROM Servicios WHERE tipo_servicio = '".$musica."'";
            $stmt1_1  = sqlsrv_query($conexion, $idMusicaTmp);

            if ($stmt1_1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row1 = sqlsrv_fetch_array($stmt1_1, SQLSRV_FETCH_ASSOC)) {
                $idMusica = $row1['ID_servicio'];
            }
            // Costo
            $costoTmp = "SELECT costo FROM Servicios WHERE tipo_servicio = '".$musica."'";
            $stmt1_2  = sqlsrv_query($conexion, $costoTmp);

            if ($stmt1_2 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row2 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
                $costoMusica = $row2['costo'];
            }
            // Servicios_salon
            $servicioSalon1 = "INSERT INTO Servicios_salon (ID_salon, ID_servicio)  VALUES (?, ?)";
            $parametros1 = array($idSalon, $idMusica);

            $stmt1_3 = sqlsrv_query($conexion, $servicioSalon1, $parametros1);

            if ($stmt1_3 === false) {
                die(print_r(sqlsrv_errors(), true));
            } 
        }
        // MESEROS
        if(strcmp($verificarExistencia[$a],"meseros") == 0){
            $meseros = $_POST[$verificarExistencia[$a]];
            // Id
            $idMeserosTmp = "SELECT ID_servicio FROM Servicios WHERE tipo_servicio = '".$meseros."'";
            $stmt2_1  = sqlsrv_query($conexion, $idMeserosTmp);

            if ($stmt2_1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row3 = sqlsrv_fetch_array($stmt2_1, SQLSRV_FETCH_ASSOC)) {
                $idMeseros = $row3['ID_servicio'];
            }
            // Costo
            $costoTmp = "SELECT costo FROM Servicios WHERE tipo_servicio = '".$meseros."'";
            $stmt2_2  = sqlsrv_query($conexion, $costoTmp);

            if ($stmt2_2 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row4 = sqlsrv_fetch_array($stmt2_2, SQLSRV_FETCH_ASSOC)) {
                $costoMeseros = $row4['costo'];
            }
            // Servicios_salon
            $servicioSalon2 = "INSERT INTO Servicios_salon (ID_salon, ID_servicio)  VALUES (?, ?)";
            $parametros2 = array($idSalon, $idMeseros);

            $stmt2_3 = sqlsrv_query($conexion, $servicioSalon2, $parametros2);

            if ($stmt2_3 === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
        // BARRA
        if(strcmp($verificarExistencia[$a],"barra") == 0){
            $barra = $_POST[$verificarExistencia[$a]];
            // Id
            $idMeserosTmp = "SELECT ID_servicio FROM Servicios WHERE tipo_servicio = '".$barra."'";
            $stmt3_1  = sqlsrv_query($conexion, $idMeserosTmp);

            if ($stmt3_1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row5 = sqlsrv_fetch_array($stmt3_1, SQLSRV_FETCH_ASSOC)) {
                $idBarra = $row5['ID_servicio'];
            }
            // Costo
            $costoTmp = "SELECT costo FROM Servicios WHERE tipo_servicio = '".$barra."'";
            $stmt3_2  = sqlsrv_query($conexion, $costoTmp);

            if ($stmt3_2 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt3_2, SQLSRV_FETCH_ASSOC)) {
                $costoBarra = $row['costo'];
            }
            // Servicios_salon
            $servicioSalon3 = "INSERT INTO Servicios_salon (ID_salon, ID_servicio)  VALUES (?, ?)";
            $parametros3 = array($idSalon, $idBarra);

            $stmt3_3 = sqlsrv_query($conexion, $servicioSalon3, $parametros3);

            if ($stmt3_3 === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
        // PARKING
        if(strcmp($verificarExistencia[$a],"parking") == 0){
            $parking = $_POST[$verificarExistencia[$a]];
            // Id
            $idParkingTmp = "SELECT ID_servicio FROM Servicios WHERE tipo_servicio = '".$parking."'";
            $stmt4_1  = sqlsrv_query($conexion, $idParkingTmp);

            if ($stmt4_1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            
            while ($row6 = sqlsrv_fetch_array($stmt4_1, SQLSRV_FETCH_ASSOC)) {
                $idParking = $row6['ID_servicio'];
            }
            // Costo
            $costoTmp = "SELECT costo FROM Servicios WHERE tipo_servicio = '".$parking."'";
            $stmt4_2  = sqlsrv_query($conexion, $costoTmp);

            if ($stmt4_2 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt4_2, SQLSRV_FETCH_ASSOC)) {
                $costoParking = $row['costo'];
            }
            // Servicios_salon
            $servicioSalon4 = "INSERT INTO Servicios_salon (ID_salon, ID_servicio)  VALUES (?, ?)";
            $parametros4 = array($idSalon, $idParking);

            $stmt4_3 = sqlsrv_query($conexion, $servicioSalon4, $parametros4);

            if ($stmt4_3 === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
}

//$costoTotal = ($costo*$numPlatillos) + $costoMusica + $costoMeseros + $costoBarra + $costoParking;
$costo = floatval($costo);
$numPlatillos = intval($numPlatillos);
$costoMusica = floatval($costoMusica);
$costoMeseros = floatval($costoMeseros);
$costoBarra = floatval($costoBarra);
$costoParking = floatval($costoParking);
$costoTotal = 0;

$costoTotal = ($costo * $numPlatillos) + $costoMusica + $costoMeseros + $costoBarra + $costoParking;

// Cliente
$nuevoRegistro = "INSERT INTO Cliente (nombre, apellido_p, apellido_m, telefono, correo)  VALUES (?, ?, ?, ?, ?)";
$parametros = array($nombre, $apellidoP, $apellidoM, $telefono, $correo);

$stmt = sqlsrv_query($conexion, $nuevoRegistro, $parametros);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} 

$idClienteTmp = "SELECT TOP 1 ID_cliente FROM Cliente ORDER BY ID_cliente DESC";
$stmtClienteTmp  = sqlsrv_query($conexion, $idClienteTmp);

if ($stmtClienteTmp === false) {
    die(print_r(sqlsrv_errors(), true));
}

$idCliente = 0; // ID_menu
while ($row = sqlsrv_fetch_array($stmtClienteTmp, SQLSRV_FETCH_ASSOC)) {
    $idCliente = $row['ID_cliente'];
}

//sqlsrv_free_stmt($stmt);
//sqlsrv_close($conexion);

// Eventos
$nuevoEvento= "INSERT INTO Eventos (fecha, hora_ini, hora_fin, personas, tipo_evento, ID_menu)  VALUES (?, ?, ?, ?, ?, ?)";
$paramnuevoEvento = array($fechaSeleccionada, $horarioSeleccionadoIni, $horarioSeleccionadoFin, $numPlatillos, $tipoEvento, $idComida);

$stmtNuevoEvento = sqlsrv_query($conexion, $nuevoEvento, $paramnuevoEvento);

if ($stmtNuevoEvento === false) {
    die(print_r(sqlsrv_errors(), true));
} 

$idEventoTmp = "SELECT TOP 1 ID_evento FROM Eventos ORDER BY ID_evento DESC";
$stmtEventoTmp  = sqlsrv_query($conexion, $idEventoTmp);

if ($stmtEventoTmp === false) {
    die(print_r(sqlsrv_errors(), true));
}

$idEvento = 0; // ID_menu
while ($row = sqlsrv_fetch_array($stmtEventoTmp, SQLSRV_FETCH_ASSOC)) {
    $idEvento = $row['ID_evento'];
}

// Eventos_salones
$eventosSalones = "INSERT INTO Eventos_salones (ID_salon, ID_evento)  VALUES (?, ?)";
$paramEventosSalones = array($idSalon,$idEvento);

$stmtEventosSalones = sqlsrv_query($conexion, $eventosSalones, $paramEventosSalones);

if ($stmtEventosSalones === false) {
    die(print_r(sqlsrv_errors(), true));
} 

// Contratos
$contratoTmp = "INSERT INTO contratos (ID_cliente, ID_evento)  VALUES (?, ?)";
$paramContrato = array($idCliente, $idEvento);

$stmtEventosSalones = sqlsrv_query($conexion, $contratoTmp, $paramContrato);

if ($stmtEventosSalones === false) {
    die(print_r(sqlsrv_errors(), true));
} 

$idContratoTmp = "SELECT TOP 1 ID_contrato FROM Contratos ORDER BY ID_contrato DESC";
$stmtContratoTmp  = sqlsrv_query($conexion, $idContratoTmp);

if ($stmtContratoTmp === false) {
    die(print_r(sqlsrv_errors(), true));
}

$idContrato = 0; // ID_menu
while ($row = sqlsrv_fetch_array($stmtContratoTmp, SQLSRV_FETCH_ASSOC)) {
    $idContrato = $row['ID_contrato'];
}

/*echo "<br><br><br><br>";
echo "ID Contrato: ".$idContrato."<br>";
echo "Salon: ".$salon."<br>";
echo "Tipo de evento: ".$tipoEvento."<br>";
echo "Color de adorno: ".$colAdorno."<br>";
echo "Costo: ".$costo."<br>";

echo "N° Adultos: ".$numAdultos."<br>";
echo "N° Niños: ".$numNinos."<br>";
echo "Fecha Seleccionado: ".$fechaSeleccionada."<br>";
echo "Horario Seleccionado Inicio: ".$horarioSeleccionadoIni."<br>";
echo "Horario Seleccionado Fin: ".$horarioSeleccionadoFin."<br>";
echo "Numero de platillos: ".$numPlatillos."<br>";

echo "Musica: ".$musica."<br>";
echo "Costo Musica: ".$costoMusica."<br>";
echo "Meseros: ".$meseros."<br>";
echo "Costo Meseros: ".$costoMeseros."<br>";
echo "Barra: ".$barra."<br>";
echo "Costo Barra: ".$costoBarra."<br>";
echo "Parking: ".$parking."<br>";
echo "Costo Parking: ".$costoParking."<br>";

echo "Nombre: ".$nombre."<br>";
echo "A.P: ".$apellidoP."<br>";
echo "A.M: ".$apellidoM."<br>";
echo "Telefono: ".$telefono."<br>";
echo "Correo: ".$correo."<br>";
echo "Costo Total: $".$costoTotal;*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Style.css">
    <title>D'REALS - Registro</title>
</head>
<body style = "background-color: #E3E4E5;">
    <div class="barra-superior">
        <ul>
            <li><a class="active" href="../index.html"><img alt = "HTML 5 Icon" src = "../IMG/icono.png" class = "icono"></a></li>
            <li><a href="../index.html">Inicio</a></li>
            <li class="iconoLogin"><a href=""><img class="iconoLoginImg" alt="iconoLogin" src="../IMG/login_icono.png"></a></li>
        </ul>
    </div>
    <section>
        <div style = "background-color: while;">
            <?php
            echo "<br><br><br><h3>SU EVENTO TIENE UN PRECIO DE $".$costoTotal."</h3>";
            ?>
            <h4>REALIZAR SU PAGO DE 10% PARA QUE SU FECHA SEA APARTADA O BIEN PARA LIQUIDAR SU PAGO AL SIGUIENTE NUMERO DE CUENTA</h4>
            <h5><b>Banco: </b>Banco</h5>
            <h5><b>Cuenta: </b>1234567890</h5>
            <h5><b>CLABE: </b>012345678901234567</h5>
            <h5><b>Referencia: </b>EV20240625JP01</h5><br><br><br>
            <h4>GRACIAS POR SU PREFERENCIA!!!</h4>
            <h4>Su fecha se apartara cuando haya dado el 10% del pago</h4>
            <form action = "FormatoContrato.php" method = "POST" target="_blank">
                <?php
                    $fechaActual = date("d-m-Y");
                    $nombreCompleto = $nombre." ".$apellidoP." ".$apellidoM;
                    echo <<< EOT
                        <input type = "hidden" name = "folio" value = "$idContrato">
                        <input type = "hidden" name = "fechaActual" value = "$fechaActual">
                        <input type = "hidden" name = "nombreCompleto" value = "$nombreCompleto">
                        <input type = "hidden" name = "telefono" value = "$telefono">
                        <input type = "hidden" name = "correo" value = "$correo">
                        <input type = "hidden" name = "ubicacion" value = "$salon">
                        <input type = "hidden" name = "tipoEvento" value = "$tipoEvento">
                        <input type = "hidden" name = "fechaEvento" value = "$fechaSeleccionada">
                        <input type = "hidden" name = "horaIni" value = "$horarioSeleccionadoIni">
                        <input type = "hidden" name = "horaFin" value = "$horarioSeleccionadoFin">
                        <input type = "hidden" name = "costoMenu" value = "$costo">
                        <input type = "hidden" name = "numInvitados" value = "$numPlatillos">
                        <input type = "hidden" name = "costoMusica" value = "$costoMusica">
                        <input type = "hidden" name = "costoMeseros" value = "$costoMeseros">
                        <input type = "hidden" name = "costoBarra" value = "$costoBarra">
                        <input type = "hidden" name = "costoParking" value = "$costoParking">
                        <input type = "hidden" name = "costoTotal" value = "$costoTotal">
                    EOT;
                ?>
                <button class = "btn" type = "submit" class = "boton"><span>IMPRIMIR CONTRATO</span></button>
            </form>
        </div>
    </section>
</body>
</html>