<!DOCTYPE html><!-- BD -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Style.css">
    <link rel="stylesheet" href="../CSS/StyleCalendar.css">
    <script>
            function changeMonth(offset) {
                let currentMonth = parseInt(document.getElementById('monthInput').value);
                let currentYear = parseInt(document.getElementById('yearInput').value);
                currentMonth += offset;
                if (currentMonth < 1) {
                    currentMonth = 12;
                    currentYear -= 1;
                } else if (currentMonth > 12) {
                    currentMonth = 1;
                    currentYear += 1;
                }
                document.getElementById('monthInput').value = currentMonth;
                document.getElementById('yearInput').value = currentYear;
                document.getElementById('monthForm').submit();
                }
    </script>
</head>
<body style = "background-color: #E3E4E5;">
    <div class = "ordenIconos">
        <form id="monthForm" method="get">
            <input type="hidden" id="monthInput" name="month" value="<?php echo isset($_GET['month']) ? $_GET['month'] : date('n'); ?>">
            <input type="hidden" id="yearInput" name="year" value="<?php echo isset($_GET['year']) ? $_GET['year'] : date('Y'); ?>">
        </form>
        <div class = "iconosAlineacion">
            <button class = "btn" onclick = "changeMonth(-1)">←</button>
        </div>
        <div class = "iconosAlineacion">
            <button class = "btn" onclick = "changeMonth(1)">→</button>
        </div>
    </div>
    <div class = "ordenIconos">
        <div class = "iconosAlineacion">
        <?php
            include 'Calendar.php';
            $month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
            $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

            $occupied_days = [];
            // Credenciales del servidor
            $nombreServidor = "serverdreals.database.windows.net";
            $credenciales = array(
                "Database" => "salon",
                "Uid" => "Admin_D-Reals",
                "PWD" => '$Qwerty369#'
            );

            $conexion = sqlsrv_connect($nombreServidor, $credenciales);

            if ($conexion === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            $idEvento = "SELECT TOP 1 ID_evento FROM Eventos ORDER BY ID_evento DESC";
            $stmt1  = sqlsrv_query($conexion, $idEvento);

            if ($stmt1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            $totalRegistros = 0;
            while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
                $totalRegistros = $row['ID_evento'];
            }
            $cont = 1;
            while($cont <= $totalRegistros){
                $fechaT = "SELECT fecha FROM Eventos WHERE ID_evento = '".$cont."'";
                $stmt2  = sqlsrv_query($conexion, $fechaT);

                if ($stmt2 === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                    $fecha = $row2['fecha']->format('Y-m-d');
                    array_push($occupied_days, $fecha);
                }
                $cont++;
            }
            $calendar = new Calendar($month, $year);
            echo '<h2>' . date('F', mktime(0, 0, 0, $month, 1, $year)) . ' ' . $year . '</h2>';
            echo $calendar->show($occupied_days);
            ?>
        </div>
    </div>
</body>
</html>