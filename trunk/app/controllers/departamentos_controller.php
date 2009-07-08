<?php
class DepartamentosController extends AppController {

	var $name = 'Departamentos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Departamento->recursive = 0;
		$this->set('departamentos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Departamento', true), array('action'=>'index'));
		}
		$this->set('departamento', $this->Departamento->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Departamento->create();
			if ($this->Departamento->save($this->data)) {
				$this->flash(__('Departamento saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$jurisdicciones = $this->Departamento->Jurisdiccion->find('list');
		$this->set(compact('jurisdicciones'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Departamento', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Departamento->save($this->data)) {
				$this->flash(__('The Departamento has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Departamento->read(null, $id);
		}
		$jurisdicciones = $this->Departamento->Jurisdiccion->find('list');
		$this->set(compact('jurisdicciones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Departamento', true), array('action'=>'index'));
		}
		if ($this->Departamento->del($id)) {
			$this->flash(__('Departamento deleted', true), array('action'=>'index'));
		}
	}
	
	function ajax_select_departamento_form_por_jurisdiccion(){
		$this->layout = 'ajax';
         Configure::write('debug',0);
         
         $this->Departamento->recursive = -1;  
         
         if (isset($this->data['Instit']['jurisdiccion_id'])){
         	if($this->data['Instit']['jurisdiccion_id'] == 0 ){//buscar a todas
				$deptos = $this->Departamento->find('all',array('order'=>'name ASC'));
        	 }else{
         		$deptos = $this->Departamento->find('all',array('order'=>'name ASC','conditions' => array('jurisdiccion_id' => $this->data['Instit']['jurisdiccion_id']),
        																     array('order'=>'name ASC')));
        	 }
        	 $this->set('deptos', $deptos);
         }         	     
         
		 //prevent useless warnings for Ajax
	     $this->render('ajax_select_departamento_form_por_jurisdiccion','ajax');
	}

}
?>