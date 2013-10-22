<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
    public $useTable = 'usuarios';
	    public $belongsTo = array(
        'Rol' => array(
            'className' => 'Role',
            'foreignKey' => 'rolid'
        )
    );
	public $primaryKey = 'usuarioid';
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'rolid' => array(
			'valid' => array(
				'rule' => array('inList', array(1, 2,3)),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		)
	);	
	// public function save($datos){
		// // guarda los datos de usuario nuevo en la base de datos
		// return 0;
	// }
	
	public function exist($email){
		// boolean si ya existe un usuario cin ese email
		return false;
	}
	
	public function getUser($nombre, $contrasena){
		// devuelve la informacion de un usuario si el nombre y contasena son validos
		if ($nombre == "prueba" && $contrasena == "1234"){
			return new User();
		}
		else
			return false;
	}
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

	
	
}
?>
