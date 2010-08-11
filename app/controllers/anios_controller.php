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

	function add($plan_id = null,$duracion_hs = null) {
		if(!empty($this->data['Anio']['plan_id'])){
			$plan_id = $this->data['Anio']['plan_id'];
		}
	
		$this->layout='popup';
		if (!empty($this->data)) {
			$this->Anio->create();
			if ($this->Anio->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado un nuevo año', true));
				$this->set('script','<script type="text/javascript">window.opener.location.reload();window.close();</script>">');
				return 0;
			} else {
				$this->Session->setFlash(__('Intente de nuevo.', true));
			}
		}
		
		//$planes = $this->Anio->Plan->find('list');
		$ciclos = $this->Anio->Ciclo->find('list');
		$etapas = $this->Anio->Etapa->find('list');

                $trayectosDisponibles = $this->Anio->EstructuraPlanesAnio->find('list');
                debug($trayectosDisponibles);

		$this->set('plan_id',$plan_id);
		$this->set('duracion_hs',$duracion_hs);
		$this->set(compact('planes', 'ciclos', 'etapas'));
		
		/**
         * esto es para generar una vista distinta
         * para los años que son de una oferta FP
         */
        $this->Anio->Plan->recursive = -1;
        $plan   = $this->Anio->Plan->find('all',array('conditions'=>array('Plan.id'=>$plan_id)));
        switch ($plan[0]['Plan']['oferta_id']):
			case 1://es un FP, asique mostrar la vista de años para FP
			case 7://es CL, asique mostrar la vista de años para FP	
	            $this->render('/anios/add_fp');
	            break;
			case 2: // IT
			case 3: //MT
   		    case 5: //SEC NO TECNICO
				$this->render('/anios/add');
	            break;
	        case 6: //SUP NO TECNICO
			case 4: //SNU
				$this->render('/anios/add_snu');
	            break;
	        default: // si no va con ninguno mostrar el de MT
	        	$this->render('/anios/add');
	            break;
        endswitch;		
	}

	function edit($id = null) {		
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Invalid Anio', true));
        	$this->redirect(array('action'=>'index'));
            }

            $this->layout='popup';

            if (!empty($this->data)) {
                    if ($this->Anio->save($this->data)) {
                $this->Session->setFlash(__('El año ha sido guardado', true));
                $this->set('script','<script type="text/javascript">window.opener.location.reload();window.close();</script>">');
                    } else {
                            $this->Session->setFlash(__('El año no pudo ser guardado. Por favor, intente nuevamente.', true));
                            }
            }
            if (empty($this->data)) {
                    $this->data = $this->Anio->read(null, $id);
                }
            //$planes = $this->Anio->Plan->find('list');
            $ciclos = $this->Anio->Ciclo->find('list');

                    /**
             * esto es para generar una vista distinta
             * para los años que son de una oferta FP
                     * y jurisdiccion_id para etapas (Pablo)
             */
            $this->Anio->Plan->recursive = -1;
            $plan   = $this->Anio->Plan->find('all', array(
                        'conditions'=>array('Plan.id'=>$this->data['Anio']['plan_id']),
                        'contain'=>array('Instit')
                    ));

             //$etapas = $this->Anio->Etapa->find('list');
            $etapas = $this->Anio->Etapa->etapas_de_jurisdiccion($plan[0]['Instit']['jurisdiccion_id']);

            $this->set(compact('planes','ciclos','etapas'));
            
            switch ($plan[0]['Plan']['oferta_id']):
                            case 1://es un FP, asique mostrar la vista de años para FP
                            case 7://es CL, asique mostrar la vista de años para FP
                        $this->render('/anios/edit_fp');
                        break;
                            case 2: // IT
                            case 3: //MT
                            case 5: //SEC NO TECNICO
                                    $this->render('/anios/edit');
                        break;
                            case 4: //SNU
                            case 6: //SUP NO TECNICO
                                    $this->render('/anios/edit_snu');
                        break;
                    default: // si no va con ninguno mostrar el de MT
                            $this->render('/anios/add');
                        break;
            endswitch;
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