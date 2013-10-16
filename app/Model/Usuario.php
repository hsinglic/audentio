<?php
App::uses('AppModel', 'Model');

class Usuario extends AppModel {
    
	public function guardarUsuario($datos){
		// guarda los datos de usuario nuevo en la base de datos
		return 0;
	}
	
	public function existeUsuario($email){
		// boolean si ya existe un usuario cin ese email
		return false;
	}
	
	public function obtenerUsuario($nombre, $contrasena){
		// devuelve la informacion de un usuario si el nombre y contasena son validos
		if ($nombre == "prueba" && $contrasena == "1234"){
			return new Usuario();
		}
		else
			return false;
	}
}
?>
