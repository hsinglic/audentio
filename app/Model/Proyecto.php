<?php
App::uses('AppModel', 'Model');

class Proyecto extends AppModel {
    
	public function guardarProyecto($cliente, $datos, $presupuesto){
		// guarda un proyecto nuevo en la base de datos
		return 0;
	}
	
	public function obtenerListaPendientes(){
		// devuelve lista de proyectos que no han sido ni aceptados ni rechazados
		return array(new Proyecto(), new Proyecto());
	}
	
	public function obtenerProyecto($projectid){
		// devuelve un proyecto a partir de su id
		return new Proyecto();
		
	public function obtenerListaProyectos($usuario){
		// devuelve lista de proyectos asociados al usuario
		return array(new Proyecto(), new Proyecto());
	}
}
?>
