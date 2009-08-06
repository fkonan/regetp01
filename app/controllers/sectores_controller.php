<?php
class SectoresController extends AppController {

	var $name = 'Sectores';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Sector->recursive = 0;
		$this->set('sectores', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Sector.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('sector', $this->Sector->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Sector->create();
			if ($this->Sector->save($this->data)) {
				$this->Session->setFlash(__('The Sector has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Sector could not be saved. Please, try again.', true));
			}
		}
		$this->set('sectores',$this->Sector->generatetreelist());
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Sector', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sector->save($this->data)) {
				$this->Session->setFlash(__('The Sector has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Sector could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sector->read(null, $id);
		}
		$this->set('sectores',$this->Sector->generatetreelist());
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Sector', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sector->del($id)) {
			$this->Session->setFlash(__('Sector deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>