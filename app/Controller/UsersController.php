<?php

class UsersController extends AppController {
	 public $uses = array('Role', 'User');
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }
		
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
	 public function add() {
		$roles = $this->Role->find('list');
		$this->set(compact('roles'));
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        }
    }
}
