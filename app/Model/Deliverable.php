<?php
App::uses('AppModel', 'Model');


class Deliverable extends AppModel {
    public $useTable = 'deliverables';
	public $displayField = 'title';
	public $primaryKey = 'deliverableid';
	
}
?>
