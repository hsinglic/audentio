<?php
App::uses('AppModel', 'Model');

class Payment extends AppModel {

    public $useTable = 'payment';
	public $displayField = 'description';
	public $primaryKey = 'paymentid';
	
    // public $validate = array(
		// 'payment' => array(
			// 'price' => array(
				// 'rule' => array('decimal',2),
				// 'message' => 'Enter payment with 2 decimals.'
			// )
		// )
	// );
	

}
?>
