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

                    // etapas del trayecto
                    //$str = '[{"etapa_id":"6","edad_teorica":"11","anio":"1","anio_escolaridad":""},{"etapa_id":"6","edad_teorica":"12","anio":"2","anio_escolaridad":""},{"etapa_id":"6","edad_teorica":"13","anio":"3","anio_escolaridad":""}]';
                    $aEtapas = json_decode($this->data['Trayecto']['etapas'], true);

                    if ($this->Trayecto->save($this->data)) {
                        // guarda el trayecto_id a cada etapa
                        if ($aEtapas) {
                            foreach ($aEtapas as &$etapa) {
                                $etapa['trayecto_id'] = $this->Trayecto->id;
                            }
                            $this->Trayecto->TrayectoAnio->saveAll($aEtapas);
                        }
                        $this->Session->setFlash(__('Se ha creado un nuevo Trayecto', true));
                        $this->redirect(array('action'=>'index'));
                    } else {
                        $this->Session->setFlash(__('No se ha podido crear el Trayecto. Por favor, intente nuevamente.', true));
                    }
		}
                
                $etapas = $this->Trayecto->TrayectoAnio->Etapa->find('list', array('order'=>'name'));
		$this->set(compact('etapas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Trayecto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
                        // etapas del trayecto
                        //$str = '[{"etapa_id":"6","edad_teorica":"11","anio":"1","anio_escolaridad":""},{"etapa_id":"6","edad_teorica":"12","anio":"2","anio_escolaridad":""},{"etapa_id":"6","edad_teorica":"13","anio":"3","anio_escolaridad":""}]';
                        $aEtapas = json_decode($this->data['Trayecto']['etapas'], true);

			if ($this->Trayecto->save($this->data)) {
                            // elimina las etapas actuales
                            $this->Trayecto->TrayectoAnio->deleteAll(array('TrayectoAnio.trayecto_id' => $id));
                            // guarda el trayecto_id a cada etapa
                            if ($aEtapas) {
                                foreach ($aEtapas as &$etapa) {
                                    $etapa['trayecto_id'] = $this->Trayecto->id;
                                }
                            }
                            $this->Trayecto->TrayectoAnio->saveAll($aEtapas);

                            $this->Session->setFlash(__('El Trayecto ha sido guardado', true));
                            $this->redirect(array('action'=>'index'));
			} else {
                            $this->Session->setFlash(__('No se ha podido crear el Trayecto. Por favor, intente nuevamente.', true));
			}
		}
		if (empty($this->data)) {
                        $this->Trayecto->contain(array('TrayectoAnio.Etapa.name'));
			$this->data = $this->Trayecto->read(null, $id);

                        // adjunta etapas en json
                        $i = 0;
                        foreach ($this->data['TrayectoAnio'] as $etapa) {
                            $etapas_to_serialize[$i]['trayecto_id'] = $etapa['trayecto_id'];
                            $etapas_to_serialize[$i]['edad_teorica'] = $etapa['edad_teorica'];
                            $etapas_to_serialize[$i]['anio'] = $etapa['anio'];
                            $etapas_to_serialize[$i]['etapa_id'] = $etapa['etapa_id'];
                            $etapas_to_serialize[$i]['etapa_nombre'] = htmlentities($etapa['Etapa']['name']);
                            $etapas_to_serialize[$i]['anio_escolaridad'] = $etapa['anio_escolaridad'];

                            $i++;
                        }

                        $etapas = @json_encode($etapas_to_serialize);
                        $this->data['Trayecto']['etapas'] = $etapas;
		}

                $etapas = $this->Trayecto->TrayectoAnio->Etapa->find('list', array('order'=>'name'));
		$this->set(compact('etapas'));
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