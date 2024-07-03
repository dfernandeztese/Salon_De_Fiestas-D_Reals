<?php
require('fpdf185/fpdf.php');

$folio = $_POST["folio"];
$fechaActual = $_POST["fechaActual"];
$nombreCompleto = $_POST["nombreCompleto"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$ubicacion = $_POST["ubicacion"];
$tipoEvento = $_POST["tipoEvento"];
$fechaSeleccionada = $_POST["fechaEvento"];
$horarioSeleccionadoIni = $_POST["horaIni"];
$horarioSeleccionadoFin = $_POST["horaFin"];
$costoMenu = $_POST["costoMenu"];
$numInvitados = $_POST["numInvitados"];
$costoMusica = $_POST["costoMusica"];
$costoMeseros = $_POST["costoMeseros"];
$costoBarra = $_POST["costoBarra"];
$costoParking = $_POST["costoParking"];
$costoTotal = $_POST["costoTotal"];

class PDF extends FPDF
{
    protected $fechaActual;
    protected $folio;
    protected $nombreCompleto;

    function __construct($fechaActual, $folio, $nombreCompleto)
    {
        parent::__construct();
        $this->fechaActual = $fechaActual;
        $this->folio = $folio;
        $this->nombreCompleto = $nombreCompleto;
    }

    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../IMG/icono.png', 11, 12, 50); // (directorio, coor X, coor Y, Tamaño)
        // Arial bold 15
        $this->SetFont('Times', 'B', 18);
        $this->Ln(5); // Salto de línea en el PDF
        // Título
        $this->Cell(0, 15, "Salon De Eventos D'REALS", 0, 0, 'C'); // Celda (Ancho, Alto, Texto, Borde, Posicion, Alineacion)
        $this->SetFont('Times', 'B', 12);
        $this->Ln(15); // Salto de línea en el PDF
        $this->cell(0, 9, 'Fecha: ' . $this->fechaActual, 0, 0, 'R', 0);
        $this->Ln(9); // Salto de línea en el PDF
        $this->SetTextColor(255, 18, 18);
        $this->cell(0, 9, 'Folio: ' . $this->folio, 0, 0, 'L', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(265);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(95, 5, "________________________________________________________", 0, 0, 'C', true);
        $this->Cell(95, 5, "________________________________________________________", 0, 0, 'C');
        $this->Ln(5);
        $this->Cell(95, 5, "Gerente", 0, 0, 'C', true);
        $this->Cell(95, 5, $this->nombreCompleto, 0, 0, 'C');
        $this->Ln(5);
        $this->Cell(95, 5, "Firma De La Empresa", 0, 0, 'C', true);
        $this->Cell(95, 5, "Firma Del Cliente", 0, 0, 'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF($fechaActual, $folio, $nombreCompleto);
$pdf->AliasNbPages();
$pdf->AddPage();
// Datos del cliente
$pdf->Ln(8);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 9, "DATOS DEL CLIENTE", 1, 0, 'C', true);
$pdf->Ln(9);

$pdf->SetFont('Arial', 'B', 10);
// Nombre
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Nombre", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $nombreCompleto, 1, 0, 'C');
$pdf->Ln(9);

// Telefono
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Telefono", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $telefono, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Correo electronico
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Correo electronico", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $correo, 1, 0, 'C'); // Celda vacia
$pdf->Ln(0);

// Datos del evento
$pdf->Ln(8);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 9, "DATOS DEL EVENTO", 1, 0, 'C', true);
$pdf->Ln(9);

$pdf->SetFont('Arial', 'B', 10);
// Salon
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Ubicacion", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $ubicacion, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Tipo de evento
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Tipo de Evento", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $tipoEvento, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Fecha
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Fecha", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $fechaSeleccionada, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Inicio
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Hora Inicio", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $horarioSeleccionadoIni, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Fin
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Hora Fin", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $horarioSeleccionadoFin, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Servicios
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 9, "SERVICIOS", 1, 0, 'C', true);
$pdf->Ln(9);

$pdf->SetFont('Arial', 'B', 10);
// Menu
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Costo Menu", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, "$".$costoMenu, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// No. Invitados
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Numero de Invitados", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, $numInvitados, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Musica
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Costo Musica", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, "$".$costoMusica, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Meseros
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Costo Meseros", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, "$".$costoMeseros, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Barra
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Costo Barra", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, "$".$costoBarra, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Parking
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Costo Parking", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, "$".$costoParking, 1, 0, 'C'); // Celda vacia
$pdf->Ln(9);

// Total
/*$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 9, "COSTO TOTAL", 1, 0, 'C', true);
$pdf->Ln(9);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Costo Total", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 9, "$".$costoTotal, 1, 0, 'C'); // Celda vacia
*/

// Costo total
$pdf->SetFillColor(255, 255, 255); // Relleno
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->Cell(45, 9, "Costo Total", 1, 0, 'C', true);
$pdf->SetTextColor(0, 0, 0); 
$pdf->Cell(0, 9, "$".$costoTotal, 1, 0, 'R'); // Celda vacia
$pdf->Ln(9);

// Clausula
$pdf->SetTextColor(255, 255, 255); 
$pdf->SetFillColor(0, 0, 0); 
$pdf->SetFont('Arial','B',11); 
$pdf->Cell(0, 9, "CLAUSULAS", 1, 0, 'C', true);
$pdf->Ln(9);

$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0, 0, 0); 
$pdf->Cell(0, 6, "1. Cada contrato requiere un anticipo.", 0, 0, 'L');
$pdf->Ln(6);
$pdf->Cell(0, 6, "2. En caso de posponer el evento, el cliente podra elegir otra fecha siempre y cuando el dia se encuentre disponible y con 15 dias de anticipacion.", 0, 0, 'L');
$pdf->Ln(6);
$pdf->Cell(0, 6, "3. Si el cliente suspende el evento, no hay devolucion del anticipo.", 0, 0, 'L');
$pdf->Ln(6);
$pdf->Cell(0, 6, "4. El cliente debera liquidar el total del evento un dia antes del evento.", 0, 0, 'L');
$pdf->Ln(6);
$pdf->Cell(0, 6, "5. No nos hacemos responsables por danios causados en eventos al aire libre o por motivos climatologicos.", 0, 0, 'L'); 
$pdf->Ln(6);
$pdf->Cell(0, 6, "6. Todas las bases, cortinas, decoraciones, etc. Son rentadas y se recogeran a la hora establecida para la terminacion del evento.", 0, 0, 'L'); 
$pdf->Ln(6);
$pdf->SetTextColor(255, 18, 18); 
$pdf->Cell(0, 6, "EN CASO DE DANIOS O EXTRAVIOS, EL CLIENTE SE HARA RESPONSABLE Y DEBERA CUBRIR EL COSTO TOTAL DEL DANIO.", 0, 0, 'C'); 
$pdf->Ln(6);


$pdf->Output();
?>
