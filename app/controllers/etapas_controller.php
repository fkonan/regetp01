<?php
class EtapasController extends AppController {

	var $name = 'Etapas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Etapa->recursive = 0;
		$this->set('etapas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Etapa.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('etapa', $this->Etapa->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Etapa->create();
			if ($this->Etapa->save($this->data)) {
				$this->Session->setFlash(__('The Etapa has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Etapa could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Etapa', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Etapa->save($this->data)) {
				$this->Session->setFlash(__('The Etapa has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Etapa could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Etapa->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Etapa', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Etapa->del($id)) {
			$this->Session->setFlash(__('Etapa deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>