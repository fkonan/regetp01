<?php
class FondoTemporalesController extends AppController {

	var $name = 'FondoTemporales';
	var $helpers = array('Html', 'Form', 'Paginator');

	function index() {
		$this->FondoTemporal->recursive = 0;
                
                $this->paginate['fields'] = array('id','anio','trimestre','jurisdiccion_id','jurisdiccion_name',
                    'memo','cuecompleto','instit','instit_name','departamento','localidad',
                    'f01','f02a','f02b','f02c','f03a','f03b','f04','f05','f06a','f06b','f06c','f07a','f07b','f07c',
                    'f08','f09','total','equipinf','refaccion','instit_id','observacion','totales_checked','cue_checked',
                    'SUM(f01+f02a+f02b+f02c+f03a+f03b+f04+f05+f06a+f06b+f06c+f07a+f07b+f07c+f08+f09+equipinf+refaccion) as "FondoTemporal__suma_fila"');
		$this->paginate['group'] = array('id','anio','trimestre','jurisdiccion_id','jurisdiccion_name',
                    'memo','cuecompleto','instit','instit_name','departamento','localidad',
                    'f01','f02a','f02b','f02c','f03a','f03b','f04','f05','f06a','f06b','f06c','f07a','f07b','f07c',
                    'f08','f09','total','equipinf','refaccion','instit_id','observacion','totales_checked','cue_checked');
                //pr($this->paginate);
                $this->set('fondos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FondoTemporal.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('fondo', $this->FondoTemporal->read(null, $id));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FondoTemporal', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->FondoTemporal->save($this->data)) {
				$this->Session->setFlash(__('The FondoTemporal has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The FondoTemporal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FondoTemporal->read(null, $id);
		}
		$instits = $this->FondoTemporal->Instit->find('list');
		$jurisdicciones = $this->FondoTemporal->Jurisdiccion->find('list');
		$lineasDeAcciones = $this->FondoTemporal->LineasDeAccion->find('list');
		$this->set(compact('instits','jurisdicciones','lineasDeAcciones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for FondoTemporal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FondoTemporal->del($id)) {
			$this->Session->setFlash(__('FondoTemporal deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


        function suma_filas() {
		$this->FondoTemporal->recursive = 0;
		$this->set('fondos', $this->paginate());
	}

}
?>