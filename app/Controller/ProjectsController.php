<?php

class ProjectsController extends AppController {
	public $uses = array('Project', 'Assignment','Deliverable','MessageDeliverable','MessageProject','Payment');

	public function beforeFilter() {

        parent::beforeFilter();
    }
	
	public function isAuthorized($user) {
		if($this->action === 'index' || $this->action === 'chatClients' || $this->action === 'detail' || $this->action === 'deliverables' || $this->action === 'deliverable') {
			return true;	
		}
		else if ($this->action === 'request' && $user['role'] == 4) {
			return true;
		}		
		else if ($this->action === 'payment' && ($user['role'] == 4 || $user['role'] == 1)) {
			return true;
		}
		else if (($this->action === 'upload' || $this->action === 'chatTeam') && $user['role'] <> 4) {
			return true;
		}
		// else if($this->action === 'detail')
			// return 
		$this->Session->setFlash('Service unavailable for your user.','error_message');
		return parent::isAuthorized($user);
	}
	
	public function index(){
		// print_r($this->Auth->user());
		$temp = $this->Auth->user();
		$this->set('role',$temp['role']);
		// $params = array('conditions' => array('Assignment.usuarioid' => $this->Auth->user('usuarioid') ),'order'=>'Project.proyectoid desc');
		$params = array('joins'=>array('type'=>'LEFT JOIN guatemal_db.asignacionProyecto AS Assignment','conditions'=>' ON Project.proyectoid=Assignment.proyectoid'),'conditions' => array('Assignment.usuarioid' => $this->Auth->user('usuarioid') ),'order'=>'Project.created desc');
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
			unset($this->Project->data['Project']['created']);
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
                $this->Session->setFlash('The project has been submitted.','success_message');
                return $this->redirect(array('action' => 'index'));
            }
			
