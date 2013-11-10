<?php

class UsersController extends AppController {
	 public $uses = array('Role', 'User','Assignment');

	public function beforeFilter() {
        
		
		// $this->Auth->allow('add');
        parent::beforeFilter();
    }
		
	public function isAuthorized($user) {
		if (($this->action == 'add' || $this->action == 'assign') && $user['role'] == 1) {
			return true;
		}
		$this->Session->setFlash('Service unavailable for your user.','error_message');
		return parent::isAuthorized($user);
	}
	
	
	
	public function login() {
		$rol = $this->Auth->user();
		$rol=$rol['role'];
		if($rol!="")
			$this->redirect(array('controller' => 'projects', 'action' => 'index'));
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash('Invalid username or password, try again','error_message');
		}
	}
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
	

	public function register() {
		// print_r($this->Auth->user());
		$rol = $this->Auth->user();
		$rol=$rol['role'];
		if($rol!="")
			$this->redirect(array('controller' => 'projects', 'action' => 'index'));
		if ($this->request->is('post')) {
			$this->request->data['User']['role']=4;
			if ($this->User->save($this->request->data)) {
				$id = $this->User->id;
				$this->request->data['User'] = array_merge($this->request->data['User'], array('usuarioid' => $id));
				$this->Auth->login($this->request->data['User']);
				$this->set('logged_in', $this->Auth->loggedIn());
				$this->set('current_user', $this->Auth->user());
				return $this->redirect('/proyects/');
			}
			$this->Session->setFlash('Invalid username or password, try again','error_message');
		}
	}

	 public function add() {
	
		$roles = $this->Role->find( 'list', array( 'conditions' => array("not" => array ( "Role.nombre" => "Cliente"))));
		$this->set(compact('roles'));
        if ($this->request->is('post')) {
            $this->request->data['User']['role']=2;
			$this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved','success_message');
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash('The user could not be saved. Please, try again.','error_message');
        }
    }
	
	public function assign($id = null) {
		if (!$id) {
			$this->Session->setFlash('You are not assigned to this project.','error_message');
			$this->redirect(array('action' => 'index'));
		}
		$Project = $this->Assignment->findByProyectoid($id);
		if (!$Project) {
			$this->Session->setFlash("The project doesn't exist",'error_message');
			$this->redirect(array('controller'=>'projects','action' => 'index'));
		}
		$temp=$this->Auth->user();
		$usuarioid=$temp['usuarioid'];
		$allusers= $this->User->find('all',array('conditions'=>array('not'=>array("User.usuarioid"=>1,"User.role" =>4))));
		$assigned =  $this->Assignment->find('all',array('order'=>array('Assignment.usuarioid'),'fields'=>array('Assignment.usuarioid'),'conditions'=>array("Assignment.proyectoid"=>$id)));
		// print_r($allusers);
		$selected = array();
		foreach($assigned as $ass){
			array_push($selected,$ass['Assignment']['usuarioid']);
		}
		$users = array();
		foreach($allusers as $user){
			$users[$user['User']['usuarioid']] = $user['User']['username'];
		}
		$this->set('users',$users);
		$this->set('selected',$selected);
		$this->set('id',$id);
		// print_r($users);
		// exit;
		
		if ($this->request->is(array('post', 'put'))) {
			// print_r($this->request->data);
			$data = $this->request->data;
			$this->Assignment->deleteAll(array(array('Assignment.proyectoid' => $id),array('not'=>array('Assignment.usuarioid'=>1))), false);
			foreach($data['User']['Team members'] as $usuarioid){
				$row = array('Assignment'=>array('usuarioid'=>$usuarioid,'proyectoid'=>$id));
				$this->Assignment->create();
				$this->Assignment->save($row);
				// print_r($row);
				
			}
			
			
			$this->Session->setFlash('Members assigned.','success_message');
			
		}
	}
	

}
