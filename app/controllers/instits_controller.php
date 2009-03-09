<?php
class InstitsController extends AppController {

	var $name = 'Instits';
	var $helpers = array('Html', 'Form');

	function index() {		
		$this->Instit->recursive = 0;
		$this->set('instits', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Institución Inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('instit', $this->Instit->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Instit->create();
			if ($this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}
		$gestiones = $this->Instit->Gestion->find('list');
		$dependencias = $this->Instit->Dependencia->find('list');
		$tipoinstits = $this->Instit->Tipoinstit->find('list');
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		$this->set(compact('gestiones', 'dependencias', 'tipoinstits', 'jurisdicciones'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Instit', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if (!empty($this->data)) {
			if ($this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Instit->read(null, $id);
		}
		$gestiones = $this->Instit->Gestion->find('list');
		$dependencias = $this->Instit->Dependencia->find('list');
		$tipoinstits = $this->Instit->Tipoinstit->find('list');
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		$this->set(compact('gestiones','dependencias','tipoinstits','jurisdicciones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Se ha pasado un id que no existe para esa Institución', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Instit->del($id)) {
			$this->Session->setFlash(__('Se ha eliminado la Institución correctamente', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function search_form(){
		
		$gestiones = $this->Instit->Gestion->find('list');
		$dependencias = $this->Instit->Dependencia->find('list');
		$tipoinstits = $this->Instit->Tipoinstit->find('list');
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		$this->set(compact('gestiones', 'dependencias', 'tipoinstits', 'jurisdicciones'));
	}
	
	function search(){
		
		
		if (empty($this->data) && empty($this->params['named']['page'])) {
			$this->redirect('search_form');
		}
		
		$array_condiciones = array();
		
		if($this->data['Instit']['cue'] != '')
			$array_condiciones['Instit.cue LIKE'] = '%'.trim($this->data['Instit']['cue']).'%';
		
		if($this->data['Instit']['tipoinstit_id'] != '' || $this->data['Instit']['tipoinstit_id'] != 0)
			$array_condiciones['Tipoinstit.id']= $this->data['Instit']['tipoinstit_id'];		
		
		if($this->data['Instit']['jurisdiccion_id'] != '' || $this->data['Instit']['jurisdiccion_id'] != 0)
			$array_condiciones['Jurisdiccion.id'] = $this->data['Instit']['jurisdiccion_id'];			
					
		if($this->data['Instit']['nombre'] != '')
			$array_condiciones['Instit.nombre LIKE'] = '%'.$this->data['Instit']['nombre'].'%';			
		
		if($this->data['Instit']['direccion'] != '')
			$array_condiciones['Instit.direccion LIKE'] = '%'.$this->data['Instit']['direccion'].'%';			

		if($this->data['Instit']['gestion_id'] != '')
			$array_condiciones['Instit.gestion_id'] = $this->data['Instit']['gestion_id'];			
	
		if($this->data['Instit']['dependencia_id'] != '')
			$array_condiciones['Instit.dependencia_id'] = $this->data['Instit']['dependencia_id'];			
		
		if($this->data['Instit']['esanexo']) 
			$array_condiciones['Instit.esanexo'] = $this->data['Instit']['esanexo'];

		if($this->data['Instit']['activo']) 
			$array_condiciones['Instit.activo'] = $this->data['Instit']['activo'];
	
		$this->paginate = array(  
             'conditions'=>array($array_condiciones),  
             'limit'=>30,
             'order'=> array('Instit.nombre' => 'asc')
         );  	
		
         $this->Instit->recursive = 1;         
         
         $this->set('instits', $this->paginate());
	}

}
?>