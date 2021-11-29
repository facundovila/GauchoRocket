<?php

require_once "BaseModel.php";

class VuelosModel extends BaseModel{

    public function getVuelos(){
      
        $query = 'call GR_todosLosVuelos';

        $response=$this->database->query($query);

        $data["vuelos"]=$response;
        
        return $data;
    }

    public function getVuelosDisponibles($origen, $destino, $fecha_partida, $tipo): array {
      
        $query = 'call GR_todosLosVuelosTodosLosParametros(?,?,?,?)';
        $params = array($origen, $destino, $fecha_partida, $tipo);

        $response = $this->database->executeQueryParams($params, $query);
        
        $data["vuelos"] = $response;

        return $data;
    }


    public function getdatosUsuario($id):array{

        $query= "SELECT nombre, apellido, email FROM usuario 
             WHERE id = ? ";


        $response= $this->database->executeQueryParams(array($id), $query);

        $data["datosUsuario"]=$response;

        return $data;
    }

    public function selectVuelo($codigo){
        $query ='call GR_vuelosPorId(?)';
        $params = array($codigo);

        $response = $this->database->executeQueryParams($params, $query);

        $data["vueloSeleccionado"] = $response;

        return $data;
    }

    public function getCabinasYServicios(){
        $query ='call GR_traerServiciosYCabinas()';

        $response = $this->database->query($query);

        $data["CabinasYServicios"] = $response;

        return $data;
    }

  
    public function validarNivelVueloUsuario($idUsuario,$codigo){
        $query ='call GR_compararNivelUsuarioVuelo(?,?)';
        $params = array($idUsuario, $codigo);

        $response = $this->database->executeQueryParams($params,$query)[0]["@resultado"];

        return $response == 1;
    }

    public function validarAsientosDisponiblesEnVuelo($codigo){
        $query ='call GR_verificarVueloConPasajesDisponibles(?)';
        $params = array($codigo);

        $response = $this->database->executeQueryParams($params,$query)[0]["@resultado"];


        return $response == 1;
    }

    public function ingresarEnEspera($idUsuario,$codigo){
        $query ='call GR_crearReservaUsuarioDeEspera(?,?)';
        $params = array($idUsuario,$codigo);

        return $this->database->executeQueryParams($params,$query);
    }

  
    public function getUbicaciones($vueloId) {
        $query = "call GR_listarUbicaciones(?)";
        $params = array($vueloId);

        $data["ubicaciones"] = $this->database->executeQueryParams($params, $query);
        return $data;
    }


    public function getLocacion(int $id) {
        $query = "SELECT * FROM dbgr.locacion WHERE codigo = ?";
        $params = array($id);

        return $this->database->executeQueryParams($params, $query);
    }

  
    public function getTipoDeTrayecto(int $id) {
        $query = "SELECT * FROM dbgr.tipodetrayecto WHERE codigo = ?";
        $params = array($id);

        return $this->database->executeQueryParams($params, $query);

    }


    public function getUbicacionesCabina($vueloId, $codigoCabina) {
        $query = "call GR_listarUbicacionesSegunCabina(?,?)";
        $params = array($vueloId, $codigoCabina);

        $data["ubicaciones"] = $this->database->executeQueryParams($params, $query);
        return $data;
    }


    public function asignarReserva($usuarioId,$codigoUbicacion, $codigoServicio) {
        
        $bool=5;
        $query = "call GR_ocuparPasajeYUbicacionOUT(?,?,?,?)";
        $params = array($usuarioId, $codigoUbicacion, $codigoServicio,$bool);

        $response=$this->database->executeQueryParams($params, $query);

        $data = $response;

        return $data;

    }

    public function validarReservaUnicaPorUsuarioVuelo($usuarioId,$codigoVuelo){

        $query ='call GR_validarPasajeUnicoPorUsuarioVuelo(?, ?)';
        $params = array($usuarioId,$codigoVuelo);

        $response = $this->database->executeQueryParams($params,$query)[0]["@resultado"];

       
        return $response == 1;
    }

    /* Ejemplo de utilizacion de sp con out
    public function validarNivelVueloUsuarioB($idUsuario,$codigo){
        

        $result=9;
        $query ='call GR_compararNivelUsuarioVueloAlt(?,?,?)';
        $params = array($idUsuario, $codigo,$result);

        $response = $this->database->executeQueryParams($params,$query);

        $data = $response;

        return $data;
    }
    */

   
}