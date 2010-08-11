<?php
class EstructuraPlanesController extends AppController {

	var $name = 'EstructuraPlanes';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->EstructuraPlan->recursive = 0;
		$this->set('estructuraPlanes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid EstructuraPlan.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('estructuraPlan', $this->EstructuraPlan->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
                    $this->EstructuraPlan->create();

                    // etapas del EstructuraPlan
                    //$str = '[{"etapa_id":"6","edad_teorica":"11","anio":"1","anio_escolaridad":""},{"etapa_id":"6","edad_teorica":"12","anio":"2","anio_escolaridad":""},{"etapa_id":"6","edad_teorica":"13","anio":"3","anio_escolaridad":""}]';
                    $aEtapas = json_decode($this->data['EstructuraPlan']['etapas'], true);

                    if ($this->EstructuraPlan->save($this->data)) {
                        // guarda el EstructuraPlan_id a cada etapa
                        if ($aEtapas) {
                            foreach ($aEtapas as &$etapa) {
                                $etapa['estructura_plan_id'] = $this->EstructuraPlan->id;
                            }
                            $this->EstructuraPlan->EstructuraPlanesAnio->saveAll($aEtapas);
                        }
                        $this->Session->setFlash(__('Se ha creado un nuevo EstructuraPlan', true));
                        $this->redirect(array('action'=>'index'));
                    } else {
                        $this->Session->setFlash(__('No se ha podido crear el EstructuraPlan. Por favor, intente nuevamente.', true));
                    }
		}
                
                $etapas = $this->EstructuraPlan->Etapa->find('list', array('order'=>'name'));
		$this->set(compact('etapas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid EstructuraPlan', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
                        // etapas del EstructuraPlan
                        //$str = '[{"etapa_id":"6","edad_teorica":"11","anio":"1","anio_escolaridad":""},{"etapa_id":"6","edad_teorica":"12","anio":"2","anio_escolaridad":""},{"etapa_id":"6","edad_teorica":"13","anio":"3","anio_escolaridad":""}]';
                        $aEtapas = json_decode($this->data['EstructuraPlan']['etapas'], true);

			if ($this->EstructuraPlan->save($this->data)) {
                            // elimina las etapas actuales
                            $this->EstructuraPlan->EstructuraPlanesAnio->deleteAll(array('EstructuraPlanesAnio.estructura_plan_id' => $id));
                            // guarda el estructura_plan_id a cada etapa
                            if ($aEtapas) {
                                foreach ($aEtapas as &$etapa) {
                                    $etapa['estructura_plan_id'] = $this->EstructuraPlan->id;
                                }
                            }
                            $this->EstructuraPlan->EstructuraPlanesAnio->saveAll($aEtapas);

                            $this->Session->setFlash(__('El EstructuraPlan ha sido guardado', true));
                            $this->redirect(array('action'=>'index'));
			} else {
                            $this->Session->setFlash(__('No se ha podido crear el EstructuraPlan. Por favor, intente nuevamente.', true));
			}
		}
		if (empty($this->data)) {
                        $this->EstructuraPlan->contain(array('EstructuraPlanesAnio.Etapa.name'));
			$this->data = $this->EstructuraPlan->read(null, $id);

                        // adjunta etapas en json
                        $i = 0;
                        foreach ($this->data['EstructuraPlanesAnio'] as $etapa) {
                            $etapas_to_serialize[$i]['estructura_plan_id'] = $etapa['estructura_plan_id'];
                            $etapas_to_serialize[$i]['edad_teorica'] = $etapa['edad_teorica'];
                            $etapas_to_serialize[$i]['anio'] = $etapa['anio'];
                            $etapas_to_serialize[$i]['etapa_id'] = $etapa['etapa_id'];
                            $etapas_to_serialize[$i]['etapa_nombre'] = htmlentities($etapa['Etapa']['name']);
                            $etapas_to_serialize[$i]['anio_escolaridad'] = $etapa['anio_escolaridad'];

                            $i++;
                        }

                        $etapas = @json_encode($etapas_to_serialize);
                        $this->data['EstructuraPlan']['etapas'] = $etapas;
		}

                $etapas = $this->EstructuraPlan->Etapa->find('list', array('order'=>'name'));
		$this->set(compact('etapas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for EstructuraPlan', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EstructuraPlan->del($id)) {
			$this->Session->setFlash(__('EstructuraPlan deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>