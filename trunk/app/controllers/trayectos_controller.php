<?php
class TrayectosController extends AppController {

	var $name = 'Trayectos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Trayecto->recursive = 0;
		$this->set('trayectos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Trayecto.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('trayecto', $this->Trayecto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Trayecto->create();
			if ($this->Trayecto->save($this->data)) {
				$this->Session->setFlash(__('The Trayecto has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Trayecto could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Trayecto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Trayecto->save($this->data)) {
				$this->Session->setFlash(__('The Trayecto has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Trayecto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Trayecto->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Trayecto', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Trayecto->del($id)) {
			$this->Session->setFlash(__('Trayecto deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>