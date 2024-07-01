<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    $salon = $_POST["salonSeleccionado"];
        if(strcmp($salon, "Azcapotzalco") == 0){
            echo <<< EOT
                <meta http-equiv="Refresh" content="0; url='../salonAzcapotzalco.html'" />
            EOT;
        }
        if(strcmp($salon, "Cd. Azteca") == 0){
            echo <<< EOT
                <h1>EN CONSTRUCCION</h1>
            EOT;
        }
        if(strcmp($salon, "Claveria") == 0){
            echo <<< EOT
                <meta http-equiv="Refresh" content="0; url='../salonClavería.html'" />
            EOT;
        }
        if(strcmp($salon, "El Rosario") == 0){
            echo <<< EOT
                <meta http-equiv="Refresh" content="0; url='../salonElRosario.html'" />
            EOT;
        }
        if(strcmp($salon, "La Condesa") == 0){
            echo <<< EOT
                <meta http-equiv="Refresh" content="0; url='../salonLaCondesa.html'" />
            EOT;
        }
        if(strcmp($salon, "Tacubaya") == 0){
            echo <<< EOT
                <meta http-equiv="Refresh" content="0; url='../salonTacubaya.html'" />
            EOT;
        }
        if(strcmp($salon, "NULL") == 0){
            echo <<< EOT
            <script>history.go(-1)</script>
            EOT;
        }
    ?>
</body>
</html>