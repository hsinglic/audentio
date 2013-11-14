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
	


	
	
}
?>
