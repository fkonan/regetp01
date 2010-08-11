<?php
class JurisdiccionesEstructuraPlanesController extends AppController {

	var $name = 'JurisdiccionesEstructuraPlanes';
	var $helpers = array('Html', 'Form');

	function index($id = null) {
                $notIn = array();
                $trayectos_asignados = array();
                $trayectos_restantes = array();
                
		$this->JurisdiccionesEstructuraPlan->recursive = 0;

               
                if (!empty($this->data['JurisdiccionesEstructuraPlan'])) {
                    $this->JurisdiccionesEstructuraPlan->deleteAll(array('JurisdiccionesEstructuraPlan.jurisdiccion_id ='. $this->data['jurisdiccion_id']));
                    if(!empty($this->data['JurisdiccionesEstructuraPlan'])){
                        foreach($this->data['JurisdiccionesEstructuraPlan'] as $trayecto){
                            if($trayecto['asignado'] == 1){
                                $this->JurisdiccionesEstructuraPlan->create();
                                $trayectoJur = array("JurisdiccionesEstructuraPlan"=>array("jurisdiccion_id"=>$this->data['jurisdiccion_id'], "trayecto_id"=>$trayecto['trayecto_id']));
                                $this->JurisdiccionesEstructuraPlan->save($trayectoJur);
                            }

                        }
                     
                    }
                    $this->redirect(array('action' => 'index',$this->data['jurisdiccion_id']));
                }



                $trayectos_asignados = $this->JurisdiccionesEstructuraPlan->find('all', array(
                                                                            'contain'=> array(
                                                                                'Trayecto'=>array('TrayectoAnio'=>array('Etapa', 'order'=> array('TrayectoAnio.edad_teorica')))
                                                                            ),
                                                                            'conditions'=> array(
                                                                                array('JurisdiccionesEstructuraPlan.jurisdiccion_id' => $id)
                                                                            )
                                                                        ));
                if(!empty($trayectos_asignados)){

                    foreach($trayectos_asignados as $trayecto){
                        array_push($notIn, $trayecto['Trayecto']['id']);
                    }

                    $trayectos_restantes = $this->JurisdiccionesEstructuraPlan->Trayecto->find('all', array(
                                                                                            'contain'=> array(
                                                                                                'TrayectoAnio'=>array('Etapa', 'order'=> array('TrayectoAnio.edad_teorica'))
                                                                                            ),
                                                                                            'conditions'=> array('NOT'=>array("Trayecto.id" => $notIn)),
                                                                                    ));

                }
                else{
                    $trayectos_restantes = $this->JurisdiccionesEstructuraPlan->Trayecto->find('all', array(
                                                                                            'contain'=> array(
                                                                                                'TrayectoAnio'=>array('Etapa', 'order'=> array('TrayectoAnio.edad_teorica'))
                                                                                            )
                                                                                    ));

                }
                
                $this->set('trayectos_asignados', $trayectos_asignados);
                $this->set('trayectos_restantes', $trayectos_restantes);
                $this->set('jurisdiccion_id', $id);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid JurisdiccionesEstructuraPlan.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('jurisdiccionesEstructuraPlan', $this->JurisdiccionesEstructuraPlan->read(null, $id));
	}

	function add($jurisdiccion_id = null) {
		if (!empty($this->data)) {
			$this->JurisdiccionesEstructuraPlan->create();
			if ($this->JurisdiccionesEstructuraPlan->save($this->data)) {
				$this->Session->setFlash(__('The JurisdiccionesEstructuraPlan has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JurisdiccionesEstructuraPlan could not be saved. Please, try again.', true));
			}
		}
                if (!empty($jurisdiccion_id)){
                    $this->data['JurisdiccionesEstructuraPlan']['jurisdiccion_id'] = $jurisdiccion_id;
                }
		$jurisdicciones = $this->JurisdiccionesEstructuraPlan->Jurisdiccion->find('list');
		$trayectos = $this->JurisdiccionesEstructuraPlan->Trayecto->find('list');
		$this->set(compact('jurisdicciones', 'trayectos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid JurisdiccionesEstructuraPlan', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->JurisdiccionesEstructuraPlan->save($this->data)) {
				$this->Session->setFlash(__('The JurisdiccionesEstructuraPlan has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JurisdiccionesEstructuraPlan could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JurisdiccionesEstructuraPlan->read(null, $id);
		}
		$jurisdicciones = $this->JurisdiccionesEstructuraPlan->Jurisdiccion->find('list');
		$trayectos = $this->JurisdiccionesEstructuraPlan->Trayecto->find('list');
		$this->set(compact('jurisdicciones','trayectos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for JurisdiccionesEstructuraPlan', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JurisdiccionesEstructuraPlan->del($id)) {
			$this->Session->setFlash(__('JurisdiccionesEstructuraPlan deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>