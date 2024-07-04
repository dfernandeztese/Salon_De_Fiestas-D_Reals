<?php // BD
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

$salon = $_POST["salonSeleccionado"];
$costoMenu = 0;
$fechaRango = date("Y-m-d");

$consultaMin = "SELECT capacidad_min FROM salones WHERE ubicacion = '".$salon."'";
$stmt1  = sqlsrv_query($conexion, $consultaMin);

if ($stmt1 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$minimoP = 0;
while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
    $minimoP = $row['capacidad_min'];
}

$consultaMax = "SELECT capacidad_max FROM salones WHERE ubicacion = '".$salon."'";
$stmt2 = sqlsrv_query($conexion, $consultaMax);

if ($stmt2 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$maximoP = 0;
while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
    $maximoP = $row['capacidad_max'];
}

sqlsrv_free_stmt($stmt1);
sqlsrv_free_stmt($stmt2);


if(strcmp($salon, "Azcapotzalco") == 0){
    $costoMenu = 220;
}

if(strcmp($salon, "Cd. Azteca") == 0){
    $costoMenu = 310;
}
if(strcmp($salon, "Claveria") == 0){
    $costoMenu = 280;
}

if(strcmp($salon, "La Condesa") == 0){
    $costoMenu = 340;
}

if(strcmp($salon, "Tacubaya") == 0){
    $costoMenu = 420;
}

$occupied_days = [];

$idEvento = "SELECT TOP 1 ID_evento FROM Eventos ORDER BY ID_evento DESC";
$stmt3  = sqlsrv_query($conexion, $idEvento);

