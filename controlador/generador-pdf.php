<?php

require 'vendor/autoload.php';

use Dompdf\Dompdf;

class ControlarPDF
{
    public function generarPDF()
    
    { $pdf =new Imagen();

    $imagenes = $pdf->ObtenerImagenes();

    ob_start();

    include 'index.php';

    $html = ob_get_clean();

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    $dompdf->stream("calendario.pdf");
    }
}
?>