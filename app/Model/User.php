<?php
App::uses('AppModel', 'Model');
/*
usuarioid
username
password
email
role
*/
class User extends AppModel {
    public $useTable = 'usuarios';
	    public $belongsTo = array(
        'Rol' => array(
            'className' => 'Role',
            'foreignKey' => 'role'
        )
    );

	public $primaryKey = 'usuarioid'; 
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			),
			'The username has already been taken'=>array(
				'rule'=>'isUnique',
				'message'=>'That username has already been taken.'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'email' => array(
			'required' => array(
				'rule' => array('notEmpty','isUnique'),
				'message' => 'An email is required',
			),
			'valid email' => array(
				'rule' => array('email',true),
				'message' => 'Enter a valid email',
			),
			'That email is already registered.'=>array(
				'rule'=>'isUnique',
				'message'=>'That email is already registered.'
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
