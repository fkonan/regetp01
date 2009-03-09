<?php
class TipoinstitsController extends AppController {

	var $name = 'Tipoinstits';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Tipoinstit->recursive = 0;
		$this->set('tipoinstits', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Tipoinstit.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tipoinstit', $this->Tipoinstit->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tipoinstit->create();
			if ($this->Tipoinstit->save($this->data)) {
				$this->Session->setFlash(__('The Tipoinstit has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tipoinstit could not be saved. Please, try again.', true));
			}
		}
		$jurisdicciones = $this->Tipoinstit->Jurisdiccion->find('list');
		$this->set(compact('jurisdicciones'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tipoinstit', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tipoinstit->save($this->data)) {
				$this->Session->setFlash(__('The Tipoinstit has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tipoinstit could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tipoinstit->read(null, $id);
		}
		$jurisdicciones = $this->Tipoinstit->Jurisdiccion->find('list');
		$this->set(compact('jurisdicciones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tipoinstit', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tipoinstit->del($id)) {
			$this->Session->setFlash(__('Tipoinstit deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>