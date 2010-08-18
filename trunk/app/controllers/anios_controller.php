<?php
class AniosController extends AppController {

	var $name = 'Anios';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Anio->recursive = 0;
		$this->set('anios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Anio.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('anio', $this->Anio->read(null, $id));
	}


        /**
         * Guarda anios. Funciona tanto para el add como para el edit
         * 
         * @param integer $plan_id
         * @param <type> $duracion_hs Guarda los anios
         */
        function save($plan_id = null,$duracion_hs = null){
            if(!empty($this->data['Info']['plan_id'])){
                    $plan_id = $this->data['Info']['plan_id'];
            }

            if (!empty($this->data)) {
                    $ciclo_id = $this->data['Info']['ciclo_id'];
                    $this->Anio->create();
                    $aniosGuardar = array();
                    foreach ($this->data['Anio'] as &$anios){
                        $anios['ciclo_id'] = $ciclo_id;
                        $anios['plan_id'] = $plan_id;
                        $estruct = $this->Anio->EstructuraPlanesAnio->find('first', array(
                            'contain'=> array('EstructuraPlan.(etapa_id)'),
                            'conditions'=> array('EstructuraPlanesAnio.id'=> $anios['estructura_planes_anio_id']),
                            ));
                        $anios['anio'] = $estruct['EstructuraPlanesAnio']['nro_anio'];
                        $anios['etapa_id'] = $estruct['EstructuraPlan']['etapa_id'];
                        if (    !empty($anios['matricula']) ||
                                !empty($anios['secciones']) ||
                                !empty($anios['hs_taller'])) {
                            $aniosGuardar[] = $anios;
                        }

                    }
                    if ($this->Anio->saveAll($aniosGuardar)) {
                        $this->Session->setFlash(__('Se ha guardado un nuevo año', true));
                        $this->redirect('/planes/view/'.$plan_id);

                    } else {
                        //debug($this->Anio->validationErrors);
                        $this->Session->setFlash(__('Intente de nuevo. No se pudo guardar el dato.', true));
                        $this->redirect('/planes/view/'.$plan_id);
                    }
            }
        }

	function add($plan_id = null,$duracion_hs = null) {
            if(!empty($this->data['Info']['plan_id'])){
                    $plan_id = $this->data['Info']['plan_id'];
            }     
            
            $estructuraPlanId = $this->Anio->Plan->getEstructuraSugerida($plan_id);            
            $trayectosDisponibles = $this->Anio->EstructuraPlanesAnio->EstructuraPlan->find('first', array(
                'contain'=> array('EstructuraPlanesAnio'=>array('order'=>array('EstructuraPlanesAnio.edad_teorica'))),
                'conditions'=> array(
                    'EstructuraPlan.id'=>$estructuraPlanId),
            ));            
		
            /**
             * esto es para generar una vista distinta
             * para los años que son de una oferta FP
             */
            $this->Anio->Plan->recursive = -1;
            $plan   = $this->Anio->Plan->find('all',array('conditions'=>array('Plan.id'=>$plan_id)));
            switch ($plan[0]['Plan']['oferta_id']):
                case 1://es un FP, asique mostrar la vista de años para FP
                case 7://es CL, asique mostrar la vista de años para FP
                    $viewToRender = '/anios/add_fp';
                    break;
                case 2: // IT
                case 3: //MT
                case 5: //SEC NO TECNICO
                    $viewToRender = '/anios/add';
                    break;
                case 6: //SUP NO TECNICO
                case 4: //SNU
                    $viewToRender = '/anios/add_snu';
                    break;
                default: // si no va con ninguno mostrar el de MT
                    $viewToRender = '/anios/add';
                    break;
            endswitch;

            $this->set('trayectosDisponibles',$trayectosDisponibles);
            $this->set('plan_id',$plan_id);
            $this->set('duracion_hs',$duracion_hs);

            $ciclosTodos = $this->Anio->Ciclo->find('list');
            // solo los que aun no haya agregado informacion
            $ciclosUsados = $this->Anio->find('all',array(
                    'fields'=>array('Anio.ciclo_id'),
                    'conditions'=>array(
                        //'Anio.ciclo_id NOT'=>$ciclosTodos,
                        'Anio.plan_id'=>$plan_id),
                    'group'=>array('Anio.ciclo_id', 'Anio.plan_id'),
                    'order'=>array('Anio.ciclo_id'),
                        ));
            $ciclosTodos = $this->Anio->Ciclo->find('list', array());
            foreach ($ciclos as $c) {

            }
            
            $etapas = $this->Anio->Etapa->find('list');
            $this->set(compact('planes', 'ciclos', 'etapas'));
            $this->render($viewToRender);
	}

	function edit($id = null) {
            $aPlan = $this->Anio->find('first', array(
                'conditions'=>array('Anio.id'=>$id),
                'fields'=>array('Anio.plan_id')));
            debug($aPlan);
            $plan_id = $aPlan['Anio']['plan_id'];

            
            if(!empty($this->data['Info']['plan_id'])){
                    $plan_id = $this->data['Info']['plan_id'];
            }

            $estructuraPlanId = $this->Anio->Plan->getEstructuraSugerida($plan_id);
            $trayectosDisponibles = $this->Anio->EstructuraPlanesAnio->EstructuraPlan->find('first', array(
                'contain'=> array('EstructuraPlanesAnio'=>array('order'=>array('EstructuraPlanesAnio.edad_teorica'))),
                'conditions'=> array(
                    'EstructuraPlan.id'=>$estructuraPlanId),
            ));

            /**
             * esto es para generar una vista distinta
             * para los años que son de una oferta FP
             */
            $this->Anio->Plan->recursive = -1;
            $plan   = $this->Anio->Plan->find('all',array('conditions'=>array('Plan.id'=>$plan_id)));
            switch ($plan[0]['Plan']['oferta_id']):
                case 1://es un FP, asique mostrar la vista de años para FP
                case 7://es CL, asique mostrar la vista de años para FP
                    $viewToRender = '/anios/edit_fp';
                    break;
                case 2: // IT
                case 3: //MT
                case 5: //SEC NO TECNICO
                    $viewToRender = '/anios/edit';
                    break;
                case 6: //SUP NO TECNICO
                case 4: //SNU
                    $viewToRender = '/anios/edit_snu';
                    break;
                default: // si no va con ninguno mostrar el de MT
                    $viewToRender = '/anios/edit';
                    break;
            endswitch;

            $this->set('trayectosDisponibles',$trayectosDisponibles);
            $this->set('plan_id',$plan_id);
            //$this->set('duracion_hs',$duracion_hs);

            $ciclos = $this->Anio->Ciclo->find('list');
            $etapas = $this->Anio->Etapa->find('list');
            $this->set(compact('planes', 'ciclos', 'etapas'));
            $this->render($viewToRender);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id de Año inválido', true));
			$this->redirect(array('controller'=>'Pages','action'=>'default'));
		}
		
		$this->Anio->recursive = -1;
		$plan = $this->Anio->read('plan_id',$id);
		if ($this->Anio->del($id)) {
	
			$this->Session->setFlash(__('Año eliminado', true));
			$this->redirect(array('controller'=>'Planes' ,'action'=>'view/'.$plan['Anio']['plan_id']));
		}
	}

}
?>