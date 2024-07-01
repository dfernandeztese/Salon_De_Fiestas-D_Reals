<!--<!DOCTYPE html>
// ME SIRVIO EL CÓDIGO, CONSERVAR POR AHORA
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Junio 2024</title>
    <link rel="stylesheet" href="tmp.css">
</head>
<body>
    <h1>Calendario de Junio 2024</h1>
    <?php
    /*include 'tmp.php';

    $occupied_days = ['2024-06-10', '2024-06-15', '2024-06-20']; // Días ocupados estáticos

    $calendar = new Calendar(1, 2024);
    echo $calendar->show($occupied_days);*/
    ?>
</body>
</html>-->


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario con PHP Calendar Class</title>
    <link rel="stylesheet" href="tmp.css">
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
<body>
    <form id="monthForm" method="get">
        <input type="hidden" id="monthInput" name="month" value="<?php echo isset($_GET['month']) ? $_GET['month'] : date('n'); ?>">
        <input type="hidden" id="yearInput" name="year" value="<?php echo isset($_GET['year']) ? $_GET['year'] : date('Y'); ?>">
    </form>
    <button onclick = "changeMonth(-1)">←</button>
    <button onclick = "changeMonth(1)">→</button>
    <?php
    include 'tmp.php';

    $month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
    $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

    $occupied_days = [
        '2024-01-10', '2024-02-15', '2024-03-20', '2024-04-25', 
        '2024-05-05', '2024-06-10', '2024-07-15', '2024-08-20', 
        '2024-09-25', '2024-10-30', '2024-11-10', '2024-12-15', '2024-01-01'
    ];

    $calendar = new Calendar($month, $year);
    echo '<h2>' . date('F', mktime(0, 0, 0, $month, 1, $year)) . ' ' . $year . '</h2>';
    echo $calendar->show($occupied_days);
    ?>
</body>
</html>
