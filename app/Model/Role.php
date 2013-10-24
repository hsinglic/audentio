<?php
App::uses('AppModel', 'Model');

/*
Roles
1->Admin
2->Miembro del equipo
3->Cliente
*/
class Role extends AppModel {
    public $useTable = 'roles';
	public $displayField = 'nombre';
	public $primaryKey = 'rolid';
	
	
}
?>
