<?php

class Usuario{
    private string $usuario;
    private string $email;
    private string $clave;
	private string $rol;

    function __construct($usuario,$clave,$email){
        $this->usuario=$usuario;
        $this->email=$email;
        $this->clave=$clave;
        $this->rol="cliente";
    }

    /*function registrar($usuario,$clave,$email){
		$usuarioNuevo = new Usuario($usuario,$clave,$email);
		return $usuarioNuevo;
		
	} */
}