<?php
App::uses('AppModel', 'Model');


class MessageProject extends AppModel {
    public $useTable = 'messagesProject';
	public $displayField = 'message';
	public $primaryKey = 'messageid';
	
}
?>
