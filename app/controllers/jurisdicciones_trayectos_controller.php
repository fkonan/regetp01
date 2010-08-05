<?php
class JurisdiccionesTrayectosController extends AppController {

	var $name = 'JurisdiccionesTrayectos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->JurisdiccionesTrayecto->recursive = 0;
		$this->set('jurisdiccionesTrayectos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid JurisdiccionesTrayecto.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('jurisdiccionesTrayecto', $this->JurisdiccionesTrayecto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JurisdiccionesTrayecto->create();
			if ($this->JurisdiccionesTrayecto->save($this->data)) {
				$this->Session->setFlash(__('The JurisdiccionesTrayecto has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JurisdiccionesTrayecto could not be saved. Please, try again.', true));
			}
		}
		$jurisdicciones = $this->JurisdiccionesTrayecto->Jurisdiccion->find('list');
		$trayectos = $this->JurisdiccionesTrayecto->Trayecto->find('list');
		$this->set(compact('jurisdicciones', 'trayectos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid JurisdiccionesTrayecto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->JurisdiccionesTrayecto->save($this->data)) {
				$this->Session->setFlash(__('The JurisdiccionesTrayecto has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JurisdiccionesTrayecto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JurisdiccionesTrayecto->read(null, $id);
		}
		$jurisdicciones = $this->JurisdiccionesTrayecto->Jurisdiccion->find('list');
		$trayectos = $this->JurisdiccionesTrayecto->Trayecto->find('list');
		$this->set(compact('jurisdicciones','trayectos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for JurisdiccionesTrayecto', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JurisdiccionesTrayecto->del($id)) {
			$this->Session->setFlash(__('JurisdiccionesTrayecto deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>