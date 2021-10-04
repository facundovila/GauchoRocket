<?php

class Usuario{

    private $usuario;
    private $clave;
    private $email;
	private $rol;


    function __construct($usuario,$clave,$email){
    $this->clave=$clave;
    $this->usuario=$usuario;
    $this->email=$email;
	$this->rol="cliente";
    }

    /*	
	function registrar($usuario,$clave,$email){
		$usuarioNuevo = new Usuario($usuario,$clave,$email);
		return $usuarioNuevo;
		
	} */






}