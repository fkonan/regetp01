<?php
class InstitsController extends AppController {

	var $name = 'Instits';
	var $helpers = array('Html', 'Form','Ajax');
	var $paginate = array('order'=>array('Instit.cue' => 'asc'),'limit'=>'10'); 

	function beforeFilter(){
		parent::beforeFilter();
		$this->rutaUrl_for_layout[] =array('name'=> 'Buscador','link'=>'/Instits/search_form' );
	}
	
	function index() {		
		$this->Instit->recursive = 0;
		$this->set('instits', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Institución Inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$instit = $this->Instit->read(null, $id);
		
		// me fijo si todos los planes son 
		// IT entonces la instit es con programa de ETP
		$instit_etp = false;
		foreach ($instit['Plan'] as $p):
			if ($val = ($p['oferta_id'] == 2)){ // == 2 -> IT
				$instit_etp = true; 
			}
			else{
				$instit_etp = false;
				break;
			}
		endforeach;
		$this->set('instit_etp', $instit_etp);
		$this->set('instit', $instit);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Instit->create();
			if ($this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
				$this->redirect(array('action'=>'view/'.$this->Instit->id));
			} else {
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}
		$gestiones = $this->Instit->Gestion->find('list',array('order'=>'id ASC'));
		$dependencias = $this->Instit->Dependencia->find('list');
				
		$tipoinstits = $this->Instit->Tipoinstit->find('list',array('order'=>'Tipoinstit.name'));
		
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list',array('order'=>'name'));
		$departamentos = $this->Instit->Departamento->find('list',array('order'=>'name'));
		$localidades = $this->Instit->Localidad->find('list',array('order'=>'name'));
		$this->set(compact('gestiones','dependencias','tipoinstits','jurisdicciones','departamentos','localidades'));
		$this->set(compact('gestiones', 'dependencias', 'tipoinstits', 'jurisdicciones'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Instit', true));
			$this->redirect(array('action'=>'search_form'));
		}
		
		if (!empty($this->data)) {
			if ($this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
				$this->redirect(array("action"=>"view/$id"));
			} else {
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Instit->read(null, $id);
			
			//le pongo el valor vacio para que la vista muestre vacio. Luego el beforeSave se va a encargar d eagregarle un CERO para que cumpla con el NOT NULL de la BD
			if(isset($this->data['Instit']['anio_creacion']) && $this->data['Instit']['anio_creacion'] == 0){
				$this->data['Instit']['anio_creacion'] = '';
			}
		}
		
		$gestiones = $this->Instit->Gestion->find('list');
		$dependencias = $this->Instit->Dependencia->find('list');
		
		$tipoinstits = $this->Instit->Tipoinstit->find('list',array('conditions'=>'Tipoinstit.jurisdiccion_id = '.$this->data['Instit']['jurisdiccion_id'],'order'=>'Tipoinstit.name'));
		
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		$departamentos = $this->Instit->Departamento->find('list',array('order'=>'name','conditions'=>array('jurisdiccion_id'=>$this->data['Instit']['jurisdiccion_id'])));
		$localidades = $this->Instit->Localidad->find('list',array('order'=>'name'));
		$this->set(compact('gestiones','dependencias','tipoinstits','jurisdicciones','departamentos','localidades'));
		$this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$id );
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Se ha pasado un id que no existe para esa Institución', true));
			
		}
		if ($this->Instit->del($id)) {
			$this->Session->setFlash(__('Se ha eliminado la Institución correctamente', true));
			$this->redirect(array('controller'=>'pages', 'action'=>'home'));
		}
	}
	
	/**
	 * Esta accion maneja el formulario de busqueda 
	 * que sera impreso por pantalla
	 *
	 */
	function search_form(){		
		if (!empty($this->data)) {
			$this->redirect('search');
		}
		
		$gestiones = $this->Instit->Gestion->find('list');
		$dependencias = $this->Instit->Dependencia->find('list');
		$tipoinstits = $this->Instit->Tipoinstit->find('list');
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		$ofertas = $this->Instit->Plan->Oferta->find('list');
		$this->set(compact('gestiones', 'dependencias', 'tipoinstits', 'jurisdicciones','ofertas'));
	}
	
	/**
	 * Esta accion es el procesamiento del formulario de busqueda
	 * maneja las condiciones de la busqueda y el paginador
	 *
	 */
	function search(){
         //para mostrar en vista los patrones de busqueda seleccionados
		$array_condiciones = array();

		// para el paginator que pueda armar la url
		$url_conditions = array();

		
		// si no vinieron datos GET, asumo que se envió el formulario desde search_form
		if(isset($this->passedArgs)):		
			if(sizeof($this->passedArgs) == 0):
				$vino_formulario = 1;
			else:
				$vino_formulario = 0;
			endif;			
		else: 
			$vino_formulario = 1;
		endif;
		
		
		//$this->Instit->unbindModelosInnecesarios();

		/**
		 *    INICIALIZACION DE FILTROS
		 * 
		 *   Los filtros pueden provenir del formulario o de las variables de paginacion.
		 *  
		 * 	Para el primer caso se esta leyendo informacion de $this->data
		 * 	en el segundo caso de this->passedArgs
		 * 
		 * 
		 */
		
		
			/**
			 *     CUE
			 */
            if(isset($this->data['Instit']['cue'])){
            	 if($this->data['Instit']['cue'] != '' || $this->data['Instit']['cue'] != 0 ){
            	 	if($this->Instit->isCUEValid($this->data['Instit']['cue'])<0){
            	 		$this->Session->setFlash("El CUE: '".$this->data['Instit']['cue']."' no es válido. <cite style='font-size: 12px'>Recuerde no ingresar el N° de Anexo</cite>");
            	 		$this->redirect('search_form');
            	 	}
                    // set the conditions
                    $this->paginate['conditions']['Instit.cue'] = $this->data['Instit']['cue'];
                     // set the Search data, so the form remembers the option
                  	$array_condiciones['CUE'] = $this->data['Instit']['cue'];
                  	$url_conditions['cue'] = $this->data['Instit']['cue'];
            	 }
            }
			if(isset($this->passedArgs['cue'])){	
            	 if($this->passedArgs['cue'] != '' || $this->passedArgs['cue'] != 0 ){
                    // set the conditions
                    $this->paginate['conditions']['Instit.cue'] = $this->passedArgs['cue'];
                     // set the Search data, so the form remembers the option
                  	$array_condiciones['CUE'] = $this->passedArgs['cue'];
                  	$url_conditions['cue'] = $this->passedArgs['cue'];
            	 }
            }
            
            
            
			/**
			 *     Nro Institucion
			 */  
			if($this->data['Instit']['nroinstit'] != ''){
				$this->paginate['conditions']['lower(Instit.nroinstit) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->data['Instit']['nroinstit']));
				$array_condiciones['N° de Institución'] = $this->data['Instit']['nroinstit'];
				$url_conditions['nroinstit'] = $this->data['Instit']['nroinstit'];			
			}
			if(isset($this->passedArgs['nroinstit'])){	
            	if($this->passedArgs['nroinstit'] != ''){
					$this->paginate['conditions']['lower(Instit.nroinstit) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['nroinstit'])));
					$array_condiciones['N° de Institución'] = utf8_decode($this->passedArgs['nroinstit']);
					$url_conditions['nroinstit'] = utf8_decode($this->passedArgs['nroinstit']);			
				}
            }
            
            
            
            
			/**
			 *     JURISDICCION
			 */
			if($this->data['Instit']['jurisdiccion_id'] != ''){
				if((int)$this->data['Instit']['jurisdiccion_id'] == 0){
					$basura = 1;
				}
				else{
					$this->paginate['conditions']['Instit.jurisdiccion_id'] = $this->data['Instit']['jurisdiccion_id'];
					$this->Instit->Jurisdiccion->recursive = -1;
					$jurisdiccion = $this->Instit->Jurisdiccion->findById($this->data['Instit']['jurisdiccion_id']);
					$array_condiciones['Jurisdicción'] = $jurisdiccion['Jurisdiccion']['name'];
					$url_conditions['jurisdiccion_id'] = $this->data['Instit']['jurisdiccion_id'];					
				}			
			}
		 	if(isset($this->passedArgs['jurisdiccion_id'])){	
            	if($this->passedArgs['jurisdiccion_id'] != '' || $this->passedArgs['jurisdiccion_id'] != 0){
            		if((int)$this->passedArgs['jurisdiccion_id'] == 0){
						$basura = 1;
					}
					else{
					$this->paginate['conditions']['Instit.jurisdiccion_id'] = $this->passedArgs['jurisdiccion_id'];
					$this->Instit->Jurisdiccion->recursive = -1;
					$aux = $this->Instit->Jurisdiccion->findById($this->passedArgs['jurisdiccion_id']);
					$array_condiciones['Jurisdicción'] = $aux['Jurisdiccion']['name'];
					$url_conditions['jurisdiccion_id'] = $this->passedArgs['jurisdiccion_id'];
					}			
				}
            }

			/**
			 *     TIPO INSTIT 
			 */
			if(isset($this->data['Instit']['tipoinstit_id'])){
		       	if($this->data['Instit']['tipoinstit_id'] != '' || $this->data['Instit']['tipoinstit_id'] != 0){
			       	if((int)$this->data['Instit']['tipoinstit_id'] == 0){
						$basura = 1;
					}else{
						if( $this->data['Instit']['tipoinstit_id'] != '' || $this->data['Instit']['tipoinstit_id'] != 0){
			                $this->paginate['conditions']['Instit.tipoinstit_id'] = $this->data['Instit']['tipoinstit_id'];
							$this->Instit->Tipoinstit->recursive = -1;
			                $aux = $this->Instit->Tipoinstit->findById($this->data['Instit']['tipoinstit_id']);
							$array_condiciones['Tipo Institución'] = $aux['Tipoinstit']['name'];
							$url_conditions['tipoinstit_id'] = $this->data['Instit']['tipoinstit_id'];		
						}
					}
		       	}
		    }
	 		if(isset($this->passedArgs['tipoinstit_id'])){
            	if($this->passedArgs['tipoinstit_id'] != '' || $this->passedArgs['tipoinstit_id'] != 0){
            		if((int)$this->passedArgs['tipoinstit_id'] == 0){
						$basura = 1;
					}
					else{
						if($this->passedArgs['tipoinstit_id'] != '' || $this->passedArgs['tipoinstit_id'] != 0){
			                $this->paginate['conditions']['Instit.tipoinstit_id'] = $this->passedArgs['tipoinstit_id'];
							$this->Instit->Tipoinstit->recursive = -1;
			                $aux = $this->Instit->Tipoinstit->findById($this->passedArgs['tipoinstit_id']);
							$array_condiciones['Tipo Institución'] = $aux['Tipoinstit']['name'];
							$url_conditions['tipoinstit_id'] = $this->passedArgs['tipoinstit_id'];		
						}
					}
            	}
            }
            
            
            
			/**
			 *     NOMBRE
			 */
			if($this->data['Instit']['nombre'] != ''){
				$this->paginate['conditions']['to_ascii(lower(Instit.nombre)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->data['Instit']['nombre']));
				$array_condiciones['Nombre'] = $this->data['Instit']['nombre'];
				$url_conditions['nombre'] = $this->data['Instit']['nombre'];			
			}
			if(isset($this->passedArgs['nombre'])){	
            	if($this->passedArgs['nombre'] != ''){
					$this->paginate['conditions']['to_ascii(lower(Instit.nombre)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['nombre'])));
					$array_condiciones['Nombre'] = utf8_decode($this->passedArgs['nombre']);
					$url_conditions['nombre'] = utf8_decode($this->passedArgs['nombre']);			
				}
            }
			/**
			 *     DIRECCION
			 */
			if($this->data['Instit']['direccion'] != ''){
				$this->paginate['conditions']['lower(to_ascii(Instit.direccion)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->data['Instit']['direccion']));
				$array_condiciones['Domicilio'] = $this->data['Instit']['direccion'];			
				$url_conditions['direccion'] = $this->data['Instit']['direccion'];
			}
			if(isset($this->passedArgs['direccion'])){	
            			if($this->passedArgs['direccion'] != ''){
					$this->paginate['conditions']['lower(to_ascii(Instit.direccion)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['direccion'])));
					$array_condiciones['Domicilio'] = utf8_decode($this->passedArgs['direccion']);			
					$url_conditions['direccion'] = utf8_decode($this->passedArgs['direccion']);
				}
			}	
			/**
			 *     LOCALIDAD
			 */
			if($this->data['Localidad']['name'] != ''){
				$this->paginate['conditions']['lower(Localidad.name) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->data['Localidad']['name']));
				$array_condiciones['Localidad'] = $this->data['Localidad']['name'];
				$url_conditions['Localidad.name'] = $this->data['Localidad']['name'];			
			}
			if(isset($this->passedArgs['Localidad.name'])){	
            	if($this->passedArgs['Localidad.name'] != ''){
					$this->paginate['conditions']['lower(Localidad.name) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['Localidad.name'])));
					$array_condiciones['Localidad'] = utf8_decode($this->passedArgs['Localidad.name']);
					$url_conditions['Localidad.name'] = utf8_decode($this->passedArgs['Localidad.name']);			
				}
            }
            
			/**
			 *     DEPARTAMENTO
			 */
			if($this->data['Departamento']['name'] != ''){
				$this->paginate['conditions']['lower(to_ascii(Departamento.name)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->data['Departamento']['name']));
				$array_condiciones['Departamento'] = $this->data['Departamento']['name'];
				$url_conditions['Departamento.name'] = $this->data['Departamento']['name'];			
			}
			if(isset($this->passedArgs['Departamento.name'])){	
            	if($this->passedArgs['Departamento.name'] != ''){
					$this->paginate['conditions']['lower(to_ascii(Departamento.name)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['Departamento.name'])));
					$array_condiciones['Departamento'] = utf8_decode($this->passedArgs['Departamento.name']);
					$url_conditions['Departamento.name'] = utf8_decode($this->passedArgs['Departamento.name']);			
				}
            }
            
            
			/**
			 *     GESTION 
			 */
			if($this->data['Instit']['gestion_id'] != ''){
				$this->paginate['conditions']['Instit.gestion_id'] = $this->data['Instit']['gestion_id'];
				$this->Instit->Gestion->recursive = -1;
				$aux = $this->Instit->Gestion->findById($this->data['Instit']['gestion_id']);
				$array_condiciones['Ámbito de Gestión'] = $aux['Gestion']['name'];
				$url_conditions['gestion_id'] = $this->data['Instit']['gestion_id'];
			}
			if(isset($this->passedArgs['gestion_id'])){
				if($this->passedArgs['gestion_id'] != ''){
					$this->paginate['conditions']['Instit.gestion_id'] = $this->passedArgs['gestion_id'];
					$this->Instit->Gestion->recursive = -1;
					$aux = $this->Instit->Gestion->findById($this->passedArgs['gestion_id']);
					$array_condiciones['Ámbito de Gestión'] = $aux['Gestion']['name'];
					$url_conditions['gestion_id'] = $this->passedArgs['gestion_id'];
				}
			}		
		
			/**
			 *     DEPENDENCIA 
			 */
			if($this->data['Instit']['dependencia_id'] != ''){
				$this->paginate['conditions']['Instit.dependencia_id'] = $this->data['Instit']['dependencia_id'];
				$this->Instit->Dependencia->recursive = -1;
				$aux = $this->Instit->Dependencia->findById($this->data['Instit']['dependencia_id']);
				$array_condiciones['Dependencia'] = $aux['Dependencia']['name'];
				$url_conditions['dependencia_id'] = $this->data['Instit']['dependencia_id'];
			}
			if(isset($this->passedArgs['dependencia_id'])){
				if($this->passedArgs['dependencia_id'] != ''){
					$this->paginate['conditions']['Instit.dependencia_id'] = $this->passedArgs['dependencia_id'];
					$this->Instit->Dependencia->recursive = -1;
					$aux = $this->Instit->Dependencia->findById($this->passedArgs['dependencia_id']);
					$array_condiciones['Dependencia'] = $aux['Dependencia']['name'];
					$url_conditions['dependencia_id'] = $this->passedArgs['dependencia_id'];
				}
			}
			
			/**
			 *     ES ANEXO 
			 */
			if(isset($this->data['Instit']['esanexo'])){
				switch ((int)$this->data['Instit']['esanexo']):
					case -1: break;
					case 0:
					case 1:		
						$this->paginate['conditions']['Instit.esanexo'] = $this->data['Instit']['esanexo'];
						$aux = $this->data['Instit']['esanexo']? 'Si':'No';
						$array_condiciones['Es Anexo'] = $aux;
						$url_conditions['esanexo'] = $this->data['Instit']['esanexo'];
					break;
				endswitch;
			}
			if(isset($this->passedArgs['esanexo'])){
				switch ((int)$this->passedArgs['esanexo']):
					case -1: break;
					case 0:
					case 1:	
						$this->paginate['conditions']['Instit.esanexo'] = $this->passedArgs['esanexo'];
						$aux = $this->passedArgs['esanexo']? 'Si':'No';
						$array_condiciones['Es Anexo'] = $aux;
						$url_conditions['esanexo'] = $this->passedArgs['esanexo'];
					break;
				endswitch;
			}
			
			/**
			 *     ACTIVO 
			 */
			if(isset($this->data['Instit']['activo'])){
				switch ((int)$this->data['Instit']['activo']):
					case -1: break; // es el valor vacio. O sea, buscar por todos
					case 0: // inactivas
					case 1: //buscar activas				 
						$this->paginate['conditions']['Instit.activo'] = $this->data['Instit']['activo'];
						$aux = $this->data['Instit']['activo']? 'Si':'No';
						$array_condiciones['Ingresada al RFIETP'] = $aux;
						$url_conditions['activo'] = $this->data['Instit']['activo'];
				endswitch;
			}	
			if(isset($this->passedArgs['activo'])){
				switch ((int)$this->passedArgs['activo']):
					case -1: $basura = 1; break; // es el valor empty. O sea, buscar por todos
					case 0: //inactivas
					case 1: //activas								
						$this->paginate['conditions']['Instit.activo'] = $this->passedArgs['activo'];
						$aux = $this->passedArgs['activo']? 'Si':'No';
						$array_condiciones['Ingresada al RFIETP'] = $aux;
						$url_conditions['activo'] = $this->passedArgs['activo'];
					break;
				endswitch;
			}	
			
			
			/**
			 *    PLANES POR OFERTA
			 */
		if (isset($this->data['Plan']['oferta_id'])){
			if ($this->data['Plan']['oferta_id'] == ''){
				$basura = 1;
			}
			else{
				$this->Instit->recursive = 1;
				$this->Instit->unbindModel(array('hasMany'=>array('Plan'))); 
				$this->Instit->bindModel(array('hasOne'=>array('Plan'=>array())));
							
				$conditions = array('Plan.oferta_id' => $this->data['Plan']['oferta_id']);
				
				$fields = '"Instit"."id"';
				$group = '"Instit"."id"';
				
				$instituciones = $this->Instit->find('all', array(
					    'conditions' => array('Plan.oferta_id'=>$this->data['Plan']['oferta_id']),
					    'contain' => array('Plan'),
						'group' => 'Instit.id',
						'fields' => 'Instit.id'
					));
					
				$a = array();
				foreach ($instituciones as $i):
					$a[] = $i['Instit']['id'];
				endforeach;		
				if (sizeof($a)>0){	//si me trae resultados que me los pagine
					$this->paginate['conditions']['Instit.id'] =  $a;
				}
				else{
					$this->paginate['conditions']['Instit.id'] =  0;
				}	
				$this->Instit->Plan->Oferta->recursive = -1;
				$oferta = $this->Instit->Plan->Oferta->findById($this->data['Plan']['oferta_id']);			
				$array_condiciones['Con Oferta'] = $oferta['Oferta']['name'];
				$url_conditions['Plan.oferta_id'] = $this->data['Plan']['oferta_id'];
			}		
		}
		if(isset($this->passedArgs['Plan.oferta_id'])){
				$this->Instit->recursive = 1;
				$this->Instit->unbindModel(array('hasMany'=>array('Plan'))); 
				$this->Instit->bindModel(array('hasOne'=>array('Plan'=>array())));

				$conditions = array('Plan.oferta_id' => $this->passedArgs['Plan.oferta_id']);
				
				$fields = '"Instit"."id"';
				$group = '"Instit"."id"';
				
				$instituciones = $this->Instit->find('all', array(
					    'conditions' => array('Plan.oferta_id'=>$this->passedArgs['Plan.oferta_id']),
					    'contain' => array('Plan'),
						'group' => 'Instit.id',
						'fields' => 'Instit.id'
					));
					
				$a = array();
				foreach ($instituciones as $i):
					$a[] = $i['Instit']['id'];
				endforeach;			
	
				if (sizeof($a)>0){	//si me trae resultados que me los pagine
					$this->paginate['conditions']['Instit.id'] =  $a;
				}else{
					$this->paginate['conditions']['Instit.id'] =  0;
				}
				$this->Instit->Plan->Oferta->recursive = -1;	
				$oferta = $this->Instit->Plan->Oferta->findById($this->passedArgs['Plan.oferta_id']);			
				$array_condiciones['Con Oferta'] = $oferta['Oferta']['name'];
				$url_conditions['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];
		}
			
        /***********************************************************************/
			
	    $this->Instit->recursive = 1;//para alivianar la carga del server         
		
	    //datos de paginacion
	    $pagin = $this->paginate();
	    
	    //si se encontro solo 1 institucion, ir directamente a la vista de esa institucion
	    if(sizeof($pagin) == 1 && $vino_formulario){
	    	$this->redirect('view/'.$pagin[0]['Instit']['id']);	    	
	    }
	    
        $this->set('instits', $pagin);
       	
        $this->set('url_conditions', $url_conditions);
		
        //devuelve un array para mostrar los criterios de busqueda
        $this->set('conditions', $array_condiciones);
        
	}
	
	
	
	
		
	/**
	 * Action para mostrar los planes relacionados
	 *
	 * @param $instit_id
	 */
	function planes_relacionados($id = null){
		$v_plan_matricula = array();
		if (!$id) {
			$this->Session->setFlash(__('Institución Inválida.', true));
			$this->redirect(array('controller'=>'Istits','action'=>'view/'.$id));
		}
		
		//$this->Instit->order = 'Plan.oferta_id ASC';
		$this->data = $this->Instit->read(null,$id);
		if($this->data){
			$cont = 0;
			foreach ($this->data['Plan'] as $p):
				$v_plan_matricula[$cont] = $this->Instit->Plan->Anio->matricula_del_plan($p['id']);
				$v_plan_matricula[$cont]['ciclo'] = $this->Instit->Plan->Anio->ciclo_lectivo_matricula_del_plan($p['id']);
				$cont++;
			endforeach;
			
						
			
			$this->set('sumatoria_matriculas',$this->Instit->dameSumatoriaDeMatriculasPorOferta($id));
			
			$this->set('planes',$this->data);	
			$this->set('v_plan_matricula',$v_plan_matricula);
			$this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$this->data['Instit']['id'] );
		}		
	}
	
	
	
	
	/**
	 * Esto no es un ACTION, es una fuincion privada de esta clase, pero que en realidad deberia
	 * ser una funcion general ya que seguramente me interese usarla en otro controlador
	 * 
	 * Lo que hace es convertir una cadena en una expresion regular para 
	 * buscar el texto sin tener en cuenta los acentos y la eñe
	 *
	 * @param $text
	 */
	private function _convertir_para_busqueda_avanzada($text){		
		$text = strtolower($text);
		$text = "%$text%";
		$patron = array (
			// Espacios, puntos y comas por guion
			//'/[\., ]+/' => '-',
			
			// Vocales
			'/a/' => '(á|a|A|Á)',
			'/e/' => '(é|e|E|É)',
			'/i/' => '(í|i|I|Í)',
			'/o/' => '(ó|o|O|Ó)',
			'/u/' => '(ú|u|Ú|U)',
		
			'/A/' => '(á|a|A|Á)',
			'/E/' => '(é|e|E|É)',
			'/I/' => '(í|i|I|Í)',
			'/O/' => '(ó|o|O|Ó)',
			'/U/' => '(ú|u|Ú|U)',
		
			'/Á/' => '(á|a|A|Á)',
			'/É/' => '(é|e|E|É)',
			'/Í/' => '(í|i|I|Í)',
			'/Ó/' => '(ó|o|O|Ó)',
			'/Ú/' => '(ú|u|Ú|U)',
		
			'/á/' => '(á|a|A|Á)',
			'/é/' => '(é|e|E|É)',
			'/í/' => '(í|i|I|Í)',
			'/ó/' => '(ó|o|O|Ó)',
			'/ú/' => '(ú|u|Ú|U)',
			
			'/n/' => 'ñ',
			'/ñ/' => '(n|ñ)',
		
			'/s/' => '(z|s|c)',
			'/c/' => '(z|s|c)',
			'/z/' => '(z|s|c)'
 
			// Agregar aqui mas caracteres si es necesario
 
		);
		
		$text = preg_replace(array_keys($patron),array_values($patron),$text);
		return $text;		
	}
	
	function depurar(){		
		//debug($this->data);die();
		if (!empty($this->data)) {
			if ($valor = $this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
								
			} else {
				print_r($this->Instit->validationErrors);
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}			
		
		$conditions = array('Instit.activo'=>1,'Instit.departamento_id'=>0, 'Instit.localidad_id'=>0);
		
		$this->data =$this->Instit->find('first',array('conditions'=>$conditions,'order'=>'Instit.jurisdiccion_id DESC'));
		$total =$this->Instit->find('count',array('conditions'=>$conditions));
			
		//le pongo el valor vacio para que la vista muestre vacio. Luego el beforeSave se va a encargar d eagregarle un CERO para que cumpla con el NOT NULL de la BD
		if(isset($this->data['Instit']['anio_creacion']) && $this->data['Instit']['anio_creacion'] == 0){
			$this->data['Instit']['anio_creacion'] = '';
		}
		
		
		$tipoinstits = $this->Instit->Tipoinstit->find('list');
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		$departamentos = $this->Instit->Departamento->find('list',array('order'=>'name','conditions'=>array('jurisdiccion_id'=>$this->data['Instit']['jurisdiccion_id'])));
		$localidades = $this->Instit->Localidad->find('list',array('order'=>'name'));
		$this->set(compact('jurisdicciones','departamentos','localidades','tipoinstits'));	
		$this->set('falta_depurar',$total);
	}
	
	function prueba(){
		$this->Instit->recursive = 1;
		
		
		
		if (isset($this->data['Plan']['oferta_id'])){
			$this->Instit->unbindModel(array('hasMany'=>array('Plan'))); 
			$this->Instit->bindModel(array('hasOne'=>array('Plan'=>array())));
			
			$conditions = array('Plan.oferta_id' => $this->data['Plan']['oferta_id']);
			
			
			$fields = '"Instit"."id" AS "Instit__id", "Instit"."gestion_id" AS "Instit__gestion_id", "Instit"."dependencia_id" AS "Instit__dependencia_id", "Instit"."nombre_dep" AS "Instit__nombre_dep", "Instit"."tipoinstit_id" AS "Instit__tipoinstit_id", "Instit"."jurisdiccion_id" AS "Instit__jurisdiccion_id", "Instit"."cue" AS "Instit__cue", "Instit"."anexo" AS "Instit__anexo", "Instit"."esanexo" AS "Instit__esanexo", "Instit"."nombre" AS "Instit__nombre", "Instit"."nroinstit" AS "Instit__nroinstit", "Instit"."anio_creacion" AS "Instit__anio_creacion", "Instit"."direccion" AS "Instit__direccion", "Instit"."depto" AS "Instit__depto", "Instit"."localidad" AS "Instit__localidad", "Instit"."cp" AS "Instit__cp", "Instit"."telefono" AS "Instit__telefono", "Instit"."mail" AS "Instit__mail", "Instit"."web" AS "Instit__web", "Instit"."dir_nombre" AS "Instit__dir_nombre", "Instit"."dir_tipodoc_id" AS "Instit__dir_tipodoc_id", "Instit"."dir_nrodoc" AS "Instit__dir_nrodoc", "Instit"."dir_telefono" AS "Instit__dir_telefono", "Instit"."dir_mail" AS "Instit__dir_mail", "Instit"."vice_nombre" AS "Instit__vice_nombre", "Instit"."vice_tipodoc_id" AS "Instit__vice_tipodoc_id", "Instit"."vice_nrodoc" AS "Instit__vice_nrodoc", "Instit"."actualizacion" AS "Instit__actualizacion", "Instit"."observacion" AS "Instit__observacion", "Instit"."fecha_mod" AS "Instit__fecha_mod", "Instit"."activo" AS "Instit__activo", "Instit"."ciclo_alta" AS "Instit__ciclo_alta", "Instit"."ciclo_mod" AS "Instit__ciclo_mod", "Instit"."created" AS "Instit__created", "Instit"."modified" AS "Instit__modified", "Instit"."localidad_id" AS "Instit__localidad_id", "Instit"."departamento_id" AS "Instit__departamento_id", "Instit"."lugar" AS "Instit__lugar", "Gestion"."id" AS "Gestion__id", "Gestion"."name" AS "Gestion__name", "Dependencia"."id" AS "Dependencia__id", "Dependencia"."name" AS "Dependencia__name", "Tipoinstit"."id" AS "Tipoinstit__id", "Tipoinstit"."jurisdiccion_id" AS "Tipoinstit__jurisdiccion_id", "Tipoinstit"."name" AS "Tipoinstit__name", "Jurisdiccion"."id" AS "Jurisdiccion__id", "Jurisdiccion"."name" AS "Jurisdiccion__name", "Departamento"."id" AS "Departamento__id", "Departamento"."jurisdiccion_id" AS "Departamento__jurisdiccion_id", "Departamento"."name" AS "Departamento__name", "Localidad"."id" AS "Localidad__id", "Localidad"."departamento_id" AS "Localidad__departamento_id", "Localidad"."name" AS "Localidad__name"';
			$group = '"Instit"."id", "Instit"."gestion_id", "Instit"."dependencia_id", "Instit"."nombre_dep", "Instit"."tipoinstit_id", "Instit"."jurisdiccion_id", "Instit"."cue", "Instit"."anexo", "Instit"."esanexo", "Instit"."nombre", "Instit"."nroinstit", "Instit"."anio_creacion", "Instit"."direccion", "Instit"."depto", "Instit"."localidad", "Instit"."cp", "Instit"."telefono", "Instit"."mail", "Instit"."web", "Instit"."dir_nombre", "Instit"."dir_tipodoc_id", "Instit"."dir_nrodoc", "Instit"."dir_telefono", "Instit"."dir_mail", "Instit"."vice_nombre", "Instit"."vice_tipodoc_id", "Instit"."vice_nrodoc", "Instit"."actualizacion", "Instit"."observacion", "Instit"."fecha_mod", "Instit"."activo", "Instit"."ciclo_alta", "Instit"."ciclo_mod", "Instit"."created", "Instit"."modified", "Instit"."localidad_id", "Instit"."departamento_id", "Instit"."lugar", "Gestion"."id", "Gestion"."name", "Dependencia"."id", "Dependencia"."name", "Tipoinstit"."id", "Tipoinstit"."jurisdiccion_id", "Tipoinstit"."name", "Jurisdiccion"."id", "Jurisdiccion"."name", "Departamento"."id", "Departamento"."jurisdiccion_id", "Departamento"."name", "Localidad"."id", "Localidad"."departamento_id", "Localidad"."name"';
			
			$campos = '"Instit"."id" AS "Instit__id", "Instit"."gestion_id" AS "Instit__gestion_id", "Instit"."dependencia_id" AS "Instit__dependencia_id", "Instit"."nombre_dep" AS "Instit__nombre_dep", "Instit"."tipoinstit_id" AS "Instit__tipoinstit_id", "Instit"."jurisdiccion_id" AS "Instit__jurisdiccion_id", "Instit"."cue" AS "Instit__cue", "Instit"."anexo" AS "Instit__anexo", "Instit"."esanexo" AS "Instit__esanexo", "Instit"."nombre" AS "Instit__nombre", "Instit"."nroinstit" AS "Instit__nroinstit", "Instit"."anio_creacion" AS "Instit__anio_creacion", "Instit"."direccion" AS "Instit__direccion", "Instit"."depto" AS "Instit__depto", "Instit"."localidad" AS "Instit__localidad", "Instit"."cp" AS "Instit__cp", "Instit"."telefono" AS "Instit__telefono", "Instit"."mail" AS "Instit__mail", "Instit"."web" AS "Instit__web", "Instit"."dir_nombre" AS "Instit__dir_nombre", "Instit"."dir_tipodoc_id" AS "Instit__dir_tipodoc_id", "Instit"."dir_nrodoc" AS "Instit__dir_nrodoc", "Instit"."dir_telefono" AS "Instit__dir_telefono", "Instit"."dir_mail" AS "Instit__dir_mail", "Instit"."vice_nombre" AS "Instit__vice_nombre", "Instit"."vice_tipodoc_id" AS "Instit__vice_tipodoc_id", "Instit"."vice_nrodoc" AS "Instit__vice_nrodoc", "Instit"."actualizacion" AS "Instit__actualizacion", "Instit"."observacion" AS "Instit__observacion", "Instit"."fecha_mod" AS "Instit__fecha_mod", "Instit"."activo" AS "Instit__activo", "Instit"."ciclo_alta" AS "Instit__ciclo_alta", "Instit"."ciclo_mod" AS "Instit__ciclo_mod", "Instit"."created" AS "Instit__created", "Instit"."modified" AS "Instit__modified", "Instit"."localidad_id" AS "Instit__localidad_id", "Instit"."departamento_id" AS "Instit__departamento_id", "Instit"."lugar" AS "Instit__lugar", "Gestion"."id" AS "Gestion__id", "Gestion"."name" AS "Gestion__name", "Dependencia"."id" AS "Dependencia__id", "Dependencia"."name" AS "Dependencia__name", "Tipoinstit"."id" AS "Tipoinstit__id", "Tipoinstit"."jurisdiccion_id" AS "Tipoinstit__jurisdiccion_id", "Tipoinstit"."name" AS "Tipoinstit__name", "Jurisdiccion"."id" AS "Jurisdiccion__id", "Jurisdiccion"."name" AS "Jurisdiccion__name", "Departamento"."id" AS "Departamento__id", "Departamento"."jurisdiccion_id" AS "Departamento__jurisdiccion_id", "Departamento"."name" AS "Departamento__name", "Localidad"."id" AS "Localidad__id", "Localidad"."departamento_id" AS "Localidad__departamento_id", "Localidad"."name" AS "Localidad__name", "Plan"."id" AS "Plan__id", "Plan"."instit_id" AS "Plan__instit_id", "Plan"."oferta_id" AS "Plan__oferta_id", "Plan"."old_item" AS "Plan__old_item", "Plan"."norma" AS "Plan__norma", "Plan"."nombre" AS "Plan__nombre", "Plan"."perfil" AS "Plan__perfil", "Plan"."sector" AS "Plan__sector", "Plan"."duracion_hs" AS "Plan__duracion_hs", "Plan"."duracion_semanas" AS "Plan__duracion_semanas", "Plan"."duracion_anios" AS "Plan__duracion_anios", "Plan"."matricula" AS "Plan__matricula", "Plan"."observacion" AS "Plan__observacion", "Plan"."ciclo_alta" AS "Plan__ciclo_alta", "Plan"."ciclo_mod" AS "Plan__ciclo_mod", "Plan"."created" AS "Plan__created", "Plan"."modified" AS "Plan__modified", "Plan"."sector_id" AS "Plan__sector_id"';
			$instituciones = $this->Instit->find('all', array(
								'conditions'=>$conditions,
								'group'=>$group,
								'fields'=>$fields));
			debug(sizeof($instituciones));
		}
		
		$ofertas = $this->Instit->Plan->Oferta->find('list');
		$this->set('ofertas', $ofertas);
		
		//pr($this->Instit->recursive);
	}

}
?>