<?php

class CheckingHTMLGenerator {
    // Ingresar más datos si es necesario
    public static function generateHTML($qr): string {
        return '
            <div style="padding: 1em">
                <div style="border: 2px black solid; padding: 1em">
                    <h2 style="margin-top: 1em; margin-bottom: 2em">Datos de la reserva</h2>
                    <img src="'. $qr .'" alt="" title="Link to Google.com" style="text-align: center" />    
                </div>
            </div>        
        ';
    }
}