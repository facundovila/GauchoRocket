<?php

class TurnHTMLGenerator {
    
    public static function generateHTML($fechaTurno, $locacion, $descripcion, $nivel, $nombre, $apellido): string {
        return '
            <div style="padding: 1em" xmlns="http://www.w3.org/1999/html">
                <div style="border: 2px black solid; padding: 1em">
                    <h2 style="margin-top: 1em; margin-bottom: 2em">Datos de su Turno Medico</h2>
                    <h3>' .$nombre. ' ' .$apellido. '</h3> 
                    <p><b>Lugar del Turno:</b> ' .$locacion. '</p> 
                    <p><b>Nivel Obtenido:</b> ' .$descripcion. '-' .$nivel. '</p> 
                    <p><b>Fecha:</b> ' .$fechaTurno. '</p> 
                </div>
            </div>        
        ';
    }
}