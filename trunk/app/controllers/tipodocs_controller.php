<?php
class TipodocsController extends AppController {

	var $name = 'Tipodocs';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Tipodoc->recursive = 0;
		$this->set('tipodocs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Tipodoc.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tipodoc', $this->Tipodoc->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tipodoc->create();
			if ($this->Tipodoc->save($this->data)) {
				$this->Session->setFlash(__('The Tipodoc has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tipodoc could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tipodoc', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tipodoc->save($this->data)) {
				$this->Session->setFlash(__('The Tipodoc has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tipodoc could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tipodoc->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tipodoc', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tipodoc->del($id)) {
			$this->Session->setFlash(__('Tipodoc deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>