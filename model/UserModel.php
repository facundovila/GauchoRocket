<?php
require_once "BaseModel.php";
class UserModel extends BaseModel{

    public function getDatosUserById($id):array{

         $query= "SELECT U.id, U.usuario, U.email, U.nombre, U.apellido, U.dni, U.telefono , NV.descripcion FROM usuario as U"
               ." join nivelVueloUsuario as NVU on U.id=NVU.fkIdUsuario"
               ." join nivelVuelo as NV on NVU.fkNivelVuelo=NV.nivel"
               ." WHERE U.id = ? ";



        $response = $this->database->executeQueryParams(array($id),$query);
        $data["datosUsuario"]=$response;

        return $data;



    }

}