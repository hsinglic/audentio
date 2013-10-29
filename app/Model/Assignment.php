<?php
App::uses('AppModel', 'Model');

/*
Roles
1->Admin
2->Miembro del equipo
3->Cliente
*/
class Assignment extends AppModel {
    public $useTable = 'asignacionProyecto';
	public $primaryKey = 'asignacionid';
    public $belongsTo = array(
        // 'User' => array(
            // 'className' => 'User',
            // 'foreignKey' => 'usuarioid'
        // ),
       'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'proyectoid'
        )
    );
	
	
}
?>
