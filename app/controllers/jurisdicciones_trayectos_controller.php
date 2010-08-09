<?php
class JurisdiccionesTrayectosController extends AppController {

	var $name = 'JurisdiccionesTrayectos';
	var $helpers = array('Html', 'Form');

	function index($id = null) {
                $notIn = array();
                $trayectos_asignados = array();
                $trayectos_restantes = array();
                
		$this->JurisdiccionesTrayecto->recursive = 0;

               
                if (!empty($this->data['JurisdiccionesTrayecto'])) {
                    $this->JurisdiccionesTrayecto->deleteAll(array('JurisdiccionesTrayecto.jurisdiccion_id ='. $this->data['jurisdiccion_id']));
                    if(!empty($this->data['JurisdiccionesTrayecto'])){
                        foreach($this->data['JurisdiccionesTrayecto'] as $trayecto){
                            if($trayecto['asignado'] == 1){
                                $this->JurisdiccionesTrayecto->create();
                                $trayectoJur = array("JurisdiccionesTrayecto"=>array("jurisdiccion_id"=>$this->data['jurisdiccion_id'], "trayecto_id"=>$trayecto['trayecto_id']));
                                $this->JurisdiccionesTrayecto->save($trayectoJur);
                            }

                        }
                     
                    }
                    $this->redirect(array('action' => 'index',$this->data['jurisdiccion_id']));
                }



                $trayectos_asignados = $this->JurisdiccionesTrayecto->find('all', array(
                                                                            'contain'=> array(
                                                                                'Trayecto'=>array('TrayectoAnio'=>array('Etapa', 'order'=> array('TrayectoAnio.edad_teorica')))
                                                                            ),
                                                                            'conditions'=> array(
                                                                                array('JurisdiccionesTrayecto.jurisdiccion_id' => $id)
                                                                            )
                                                                        ));
                if(!empty($trayectos_asignados)){

                    foreach($trayectos_asignados as $trayecto){
                        array_push($notIn, $trayecto['Trayecto']['id']);
                    }

                    $trayectos_restantes = $this->JurisdiccionesTrayecto->Trayecto->find('all', array(
                                                                                            'contain'=> array(
                                                                                                'TrayectoAnio'=>array('Etapa', 'order'=> array('TrayectoAnio.edad_teorica'))
                                                                                            ),
                                                                                            'conditions'=> array('NOT'=>array("Trayecto.id" => $notIn)),
                                                                                    ));

                }
                else{
                    $trayectos_restantes = $this->JurisdiccionesTrayecto->Trayecto->find('all', array(
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