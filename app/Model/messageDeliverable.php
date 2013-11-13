<?php
App::uses('AppModel', 'Model');


class MessageDeliverable extends AppModel {
    public $useTable = 'messagesDeliverable';
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
