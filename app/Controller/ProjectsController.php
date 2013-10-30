<?php

class ProjectsController extends AppController {
	public $uses = array('Project', 'Assignment');

	public function beforeFilter() {

        parent::beforeFilter();
    }
	
	public function isAuthorized($user) {
		if($this->action === 'index') {
			return true;	
		}
		else if ($this->action === 'detail') {
			return true;
		}
		// else if($this->action === 'detail')
			// return 
	
		return parent::isAuthorized($user);
	}
	
	public function index(){
		// print_r($this->Auth->user());
		$temp = $this->Auth->user();
		$this->set('role',$temp['role']);
		$params = array('conditions' => array('Assignment.usuarioid' => $this->Auth->user('usuarioid') ),'order'=>'Project.proyectoid desc');
		$params = array('joins'=>array('type'=>'LEFT JOIN guatemal_db.asignacionProyecto AS Assignment','conditions'=>' ON Project.proyectoid=Assignment.proyectoid'),'conditions' => array('Assignment.usuarioid' => $this->Auth->user('usuarioid') ),'order'=>'Project.proyectoid desc');
		$this->set('projects',$this->Project->find('all',$params));
		// $allProjects = $this->Assignment->find('all',array(
        // 'conditions' => array('Assignment.usuarioid' => $this->Auth->user('usuarioid') )));
	}	
	
	public function request(){
	
		
        if ($this->request->is('post')) {
			$this->request->data['Project']['usuarioid']=$this->Auth->user('usuarioid');
			// print_r($this->request->data);
			
			// exit;
			$this->Project->create();
            if ($this->Project->save($this->request->data)) {
				$this->Assignment->create();
				$algo = array(
				'Assignment' => array(
					'proyectoid'=>$this->Project->getLastInsertID(),
					'usuarioid'=>$this->Auth->user('usuarioid')
				)
				);
				$this->Assignment->save($algo);
				if($this->Auth->user('usuarioid')!=1){
					$this->Assignment->create();
					$algo = array(
					'Assignment' => array(
						'proyectoid'=>$this->Project->getLastInsertID(),
						'usuarioid'=>1
					)
					);
					$this->Assignment->save($algo);
				}
                $this->Session->setFlash(__('The project has been submitted.'));
                return $this->redirect(array('action' => 'index'));
            }
			
            $this->Session->setFlash(__('The project could not be saved. Please, try again.'));
        }
	 
	}
	
	public function detail($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid Project'));
		}
		$Project = $this->Project->findByProyectoid($id);
		if (!$Project) {
			throw new NotFoundException(__('Invalid Project'));
		}
		$temp = $this->Auth->user();
		$this->set('role',$temp['role']);
		$this->set('project',$Project);
		$status = array('Pending'=>'Pending','In process'=>'In process','Finished'=>'Finished','Rejected'=>'Rejected');
		$this->set(compact('status'));
		if ($this->request->is(array('post', 'put'))) {
			$this->Project->id = $id;
			// print_r($this->request->data);
			// exit;
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('Your Project has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('Unable to update your Project.','error_message');
		}

		if (!$this->request->data) {
			$this->request->data = $Project;
		}
	}	
	
}
