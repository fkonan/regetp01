<?php
class LocalidadesController extends AppController {

	var $name = 'Localidades';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Localidad->recursive = 0;
		$this->set('localidades', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Localidad.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('localidad', $this->Localidad->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Localidad->create();
			if ($this->Localidad->save($this->data)) {
				$this->Session->setFlash(__('The Localidad has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Localidad could not be saved. Please, try again.', true));
			}
		}
		$departamentos = $this->Localidad->Departamento->find('list');
		$this->set(compact('departamentos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Localidad', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Localidad->save($this->data)) {
				$this->Session->setFlash(__('The Localidad has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Localidad could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Localidad->read(null, $id);
		}
		$departamentos = $this->Localidad->Departamento->find('list');
		$this->set(compact('departamentos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Localidad', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Localidad->del($id)) {
			$this->Session->setFlash(__('Localidad deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	function ajax_select_localidades_form_por_departamento(){
		 $this->layout = 'ajax';
        // Configure::write('debug',0);
         
         $this->Tipoinstit->recursive = -1;  
         
         if (isset($this->data['Instit']['departamento_id'])){
         	if($this->data['Instit']['departamento_id'] == 0 ){//buscar a todas
         		$localidades = $this->Localidad->find('all',array('order'=>'Localidad.name ASC'));
         	}else{
         		$localidades = $this->Localidad->find('all',array('conditions' => array('departamento_id' => $this->data['Instit']['departamento_id']),
         											  array('order'=>'Localidad.name ASC')));
         	}
         	debug(76235475);
	        $this->set('localidades', $localidades);
	         
	         //prevent useless warnings for Ajax
	         $this->render('ajax_select_localidades_form_por_departamento','ajax');
         }			
	}

}
?>