<?php
App::uses('AppModel', 'Model');

class Role extends AppModel {
    public $useTable = 'roles';
	public $displayField = 'nombre';
	public $primaryKey = 'rolid';
	// public $hasMany = array('User')
	
	
}
?>
