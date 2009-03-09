<?php
class PlanesController extends AppController {

	var $name = 'Planes';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Plan->recursive = 0;
		$this->set('planes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Plan.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('plan', $this->Plan->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Plan->create();
			if ($this->Plan->save($this->data)) {
				$this->Session->setFlash(__('The Plan has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Plan could not be saved. Please, try again.', true));
			}
		}
		$instits = $this->Plan->Instit->find('list');
		$ofertas = $this->Plan->Oferta->find('list');
		$this->set(compact('instits', 'ofertas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Plan', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Plan->save($this->data)) {
				$this->Session->setFlash(__('The Plan has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Plan could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Plan->read(null, $id);
		}
		$instits = $this->Plan->Instit->find('list');
		$ofertas = $this->Plan->Oferta->find('list');
		$this->set(compact('instits','ofertas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Plan', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Plan->del($id)) {
			$this->Session->setFlash(__('Plan deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>