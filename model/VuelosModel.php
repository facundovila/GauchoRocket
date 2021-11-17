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

        $response = $this->database->executeQueryParams($params,$query);
        
        $data["vuelos"] = $response;

        return $data;
    }


    public function getdatosUsuario($id):array{

        $query= "SELECT nombre, apellido, email FROM usuario 
             WHERE id = ? ";


        $response= $this->database->executeQueryParams(array($id),$query);

        $data["datosUsuario"]=$response;

        return $data;
    }

    public function selectVuelo($codigo){
        $query ='call GR_vuelosPorId(?)';
        $params = array($codigo);

        $response = $this->database->executeQueryParams($params,$query);

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

        $response = $this->database->executeQueryParams($params,$query);

        $data = $response;

        return $data;
    }

    public function getUbicaciones($vueloId) {
        $query = "call GR_listarUbicaciones(?)";
        $params = array($vueloId);

        $data["ubicaciones"] = $this->database->executeQueryParams($params, $query);
        return $data;
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
    /*


    /*
    public function getReserva($codigo):array{

        $query= "SELECT codigo,origen,destino,t1.Nombre as nombre,fecha,precio from
        (select distinct v.descripcion as Nombre,l.nombre as Origen,fecha, v.precio as precio
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionOrigen=l.codigo) as t1
        inner join
        (select distinct t.codigo,v.descripcion as nombre,l.nombre as Destino
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
        on t1.nombre=t2.nombre where codigo = ?";


        $response= $this->database->executeQueryParams(array($codigo),$query);

        $data["reserva"]=$response;

        return $data; 







    } */
    public function asignarReserva(string $usuarioId, string $codigoVuelo, string $codigoUbicacion) {
        $query = "call GR_ocuparPasajeYUbicacion(?, ?, ?)";
        $params = array($usuarioId, $codigoUbicacion, $codigoVuelo);

        $this->database->executeQueryParams($params, $query);
    }
}