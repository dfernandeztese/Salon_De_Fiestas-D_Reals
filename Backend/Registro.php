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

$tipoEvento = $_POST["tipoEvento"];
$colAdorno = $_POST["colAdorno"];
$costo = $_POST["costo"];

$numAdultos = $_POST["adultos"];
$numNinos = $_POST["ninos"];
$fechaSeleccionada = $_POST["fechaSeleccionada"];
$horarioSeleccionado = $_POST["horarioSeleccionado"];
$numPlatillos = $_POST["numPlatillos"];

$musica = "";
$costoMusica = 0;

$meseros = "";
$costoMeseros = 0;

$barra = "";
$costoBarra = 0;

$parking = "";
$costoParking = 0;


$nombre = $_POST["nombre"];
$apellidoP = $_POST["aPaterno"];
$apellidoM = $_POST["aMaterno"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];

$verificarExistencia = array("musica", "meseros", "barra", "parking");

//echo "Tamaño de arreglo: ".count($verificarExistencia);

for($a = 0; $a < count($verificarExistencia); $a++){
    if(isset($_POST[$verificarExistencia[$a]]) == true){
        if(strcmp($verificarExistencia[$a],"musica") == 0){
            $musica = $_POST[$verificarExistencia[$a]];

            $costoTmp = "SELECT costo FROM Servicios WHERE tipo_servicio = '".$musica."'";
            $stmt1  = sqlsrv_query($conexion, $costoTmp);

            if ($stmt1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
                $costoMusica = $row['costo'];
            }
        }

        if(strcmp($verificarExistencia[$a],"meseros") == 0){
            $meseros = $_POST[$verificarExistencia[$a]];

            $costoTmp = "SELECT costo FROM Servicios WHERE tipo_servicio = '".$meseros."'";
            $stmt1  = sqlsrv_query($conexion, $costoTmp);

            if ($stmt1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
                $costoMeseros = $row['costo'];
            }
        }

        if(strcmp($verificarExistencia[$a],"barra") == 0){
            $barra = $_POST[$verificarExistencia[$a]];

            $costoTmp = "SELECT costo FROM Servicios WHERE tipo_servicio = '".$barra."'";
            $stmt1  = sqlsrv_query($conexion, $costoTmp);

            if ($stmt1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
                $costoBarra = $row['costo'];
            }
        }

        if(strcmp($verificarExistencia[$a],"parking") == 0){
            $parking = $_POST[$verificarExistencia[$a]];

            $costoTmp = "SELECT costo FROM Servicios WHERE tipo_servicio = '".$parking."'";
            $stmt1  = sqlsrv_query($conexion, $costoTmp);

            if ($stmt1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
                $costoParking = $row['costo'];
            }
        }
    }
}

$costoTotal = ($costo*$numPlatillos) + $costoMusica + $costoMeseros + $costoBarra + $costoParking;

/*echo "Tipo de evento: ".$tipoEvento."<br>";
echo "Color de adorno: ".$colAdorno."<br>";
echo "Costo: ".$costo."<br>";

echo "N° Adultos: ".$numAdultos."<br>";
echo "N° Niños: ".$numNinos."<br>";
echo "Fecha Seleccionado: ".$fechaSeleccionada."<br>";
echo "Horario Seleccionado: ".$horarioSeleccionado."<br>";
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
echo "Costo Total: ".$costoTotal;*/

?>