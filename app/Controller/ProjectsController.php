<?php

class ProjectsController extends AppController {

	public function beforeFilter() {

        parent::beforeFilter();
    }
	
	public function isAuthorized($user) {
		if($this->action === 'index') {
			return true;	
		}
	
		return parent::isAuthorized($user);
	}
	
	public function index(){
	 
	}	
	
	public function request(){
	
		
        if ($this->request->is('post')) {
			$this->request->data['Project']['usuarioid']=$this->Auth->user('usuarioid');
			// print_r($this->request->data);
			// exit;
			$this->Project->create();
            if ($this->Project->save($this->request->data)) {
                $this->Session->setFlash(__('The project has been submitted.'));
                return $this->redirect(array('action' => 'index'));
            }
			
            $this->Session->setFlash(__('The project could not be saved. Please, try again.'));
        }
	 
	}	
	
}