if ($stmt3 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$totalRegistros = 0;
while ($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $totalRegistros = $row['ID_evento'];
}
$cont = 1;
while($cont <= $totalRegistros){
    $fechaT = "SELECT fecha FROM Eventos WHERE ID_evento = '".$cont."'";
    $stmt4  = sqlsrv_query($conexion, $fechaT);

    if ($stmt4 === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row2 = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)) {
        $fecha = $row2['fecha']->format('Y-m-d');
        array_push($occupied_days, $fecha);
    }
    $cont++;
}
sqlsrv_close($conexion);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport">
        <title>D'REALS - Solicitud</title>
        <link rel="stylesheet" href="../CSS/Style.css">
    </head>
    <body style = "background-color: #E3E4E5;">
    <div class="barra-superior">
        <ul>
            <li><a class="active" href="../index.html"><img alt = "HTML 5 Icon" src = "../IMG/icono.png" class = "icono"></a></li>
            <li><a href="../index.html">Inicio</a></li>
        </ul>
    </div>
    <div><br><br><h1><b>A CONTINUACIÓN EMPERARÁS A CREAR TU EVENTO</b></h1></div>
    <div>
        <fieldset>
            <form action = "Registro.php" method = "POST">
                <?php
                echo <<< EOT
                <input type="hidden" name="salon" value="$salon"> 
                EOT;
                ?>
                <label><b>1. QUE TIPO DE EVENTO ES</b></label><br> <!-- 1 -->
                <!--<input type="text" name="tipoEvento"><br><br>-->
                <select class = "btn" name = "tipoEvento">
                        <option value = "1"><b>XV años</b></option>
                        <option value = "2"><b>Boda</b></option>
                        <option value = "3"><b>Graduación</b></option>
                        <option value = "4"><b>Primera Comunión</b></option>
                        <option value = "5"><b>Bautizo</b></option>
                </select><br><br>
                <label><b>2. QUÉ COLORES QUIERE PARA ADORNAR EL SALÓN?</b></label><br> <!-- 2 -->
                <input class = "btn" type="text" name="colAdorno" required><br><br>
                <label><b>3. ELIJA SU MENU PARA SU EVENTO:</b></label><br><br> <!-- 3 -->
                <label><b>NUESTRO MENÚ</b></label><br>
                    <label><b>CREMA:</b></label><br>
                    <label>CREMA DE ELOTE</label><br>
                    <label><b>PASTA:</b></label><br>
                    <label>SPAGHETTI POBLANO</label><br>
                    <label><b>PLATO FUERTE:</b></label><br>
                    <label>LOMO DE CERDO EN HIERBAS FINAS</label><br><br>
                    <?php
                    echo <<< EOT
                    <input type = "hidden" name = "entradas" value = "crema elote">
                    <input type = "hidden" name = "medios" value = "spaguetti poblano">
                    <input type = "hidden" name = "fuertes" value = "lomo de cerdo en hierbas finas">
                    <input type="hidden" name="costo" value="$costoMenu"> 
                    EOT;
                    ?>
                    
                <label><b>Ingrese el número de Invitados</b></label><br>
                <div class = "ordenIconos">
                    <div class = "iconosAlineacion">
                        <label><b>Adultos</b></label><br>
                        <?php
                            echo <<< EOT
                            <input class = "btn" type="number" id="" name="adultos" size = "1" min = "$minimoP" max = "$maximoP" required>
                            EOT;
                        ?>
                    </div>
                    <div class = "iconosAlineacion">
                        <label><b>Niños</b></label><br>
                        <?php
                            echo <<< EOT
                            <input class = "btn" type="number" id="" name="ninos" size = "1" min = 0 max = "$maximoP" required>
                            EOT;
                        ?>
                    </div>
                </div><br>
                <div class = "ordenIconos">
                    <div class = "iconosAlineacion">
                    <label><b>Seleccione la fecha de su evento</b></label><br>
                    <?php
                    echo <<< EOT
                        <input class = "btn" type = "date" id="fecha" name = "fechaSeleccionada" min = "$fechaRango" max = "2024-12-31" required><br><br>
                    EOT;
                    ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', (event) => {
                            const fechasBloqueadas = <?php echo json_encode($occupied_days); ?>;
                            const inputFecha = document.getElementById('fecha');
                            
                            inputFecha.addEventListener('input', (e) => {
                                if (fechasBloqueadas.includes(e.target.value)) {
                                    e.target.value = '';
                                    alert('Lo Sentimos, la fecha seleccionada se encuentra ocupado.');
                                }
                            });
                        });
                    </script>
                    <label><b>Seleccione el horario de su evento</b></label><br>
                    <label><b>Inicio</b></label><br>
                    <select class = "btn" name = "horarioSeleccionadoIni">
                        <option value = "07:00"><b>07:00 A.M</b></option>
                        <option value = "08:00"><b>08:00 A.M</b></option>
                        <option value = "09:00"><b>09:00 A.M</b></option>
                        <option value = "10:00"><b>10:00 A.M</b></option>
                        <option value = "11:00"><b>11:00 A.M</b></option>
                        <option value = "12:00"><b>12:00 P.M</b></option>
                        <option value = "13:00"><b>01:00 P.M</b></option>
                        <option value = "14:00"><b>02:00 P.M</b></option>
                        <option value = "15:00"><b>03:00 P.M</b></option>
                        <option value = "16:00"><b>04:00 P.M</b></option>
                        <option value = "17:00"><b>05:00 P.M</b></option>
                        <option value = "18:00"><b>06:00 P.M</b></option>
                        <option value = "19:00"><b>07:00 P.M</b></option>
                        <option value = "20:00"><b>08:00 P.M</b></option>
                        <option value = "21:00"><b>09:00 P.M</b></option>
                        <option value = "22:00"><b>10:00 P.M</b></option>
                        <option value = "23:00"><b>11:00 P.M</b></option>
                    </select><br><br>
                    <!---->
                    <label><b>Termino</b></label><br>
                    <select class = "btn" name = "horarioSeleccionadoFin">
                        <option value = "07:00"><b>07:00 A.M</b></option>
                        <option value = "08:00"><b>08:00 A.M</b></option>
                        <option value = "09:00"><b>09:00 A.M</b></option>
                        <option value = "10:00"><b>10:00 A.M</b></option>
                        <option value = "11:00"><b>11:00 A.M</b></option>
                        <option value = "12:00"><b>12:00 P.M</b></option>
                        <option value = "13:00"><b>01:00 P.M</b></option>
                        <option value = "14:00"><b>02:00 P.M</b></option>
                        <option value = "15:00"><b>03:00 P.M</b></option>
                        <option value = "16:00"><b>04:00 P.M</b></option>
                        <option value = "17:00"><b>05:00 P.M</b></option>
                        <option value = "18:00"><b>06:00 P.M</b></option>
                        <option value = "19:00"><b>07:00 P.M</b></option>
                        <option value = "20:00"><b>08:00 P.M</b></option>
                        <option value = "21:00"><b>09:00 P.M</b></option>
                        <option value = "22:00"><b>10:00 P.M</b></option>
                        <option value = "23:00"><b>11:00 P.M</b></option>
                    </select><br><br>
                    </div>
                    <div class = "iconosAlineacion">
                        <iframe class = "ventanaOculta"  src = "Calendario.php" title="Disponibilidad"></iframe>
                    </div>
                </div>
                <br>
                
                <label><b>Indique el número de plantilla que desea comprar</b></label><br>
                <?php
                    echo <<< EOT
                        <input class = "btn" type = "number" name = "numPlatillos" min = "$minimoP" max = "$maximoP" required><br><br>
                    EOT;
                ?>
                <label><b>Servicio que desea incluir:</b></label><br>
                <input class = "btn" type="checkbox" name="musica" value="musica">
                <label for="musica">Música</label><br>
                <input class = "btn" type="checkbox" name="meseros" value="meseros">
                <label for="meseros">Meseros</label><br>
                <input class = "btn" type="checkbox" name="barra" value="barra">
                <label for="barra">Barra</label><br>
                <input class = "btn" type="checkbox" name="parking" value="parking">
                <label for="parking">Parking</label><br><br>

                <div>
                    <fieldset>
                        <legend><b>Información de cliente</b></legend>
                        <label>NOMBRE</label><br>
                        <input class = "btn" type="text" name="nombre" size = "101" required><br><br>

                        <label>APELLIDO PATERNO</label><br>
                        <input class = "btn" type="text" name="aPaterno" size = "101" required><br><br>

                        <label>APELLIDO MATERNO</label><br>
                        <input class = "btn" type="text" name="aMaterno" size = "101" required><br><br>

                        <label>TELEFONO</label><br>
                        <input class = "btn" type="text" name="telefono" size = "101" required><br><br>

                        <label>CORREO</label><br>
                        <input class = "btn" type="text" name="correo" size = "101" required><br><br>
                    </fieldset><br><br>
                    <button class = "btn" type = "submit" class = "boton"><span>GUARDAR Y GENERAR CONTRATO</span></button>
                </div><br>
            </form>
        </fieldset>
    </div>
    </body>
</html>