<?php

class PDF_ReservaGenerator {
    
    public static function generatePDF($codigoReserva, $origen, $destino, $fecha, $cabina, $servicio, $descripcion, $asiento, $pago){
        return '
            <div style="padding: 1em" xmlns="http://www.w3.org/1999/html">
                <div style="border: 2px black solid; padding: 1em">
                    <h2 style="margin-top: 1em; margin-bottom: 2em">Datos de su Reserva</h2> 
                    <p><b>C&oacute;digo de reserva:</b> ' .$codigoReserva. '</p> 
                    <p><b>Tipo de Servicio:</b> ' .$servicio. '</p> 
                    <p><b>Tipo de Cabina:</b> ' .$cabina. '</p> 
                    <p><b>Trayecto:</b> ' .$descripcion. '</p> 
                    <p><b>Nro de Asiento:</b> ' .$asiento. '</p> 
                    <p><b>Origen:</b> ' .$origen. '</p> 
                    <p><b>Destino:</b> ' .$destino. '</p> 
                    <p><b>Fecha:</b> ' .$fecha. '</p>
                    <p><b>Estado del pago de la Reserva:</b> ' .$pago. '</p>  
                </div>
            </div>        
        ';
    }
}

?>