            $this->Session->setFlash('The project could not be saved. Please, try again.','error_message');
        }
	 
	}
	
	public function detail($id = null) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}
		$Project = $this->Project->findByProyectoid($id);
		if (!$Project) {
			$this->Session->setFlash("The project doesn't exist",'error_message');
			$this->redirect(array('action' => 'index'));
		}
		$temp=$this->Auth->user();
		$usuarioid=$temp['usuarioid'];
		$Project = $this->Assignment->find('first', array('conditions' => array('Assignment.proyectoid' => $id,'Assignment.usuarioid'=>$usuarioid)));
		if (!$Project) {
			$this->Session->setFlash('You are not assigned to this project.','error_message');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('role',$temp['role']);
		$this->set('project',$Project);
		$status = array('Pending'=>'Pending','In process'=>'In process','Finished'=>'Finished','Rejected'=>'Rejected');
		$this->set(compact('status'));
		if ($this->request->is(array('post', 'put'))) {
			$this->Project->id = $id;
			$this->request->data['Project']['state'] = $this->request->data['Project']['Project state'];
			// print_r($this->request->data);
			// exit;
			// if ($this->Project->save($this->request->data)) {
			// print_r($this->request->data);
			// exit;
			if ($this->Project->save($this->request->data,array('conditions'=>array('Project.proyectoid'=>$id)))) {
				$this->Session->setFlash('Your Project has been updated.','success_message');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('Unable to update your Project.','error_message');
		}

		if (!$this->request->data) {
			$this->request->data = $Project;
		}
	}	
	
	public function deliverables($id = null) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}
		$Project = $this->Project->findByProyectoid($id);
		if (!$Project) {
			$this->Session->setFlash("The project doesn't exist",'error_message');
			$this->redirect(array('action' => 'index'));
		}
		$temp=$this->Auth->user();
		$usuarioid=$temp['usuarioid'];
		$this->set('role',$temp['role']);
		$this->set('id',$id);
		$Project = $this->Assignment->find('first', array('conditions' => array('Assignment.proyectoid' => $id,'Assignment.usuarioid'=>$usuarioid)));
		if (!$Project) {
			$this->Session->setFlash('You are not allowed to see this.','error_message');
			$this->redirect(array('action' => 'index'));
		}
		
		if($usuarioid==4)
			$params = array('joins'=>array('type'=>'LEFT JOIN guatemal_db.usuarios AS User','conditions'=>' ON User.usuarioid=Deliverable.usuarioid'),'fields'=>array('*'),'conditions' => array('Deliverable.approved' => 1,'Deliverable.proyectoid'=>$id),'order'=>'Deliverable.created desc');
		else
			$params = array('joins'=>array('type'=>'LEFT JOIN guatemal_db.usuarios AS User','conditions'=>' ON User.usuarioid=Deliverable.usuarioid'),'fields'=>array('*'),'conditions' => array('Deliverable.proyectoid'=>$id),'order'=>'Deliverable.created desc');
		$this->set('deliverables',$this->Deliverable->find('all',$params));

	
	}	
	function uploadFile() {
	  $file = $this->data['Deliverable']['File'];
	  if ($file['error'] === UPLOAD_ERR_OK) {
		$id = date("Ymd").$file['name'];
		if (move_uploaded_file($file['tmp_name'], APP.'uploads\\'.$id)) {
		  return $id;
		}
	  }
	  return 0;
	}
	
	public function upload($id = null) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}
		$Project = $this->Project->findByProyectoid($id);
		if (!$Project) {
			$this->Session->setFlash("The project doesn't exist",'error_message');
			$this->redirect(array('action' => 'index'));
		}
		$temp=$this->Auth->user();
		
		$usuarioid=$temp['usuarioid'];
		$Project = $this->Assignment->find('first', array('conditions' => array('Assignment.proyectoid' => $id,'Assignment.usuarioid'=>$usuarioid)));
		if (!$Project) {
			$this->Session->setFlash('You are not allowed to see this.','error_message');
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Project->id = $id;
			$link = $this->uploadFile();
			if($link<>0){
				$this->request->data['Deliverable']['File']=$link;
				$this->request->data['Deliverable']['usuarioid']=$usuarioid;
				$this->request->data['Deliverable']['proyectoid']=$id;
				$this->request->data['Deliverable']['uploadDate']=DboSource::expression('NOW()');;
				$this->Deliverable->create();
				unset($this->Deliverable->data['Deliverable']['created']);
				
				if ($this->Deliverable->save($this->request->data)) {
					$this->Session->setFlash('Your file was uploaded.','success_message');
					return $this->redirect(array('action' => 'deliverables',$id));
				}
					$this->Session->setFlash('Unable to upload file. Try again.','error_message');
			}
			else
				$this->Session->setFlash('Unable to upload file. Try again.','error_message');
		}
	}
	
	public function download($id) {
		if (!$id) {
			return false;
		}
		$deliverable = $this->Deliverable->find('first', array('conditions' => array('Deliverable.deliverableid' => $id)));
		$projectid = $deliverable['Deliverable']['proyectoid'];
		
		$Project = $this->Project->findByProyectoid($projectid);
		if (!$Project) {
			return false;
		}
		$temp=$this->Auth->user();
		$usuarioid=$temp['usuarioid'];
		$Project = $this->Assignment->find('first', array('conditions' => array('Assignment.proyectoid' => $projectid,'Assignment.usuarioid'=>$usuarioid)));
		if (!$Project) {
			return false;
		}
		if($usuarioid==4 && $deliverable['Deliverable']['approved']==0)
		{
			return false;
		}
		$deliverable = $this->Deliverable->find('first', array('conditions' => array('Deliverable.deliverableid' => $id)));
		$path = APP.'uploads\\'.$deliverable['Deliverable']['File'];
		$this->response->file($path, array(
			'download' => true,
			'name' => $deliverable['Deliverable']['File'],
		));
		return $this->response;
	}
	
	public function deliverable($id = null) {
	
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}
		$deliverable = $this->Deliverable->find('first', array('conditions' => array('Deliverable.deliverableid' => $id)));
		$projectid = $deliverable['Deliverable']['proyectoid'];
		
		$Project = $this->Project->findByProyectoid($projectid);
		if (!$Project) {
			$this->Session->setFlash("The project doesn't exist",'error_message');
			$this->redirect(array('action' => 'index'));
		}
		$temp=$this->Auth->user();
		$usuarioid=$temp['usuarioid'];
		$Project = $this->Assignment->find('first', array('conditions' => array('Assignment.proyectoid' => $projectid,'Assignment.usuarioid'=>$usuarioid)));
		if (!$Project) {
			$this->Session->setFlash('You are not assigned to this project.','error_message');
			$this->redirect(array('action' => 'index'));
		}
		if($usuarioid==4 && $deliverable['Deliverable']['approved']==0)
		{
			$this->Session->setFlash('You are not allowed in this conversation','error_message');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('role',$temp['role']);
		$this->set('deliverable',$deliverable);
		$this->set('projectid',$projectid);
		$this->set('approve',array(1=>''));
		$this->set('selected',array($deliverable['Deliverable']['approved']));
		$params = array('joins'=>array('type'=>'LEFT JOIN guatemal_db.usuarios AS User','conditions'=>' ON User.usuarioid=MessageDeliverable.usuarioid'),
			'fields'=>array('*'),
			'conditions' => array('MessageDeliverable.deliverableid' => $id),
			'order'=>'MessageDeliverable.created desc');
		$this->set('messages',$this->MessageDeliverable->find('all',$params));
		if ($this->request->is(array('post', 'put'))) {
			if(isset($this->request->data['Deliverable']['approved'])){
				
				$this->request->data['Deliverable']['approved']=(int)$this->request->data['Deliverable']['approved'];
				// print_r($this->request->data);
				// exit;
				$this->Deliverable->id = $id;
				// if ($this->Deliverable->save($this->request->data,array('conditions'=>array('Deliverable.deliverableid'=>$id)))) {
				if ($this->Deliverable->save($this->request->data)) {
					$this->Session->setFlash('Deliverable updated','success_message');
					return $this->redirect(array('action' => 'deliverables',$projectid));
				}
				else
					$this->Session->setFlash('Unable to update.','error_message');
			}
			else
			{
				
				$row['MessageDeliverable'] = array('message'=>$this->request->data['Comment']['comment']);
				$row['MessageDeliverable']['deliverableid'] = $id;
				$row['MessageDeliverable']['usuarioid'] = $usuarioid;
				// exit;
				$this->MessageDeliverable->create();
				unset($this->MessageDeliverable->data['MessageDeliverable']['created']);
				if ($this->MessageDeliverable->save($row)) {
					$this->Session->setFlash('Your comment has been sent.','success_message');
					return $this->redirect(array('action' => 'deliverable',$id));
				}
				else
					$this->Session->setFlash('Unable to submit comment.','error_message');
			}
		}
	}	

	public function chatClients($id = null) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}
		$Project = $this->Project->findByProyectoid($id);
		if (!$Project) {
			$this->Session->setFlash("The project doesn't exist",'error_message');
			$this->redirect(array('action' => 'index'));
		}
		$temp=$this->Auth->user();
		$usuarioid=$temp['usuarioid'];
		$this->set('role',$temp['role']);
		$this->set('id',$id);
		$this->set('Project',$Project);
		$Project = $this->Assignment->find('first', array('conditions' => array('Assignment.proyectoid' => $id,'Assignment.usuarioid'=>$usuarioid)));
		if (!$Project) {
			$this->Session->setFlash('You are not allowed to see this.','error_message');
			$this->redirect(array('action' => 'index'));
		}
		
		$params = array('joins'=>array('type'=>'LEFT JOIN guatemal_db.usuarios AS User','conditions'=>' ON User.usuarioid=MessageProject.usuarioid'),
			'fields'=>array('*'),
			'conditions' => array('MessageProject.proyectoid' => $id,'MessageProject.withClient'=>1),
			'order'=>'MessageProject.created desc');
		$this->set('messages',$this->MessageProject->find('all',$params));
		if ($this->request->is(array('post', 'put'))) {
			$row['MessageProject'] = array('message'=>$this->request->data['Comment']['comment']);
			$row['MessageProject']['proyectoid'] = $id;
			$row['MessageProject']['usuarioid'] = $usuarioid;
			$row['MessageProject']['withClient'] = 1;
			// exit;
			$this->MessageProject->create();
			unset($this->MessageProject->data['MessageProject']['created']);
			if ($this->MessageProject->save($row)) {
				$this->Session->setFlash('Your comment has been sent.','success_message');
				return $this->redirect(array('action' => 'chatClients',$id));
			}
			else
				$this->Session->setFlash('Unable to submit comment.','error_message');	
		}
	}	
	
	public function chatTeam($id = null) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}
		$Project = $this->Project->findByProyectoid($id);
		if (!$Project) {
			$this->Session->setFlash("The project doesn't exist",'error_message');
			$this->redirect(array('action' => 'index'));
		}
		$temp=$this->Auth->user();
		$usuarioid=$temp['usuarioid'];
		$this->set('role',$temp['role']);
		$this->set('id',$id);
		$this->set('Project',$Project);
		$Project = $this->Assignment->find('first', array('conditions' => array('Assignment.proyectoid' => $id,'Assignment.usuarioid'=>$usuarioid)));
		if (!$Project) {
			$this->Session->setFlash('You are not allowed to see this.','error_message');
			$this->redirect(array('action' => 'index'));
		}
		
		$params = array('joins'=>array('type'=>'LEFT JOIN guatemal_db.usuarios AS User','conditions'=>' ON User.usuarioid=MessageProject.usuarioid'),
			'fields'=>array('*'),
			'conditions' => array('MessageProject.proyectoid' => $id,'MessageProject.withClient'=>0),
			'order'=>'MessageProject.created desc');
		$this->set('messages',$this->MessageProject->find('all',$params));
		if ($this->request->is(array('post', 'put'))) {
			$row['MessageProject'] = array('message'=>$this->request->data['Comment']['comment']);
			$row['MessageProject']['proyectoid'] = $id;
			$row['MessageProject']['usuarioid'] = $usuarioid;
			$row['MessageProject']['withClient'] = 0;
			// exit;
			$this->MessageProject->create();
			unset($this->MessageProject->data['MessageProject']['created']);
			if ($this->MessageProject->save($row)) {
				$this->Session->setFlash('Your comment has been sent.','success_message');
				return $this->redirect(array('action' => 'chatClients',$id));
			}
			else
				$this->Session->setFlash('Unable to submit comment.','error_message');	
		}
	}	
	
	public function payment($id = null) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}
		$Project = $this->Project->findByProyectoid($id);
		if (!$Project) {
			$this->Session->setFlash("The project doesn't exist",'error_message');
			$this->redirect(array('action' => 'index'));
		}
		$temp=$this->Auth->user();
		$usuarioid=$temp['usuarioid'];
		$this->set('role',$temp['role']);
		$this->set('id',$id);
		$this->set('project',$Project);
		$Project = $this->Assignment->find('first', array('conditions' => array('Assignment.proyectoid' => $id,'Assignment.usuarioid'=>$usuarioid)));
		if (!$Project) {
			$this->Session->setFlash('You are not allowed to see this.','error_message');
			$this->redirect(array('action' => 'index'));
		}
		
		$params = array('conditions' => array('Payment.proyectoid' => $id),'order'=>'Payment.updated desc');
		$this->set('payment',$this->Payment->find('all',$params));
		$params = array('fields'=>'SUM(payment) as hola','conditions' => array('Payment.proyectoid' => $id),'order'=>'Payment.updated desc');
		// echo $this->Payment->find('all',$params)[0][0]['hola'];
		$this->set('total',$this->Payment->find('all',$params)[0][0]['hola']);

		if ($this->request->is(array('post', 'put'))){
			if($this->request->data['Payment']['Quantity']!=""){
			$data['Payment'] = array('payment'=>number_format($this->request->data['Payment']['Quantity'], 2, '.', ''));
			$data['Payment']['description'] = $this->request->data['Payment']['Description'];
			$data['Payment']['proyectoid'] = $id;
			$this->Payment->create();
			unset($this->Payment->data['Payment']['updated']);
			if ($this->Payment->save($data))
				$this->Session->setFlash('Information updated.','success_message');
			else
				$this->Session->setFlash('Unable to submit information. Submit the correct values.','error_message');	
			}
			
			$row['Project'] = array('cost'=>number_format((double)$this->request->data['Payment']['Update Cost'], 2, '.', ''));
			$row['Project']['proyectoid'] = $id;
			$this->Project->id = $id;
			print_r($row);
			// exit;
			// if ($this->Project->save($this->request->data)) {
			// print_r($this->request->data);
			// exit;
			// if ($this->Project->save($this->request->data,array('conditions'=>array('Project.proyectoid'=>$id)))) {
			// exit;
			$this->Project->save($row);
			return $this->redirect(array('action' => 'payment',$id));
		}
	}
	
}
