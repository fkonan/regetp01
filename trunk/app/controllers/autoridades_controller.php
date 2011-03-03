<?php
class AutoridadesController extends AppController {

	var $name = 'Autoridades';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Autoridad->recursive = 0;
		$this->set('autoridades', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Autoridad', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('autoridad', $this->Autoridad->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Autoridad->create();
			if ($this->Autoridad->save($this->data)) {
				$this->Session->setFlash(__('The Autoridad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Autoridad could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Autoridad', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Autoridad->save($this->data)) {
				$this->Session->setFlash(__('The Autoridad has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Autoridad could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Autoridad->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Autoridad', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Autoridad->del($id)) {
			$this->Session->setFlash(__('Autoridad deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Autoridad could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>