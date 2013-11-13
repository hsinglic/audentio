<?php
App::uses('AppModel', 'Model');


class MessageProject extends AppModel {
    public $useTable = 'messagesProject';
	public $displayField = 'message';
	public $primaryKey = 'messageid';
	
	public $validate = array(
		'message' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Message must not be empty.'
			)
		)
	);
}
?>
