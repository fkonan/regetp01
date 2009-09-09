<?php
class LocalidadesController extends AppController {

	var $name = 'Localidades';
	var $helpers = array('Html', 'Form', 'Ajax');

	function index($jurisdiccion = 0) {
		$this->Localidad->recursive = 2;
		if ($jurisdiccion != 0):
		 	$this->paginate = array('limit' => 5000, 'page' => 1); 
		 	$this->set('localidades', $this->paginate(null,array('Departamento.jurisdiccion_id'=>$jurisdiccion)));
		else:
			 $this->set('localidades', $this->paginate());
		endif;
		$this->set('jurisdicciones',$this->Localidad->Departamento->Jurisdiccion->find('list'));
		$this->set('url_conditions', array());
	}
	
	
	function ver($jurisdiccion = 0) {
		$this->Localidad->recursive = 2;
		$jurisdiccion =  (isset($this->passedArgs['jurisdiccion_id']))?$this->passedArgs['jurisdiccion_id']:$jurisdiccion;
		$jurisdiccion =  (isset($this->data['Localidad']['jurisdiccion_id']))?$this->data['Localidad']['jurisdiccion_id']:$jurisdiccion;
		
		if ($jurisdiccion != 0):
		 	$this->paginate = array('limit' => 5000, 'page' => 1); 
		 	$this->set('localidades', $this->paginate(null,array('Departamento.jurisdiccion_id'=>$jurisdiccion)));
		else:
			 $this->set('localidades', $this->paginate());
		endif;
		
		$condiciones['jurisdiccion_id'] = $jurisdiccion;
		$this->set('url_conditions', $condiciones);
		$this->set('jurisdicciones',$this->Localidad->Departamento->Jurisdiccion->find('list'));
		$this->render('/localidades/index');		
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
			} else {
				$this->Session->setFlash(__('The Localidad could not be saved. Please, try again.', true));
			}
		}
		$jurisdicciones = $this->Localidad->Departamento->Jurisdiccion->find('list');		
		if (isset($this->data['Localidad']['jurisdiccion_id'])):
			$condicion = array('jurisdiccion_id'=>$this->data['Localidad']['jurisdiccion_id']);
			$departamentos = $this->Localidad->Departamento->find('list',array('conditions'=>$condicion)); 
		endif;
		$departamentos = $this->Localidad->Departamento->find('list');
		$this->set(compact('departamentos','jurisdicciones'));
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
		$this->Localidad->recursive = 2;
		if (empty($this->data)) {
			$this->data = $this->Localidad->read(null, $id);
		}	
		$departamentos = $this->Localidad->Departamento->find('list',array('conditions'=>array('jurisdiccion_id'=>$this->data['Departamento']['Jurisdiccion']['id'])));
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
         Configure::write('debug',0);
         $this->Localidad->recursive = -1;

         $localidades = array();
         $depto_id = 0;
         
         if (isset($this->data['Departamento']['id'])):
         	$depto_id = $this->data['Departamento']['id'];
         endif;
         if (isset($this->data['Instit']['departamento_id'])):
         	$depto_id = $this->data['Instit']['departamento_id'];
         endif;
         
         if ($depto_id != 0){
         	$localidades = $this->Localidad->find('list',array('conditions' => array('departamento_id' => $depto_id),
         											  array('order'=>'Localidad.name ASC')));
         }

	     $this->set('localidades', $localidades);
	         
	     //prevent useless warnings for Ajax
	     $this->render('ajax_select_localidades_form_por_departamento','ajax');			
	}

}
?>