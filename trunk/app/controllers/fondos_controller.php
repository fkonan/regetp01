<?php
class FondosController extends AppController {

	var $name = 'Fondos';
	var $helpers = array('Html', 'Form', 'Paginator');

	function index() {
		$this->Fondo->recursive = 0;
		$this->set('fondos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Fondo.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('fondo', $this->Fondo->read(null, $id));
	}

	function add_institucion($instit_id = 0) {
		
		if (!empty($this->data)) {
			//si el fondo es de una institucion la jurisdiccional debe quedar en CERO
			$this->data['Fondo']['jurisdiccion_id'] = 0;
			
			$this->Fondo->create();
			if ($this->Fondo->save($this->data)) {
				$this->Session->setFlash(__('Se guardó el fondo', true));
				$this->redirect(array('action'=>'fondo_de_instit', $instit_id));
			} else {
				//debug($this->data);die();
				$this->Session->setFlash(__('The Fondo could not be saved. Please, try again.', true));
			}
		}
		//$instits = $this->Fondo->Instit->find('list');
		//$jurisdicciones = $this->Fondo->Jurisdiccion->find('list');
		$lineasDeAcciones = $this->Fondo->LineasDeAccion->find('list');
		$this->set('instit_id', $instit_id);
		$this->set(compact('lineasDeAcciones'));
	}
	
	function add_jurisdiccional($jur_id = 0) {
		if (!empty($this->data)) {
			//si el fondo es jurisdiccionl, la institucion debe quedar en CERO
			$this->data['Fondo']['instit_id'] = 0;
		
			$this->Fondo->create();
			if ($this->Fondo->save($this->data)) {
				$this->Session->setFlash(__('The Fondo has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Fondo could not be saved. Please, try again.', true));
			}
		}
		$instits = $this->Fondo->Instit->find('list');
		$jurisdicciones = $this->Fondo->Jurisdiccion->find('list');
		$lineasDeAcciones = $this->Fondo->LineasDeAccion->find('list');
		$this->set(compact('instits', 'jurisdicciones', 'lineasDeAcciones'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Fondo', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fondo->save($this->data)) {
				$this->Session->setFlash(__('The Fondo has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Fondo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fondo->read(null, $id);
		}
		$instits = $this->Fondo->Instit->find('list');
		$jurisdicciones = $this->Fondo->Jurisdiccion->find('list');
		$lineasDeAcciones = $this->Fondo->LineasDeAccion->find('list');
		$this->set(compact('instits','jurisdicciones','lineasDeAcciones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Fondo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Fondo->del($id)) {
			$this->Session->setFlash(__('Fondo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	function fondo_de_instit($instit_id){
		$this->paginate = array('conditions' => array('instit_id'=>$instit_id));
		$this->Fondo->order = 'fecha_aprobacion, lineas_de_accion_id';
		
		$this->set('instit_id',$instit_id);
		$this->set('fondos', $this->paginate());
	}

}
?>