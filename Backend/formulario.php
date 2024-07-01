<?php
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

//$salon = $_POST["salonSeleccionado"];

$salon = "Azcapotzalco";
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
sqlsrv_close($conexion);

/*if ($maximoP === false) {
    die(print_r(sqlsrv_errors(), true));
}*/

if(strcmp($salon, "Azcapotzalco") == 0){
    $costoMenu = 220;
}
if(strcmp($salon, "Cd. Azteca") == 0){
    $costoMenu = 310;
}
if(strcmp($salon, "Claveria") == 0){
    $costoMenu = 280;
}
if(strcmp($salon, "El Rosario") == 0){
    $costoMenu = 0;
}
if(strcmp($salon, "La Condesa") == 0){
    $costoMenu = 340;

}
if(strcmp($salon, "Tacubaya") == 0){
    $costoMenu = 420;
}
if(strcmp($salon, "NULL") == 0){
    echo <<< EOT
    <script>history.go(-1)</script>
    EOT;
}
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport">
        <title>D'REALS - Solicitud</title>
        <link rel="stylesheet" href="../CSS/Style.css">
        <!--<link rel="stylesheet" href="../CSS/StyleCalendar.css">-->
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
                <label><b>1. QUE TIPO DE EVENTO ES</b></label><br> <!-- 1 -->
                <input type="text" name="tipoEvento"><br><br>
                <label><b>2. QUÉ COLORES QUIERE PARA ADORNAR EL SALÓN?</b></label><br> <!-- 2 -->
                <input type="text" name="colAdorno"><br><br>
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
                    <input type="hidden" name="costo" value="$costoMenu"> 
                    EOT;
                    ?>
                    
                <label><b>Ingrese el número de Invitados</b></label><br>
                <div class = "ordenIconos">
                    <div class = "iconosAlineacion">
                        <label><b>Adultos</b></label><br>
                        <?php
                            echo <<< EOT
                            <input type="number" id="" name="adultos" size = "1" min = "$minimoP" max = "$maximoP">
                            EOT;
                        ?>
                    </div>
                    <div class = "iconosAlineacion">
                        <label><b>Niños</b></label><br>
                        <?php
                            echo <<< EOT
                            <input type="number" id="" name="ninos" size = "1" min = "$minimoP" max = "$maximoP">
                            EOT;
                        ?>
                    </div>
                </div><br>
                <div class = "ordenIconos">
                    <div class = "iconosAlineacion">
                    <label><b>Seleccione la fecha de su evento</b></label><br>
                    <?php
                    echo <<< EOT
                        <input type = "date" name = "fechaSeleccionada" min = "$fechaRango" max = "2024-12-31"><br><br>
                    EOT;
                    ?>
                    <label><b>Seleccione el horario de su evento</b></label><br>
                    <select name = "horarioSeleccionado">
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
                        <iframe class = "ventanaOculta" src = "calendario.php" title="Disponibilidad"></iframe>
                    </div>
                </div>
                <br>
                
                <label><b>Indique el número de plantilla que desea comprar</b></label><br>
                <?php
                    echo <<< EOT
                        <input type = "number" name = "numPlatillos" min = "$minimoP" max = "$maximoP"><br><br>
                    EOT;
                ?>
                <label><b>Servicio que desea incluir:</b></label><br>
                <input type="checkbox" name="musica" value="musica">
                <label for="musica">Música</label><br>
                <input type="checkbox" name="meseros" value="meseros">
                <label for="meseros">Meseros</label><br>
                <input type="checkbox" name="barra" value="barra">
                <label for="barra">Barra</label><br>
                <input type="checkbox" name="parking" value="parking">
                <label for="parking">Parking</label><br><br>

                <div>
                    <fieldset>
                        <legend><b>Información de cliente</b></legend>
                        <label>NOMBRE</label><br>
                        <input type="text" name="nombre"><br><br>

                        <label>APELLIDO PATERNO</label><br>
                        <input type="text" name="aPaterno"><br><br>

                        <label>APELLIDO MATERNO</label><br>
                        <input type="text" name="aMaterno"><br><br>

                        <label>TELEFONO</label><br>
                        <input type="text" name="telefono"><br><br>

                        <label>CORREO</label><br>
                        <input type="text" name="correo"><br><br>

                        <button type = "submit" class = "boton"><span>GUARDAR Y GENERAR CONTRATO</span></button>

                    </fieldset>
                </div><br>
            </form>
        </fieldset>
    </div>
    </body>