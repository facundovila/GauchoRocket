<?php

class CheckingHTMLGenerator {
    // Ingresar más datos si es necesario
    public static function generateHTML($qr, $codigoReserva, $origen, $destino, $fecha, $precio): string {
        return '
            <div style="padding: 1em" xmlns="http://www.w3.org/1999/html">
                <div style="border: 2px black solid; padding: 1em">
                    <h2 style="margin-top: 1em; margin-bottom: 2em">Datos de la reserva</h2>
                    <img src="' . $qr .'" alt="" title="Link to Google.com" style="text-align: center" />   
                    <p><b>C&oacute;digo de reserva:</b> ' .$codigoReserva. '</p> 
                    <p><b>Origen:</b> ' .$origen. '</p> 
                    <p><b>Destino:</b> ' .$destino. '</p> 
                    <p><b>Fecha:</b> ' .$fecha. '</p> 
                    <p><b>Precio:</b> $' .$precio. '</p> 
                </div>
            </div>        
        ';
    }
}