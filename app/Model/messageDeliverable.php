<?php
App::uses('AppModel', 'Model');


class MessageDeliverable extends AppModel {
    public $useTable = 'messagesDeliverable';
	public $displayField = 'message';
	public $primaryKey = 'messageid';
	
}
?>
