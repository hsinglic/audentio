<?php

class UsersController extends AppController {
	 public $uses = array('Role', 'User');
	
	public function beforeFilter() {
        
		
		// $this->Auth->allow('add');
        parent::beforeFilter();
    }
		
	public function isAuthorized($user) {
	
		if ($this->action == 'add' && $user['role'] == 1) {
			return true;
		}
		$this->Session->setFlash(__('Service unavailable for your user.'));
		return parent::isAuthorized($user);
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
	

	public function register() {
		if ($this->request->is('post')) {
			$this->request->data['User']['role']=3;
			if ($this->User->save($this->request->data)) {
				$id = $this->User->id;
				$this->request->data['User'] = array_merge($this->request->data['User'], array('usuarioid' => $id));
				$this->Auth->login($this->request->data['User']);
				$this->set('logged_in', $this->Auth->loggedIn());
				$this->set('current_user', $this->Auth->user());
				return $this->redirect('/proyects/');
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}

	 public function add() {
	
		$roles = $this->Role->find( 'list', array( 'conditions' => array("not" => array ( "Role.nombre" => "Cliente"))));
		$this->set(compact('roles'));
		
		
        if ($this->request->is('post')) {
            $this->request->data['User']['role']=2;
			$this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        }
    }
	

}
