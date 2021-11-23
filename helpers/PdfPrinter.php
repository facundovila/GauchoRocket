<?php

require_once 'third-party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class PdfPrinter {
    private Dompdf $dompdf;

    public function __construct() {
        $this->setup();
    }

    private function setup() {
        $this->dompdf = new Dompdf();
        $this->dompdf->getOptions()->setIsRemoteEnabled(true);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape');
    }

    function printPdf($html) {
        $this->dompdf->loadHtml($html);

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF to Browser
        $this->dompdf->stream();

    }
}