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
		$similares = array();
		
		$this->rutaUrl_for_layout[] =array('name'=> 'Agregar','link'=>'/Instits/add' );
		if (!empty($this->data)) {
			// si ingrese el formulario por primera vez, y la esta variable no esta setteada 
			// que me busque los similares		
			if($this->data['Instit']['force_save'] == 0)
			{
				$similares = $this->Instit->getSimilars($this->data);
			}		
			
			if(count($similares) == 0)
			{		
				$this->Instit->create();
				
				if ($this->Instit->save($this->data)) 
				{
					$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
					$this->redirect(array('action'=>'view/'.$this->Instit->id));
				} else {
					$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
				}
			}else
			{				
				$this->Session->setFlash(__('Hay instituciones similares.', true));
			}
		}

		$gestiones = $this->Instit->Gestion->find('list',array('order'=>'id ASC'));
		$dependencias = $this->Instit->Dependencia->find('list');

		$v_condiciones = array();
		if($this->data['Instit']['jurisdiccion_id'] != '' || $this->data['Instit']['jurisdiccion_id'] != 0){
			$v_condiciones = array('jurisdiccion_id'=>$this->data['Instit']['jurisdiccion_id']);
		}
		
		$tipoinstits = $this->Instit->Tipoinstit->find('list',array('order'=>'Tipoinstit.name','conditions'=>$v_condiciones));
		$departamentos = $this->Instit->Departamento->find('list',array('order'=>'name','conditions'=>$v_condiciones));
		
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list',array('order'=>'name'));
		
		$v_condiciones = array();
		if(($this->data['Instit']['departamento_id'] != '') || ($this->data['Instit']['departamento_id'] != 0)){
				$v_condiciones = array('departamento_id'=>$this->data['Instit']['departamento_id']);
		}
		$localidades = $this->Instit->Localidad->find('list',array('order'=>'name','conditions'=>$v_condiciones));
		$this->set(compact('gestiones','dependencias','jurisdicciones','similares','tipoinstits','departamentos','localidades'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Instit', true));
			$this->redirect(array('action'=>'search_form'));
		}
		
		
		if (!empty($this->data)) {
			
			
			$cueanterior = array();
			if ($datos_viejos = $this->Instit->cambioCue($this->data)){
				$cueanterior['HistorialCue']['cue'] 	  = $datos_viejos['Instit']['cue'];
				$cueanterior['HistorialCue']['anexo'] 	  = $datos_viejos['Instit']['anexo'];	
				$cueanterior['HistorialCue']['instit_id'] = $datos_viejos['Instit']['id'];		
			}
				
				
			if ($this->Instit->save($this->data)) 
			{
				// si hay cambio de cue lo inserto en la tabla historial_cues
				if(count($cueanterior) > 0){
					if($this->Instit->HistorialCue->hacerCambioDeCue($cueanterior)){
						$this->Session->setFlash(__('No se pudo insertar el cambio de CUE al historial de CUEs en la base de datos', true));
					}
				}
					
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
		
		$v_condiciones = array();
		if(isset($this->data['Instit']['jurisdiccion_id'])){
			$v_condiciones = array('jurisdiccion_id'=>$this->data['Instit']['jurisdiccion_id']);
		}
		
		$tipoinstits = $this->Instit->Tipoinstit->find('list',array('order'=>'Tipoinstit.name','conditions'=>$v_condiciones));
		$departamentos = $this->Instit->Departamento->find('list',array('order'=>'name','conditions'=>$v_condiciones));
		
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list',array('order'=>'name'));
		
		$v_condiciones = array();
		if(isset($this->data['Instit']['departamento_id'])){
				$v_condiciones = array('departamento_id'=>$this->data['Instit']['departamento_id']);
		}
		$localidades = $this->Instit->Localidad->find('list',array('order'=>'name','conditions'=>$v_condiciones));
		
		$this->set(compact('gestiones','dependencias','jurisdicciones','similares','tipoinstits','departamentos','localidades'));
				
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
		
		$this->Instit->Gestion->recursive = -1;
		$this->Instit->Gestion->order = 'Gestion.name';
		$gestiones = $this->Instit->Gestion->find('list');
		
		$this->Instit->Dependencia->recursive = -1;
		$this->Instit->Dependencia->order ='Dependencia.name';
		$dependencias = $this->Instit->Dependencia->find('list');
		
		//$tipoinstits = $this->Instit->Tipoinstit->find('list');
		
		
		 $this->Instit->Jurisdiccion->order = 'Jurisdiccion.name';
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		
		// que me liste todos los detarpamentos
		$departamentos = $this->Instit->Departamento->con_jurisdiccion('list');  
		//$departamentos = array();
		
		
		// con CERO me trae TODAS las jurisdicciones
		$localidades = $this->Instit->Localidad->con_depto_y_jurisdiccion('list'); 
		//$localidades = array();
		
		$this->Instit->Plan->Oferta->recursive = -1;
		$ofertas = $this->Instit->Plan->Oferta->find('list');
		$this->set(compact('gestiones', 'dependencias', 'jurisdicciones','ofertas','localidades','departamentos'));
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
		// sino es porque vino del paginador
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
            	 if($this->data['Instit']['cue'] != '' || $this->data['Instit']['cue'] != 0 )
            	 {
            	 	$is_cue_valido = $this->Instit->isCUEValid($this->data['Instit']['cue']);
            	 	if($is_cue_valido < 1){
            	 		switch ($is_cue_valido){
            	 			case -1:
            	 				$mensaje = "<H1>El CUE: '".$this->data['Instit']['cue']."' no es válido.</H1> Ingrese un valor numérico de al menos 3 dígitos.";
            	 				$this->Session->setFlash($mensaje,'default',array('class' => 'flash-warning'));
            	 				$this->redirect('search_form');
            	 				break;
            	 		}            	 		
            	 	}
                    // set the conditions
                    // condicion 1 busca lo que puse el CUE y/o anexo		            	 	
               	 	$instit_cue = $this->Instit->cambioComodin($this->data['Instit']['cue']);
            	 			
                  	$this->paginate['conditions'] = array('CAST(((Instit.cue*100)+Instit.anexo) as character(60)) SIMILAR TO ?' => '%'.$instit_cue.'%');;
                     // set the Search data, so the form remembers the option
                    $array_condiciones['CUE'] = $this->data['Instit']['cue'];
                  	$url_conditions['cue'] = $this->data['Instit']['cue'];
            	 }
            }
            
			if(isset($this->passedArgs['cue'])){	
            	 if($this->passedArgs['cue'] != '' || $this->passedArgs['cue'] != 0 ){
                    // set the conditions
                  
               	 	$long=strlen($this->passedArgs['cue']);
               	 	$instit_cue = $this->Instit->cambioComodin($this->passedArgs['cue']);
            	 	if($long == 8 || $long == 9)
            	 	{
            	 		$arr_cond1 = array('CAST(((Instit.cue*100)+Instit.anexo) as character(60)) SIMILAR TO ?' => $instit_cue.'%');
            	 	}
            	 	else
            	 	{
            	 		$arr_cond1 = array('CAST(((Instit.cue)) as character(60)) SIMILAR TO ?' => $instit_cue.'%');
            	 	}
            	 		
                  	$this->paginate['conditions'] = $arr_cond1;
                    // set the Search data, so the form remembers the option
                  	$array_condiciones['CUE'] = $this->passedArgs['cue'];
                  	$url_conditions['cue'] = $this->passedArgs['cue'];
            	 }
            }
            
            
            
			/**
			 *     Nro Institucion
			 */  
            if(isset($this->data['Instit']['nroinstit'])){
				if($this->data['Instit']['nroinstit'] != ''){
					$this->paginate['conditions']['lower(Instit.nroinstit) SIMILAR TO ?'] = array($this->Instit->convertir_para_busqueda_avanzada($this->data['Instit']['nroinstit']));
					$array_condiciones['N° de Institución'] = $this->data['Instit']['nroinstit'];
					$url_conditions['nroinstit'] = $this->data['Instit']['nroinstit'];			
				}
            }
			if(isset($this->passedArgs['nroinstit'])){	
            	if($this->passedArgs['nroinstit'] != ''){
					$this->paginate['conditions']['lower(Instit.nroinstit) SIMILAR TO ?'] = array($this->Instit->convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['nroinstit'])));
					$array_condiciones['N° de Institución'] = utf8_decode($this->passedArgs['nroinstit']);
					$url_conditions['nroinstit'] = utf8_decode($this->passedArgs['nroinstit']);			
				}
            }
            
            
            
            
			/**
			 *     JURISDICCION
			 */
            if(isset($this->data['Instit']['jurisdiccion_id'])){            
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
            if(isset($this->data['Instit']['nombre'])){
				if($this->data['Instit']['nombre'] != ''){
					$this->paginate['conditions']['to_ascii(lower(Instit.nombre)) SIMILAR TO ?'] = array($this->Instit->convertir_para_busqueda_avanzada($this->data['Instit']['nombre']));
					$array_condiciones['Nombre'] = $this->data['Instit']['nombre'];
					$url_conditions['nombre'] = $this->data['Instit']['nombre'];			
				}
            }
			if(isset($this->passedArgs['nombre'])){	
            	if($this->passedArgs['nombre'] != ''){
					$this->paginate['conditions']['to_ascii(lower(Instit.nombre)) SIMILAR TO ?'] = array($this->Instit->convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['nombre'])));
					$array_condiciones['Nombre'] = utf8_decode($this->passedArgs['nombre']);
					$url_conditions['nombre'] = utf8_decode($this->passedArgs['nombre']);			
				}
            }
			/**
			 *     DIRECCION
			 */
            if(isset($this->data['Instit']['direccion'])){
				if($this->data['Instit']['direccion'] != ''){
					$this->paginate['conditions']['lower(to_ascii(Instit.direccion)) SIMILAR TO ?'] = array($this->Instit->convertir_para_busqueda_avanzada($this->data['Instit']['direccion']));
					$array_condiciones['Domicilio'] = $this->data['Instit']['direccion'];			
					$url_conditions['direccion'] = $this->data['Instit']['direccion'];
				}
			}
			if(isset($this->passedArgs['direccion'])){	
            			if($this->passedArgs['direccion'] != ''){
					$this->paginate['conditions']['lower(to_ascii(Instit.direccion)) SIMILAR TO ?'] = array($this->Instit->convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['direccion'])));
					$array_condiciones['Domicilio'] = utf8_decode($this->passedArgs['direccion']);			
					$url_conditions['direccion'] = utf8_decode($this->passedArgs['direccion']);
				}
			}	
			
            
			/**
			 *     DEPARTAMENTO
			 */
			if(isset($this->data['Departamento']['id'])){				
				if (($this->data['Departamento']['id'] != 0) && ($this->data['Departamento']['id'] != '')){ 
					$this->paginate['conditions']['Departamento.id'] = array($this->data['Departamento']['id']);
					
					$this->Instit->Localidad->recursive = -1;
					$this->Instit->Departamento->id = $this->data['Departamento']['id'];
					$array_condiciones['Departamento'] = $this->Instit->Departamento->field('name');
					$url_conditions['Departamento.id'] = $this->data['Departamento']['id'];		
				}	
			}
			if(isset($this->passedArgs['Departamento.id'])){	
            	if($this->passedArgs['Departamento.id'] != ''){
					$this->paginate['conditions']['Departamento.id'] = array($this->passedArgs['Departamento.id']);
					
					$this->Instit->Departamento->recursive = -1;
					$instit = $this->Instit->Departamento->findById($this->passedArgs['Departamento.id']);
					
					$array_condiciones['Departamento'] = $instit['Departamento']['name'];
					
					$url_conditions['Departamento.id'] = $this->passedArgs['Departamento.id'];			
				}
            }
            
            
            /**
			 *     LOCALIDAD
			 */
			if(isset($this->data['Localidad']['id'])){
				if (($this->data['Localidad']['id'] != 0) && ($this->data['Localidad']['id'] != '')){ 
					$this->paginate['conditions']['Localidad.id'] = array($this->data['Localidad']['id']);
					
					$this->Instit->Localidad->recursive = -1;
					$instit = $this->Instit->Localidad->findById($this->data['Localidad']['id']);
					$array_condiciones['Localidad'] = $instit['Localidad']['name'];
					$url_conditions['Localidad.id'] = $this->data['Localidad']['id'];		
				}	
			}
			if(isset($this->passedArgs['Localidad.id'])){	
            	if($this->passedArgs['Localidad.id'] != ''){
					$this->paginate['conditions']['Localidad.id'] = array($this->passedArgs['Localidad.id']);
					$this->Instit->Localidad->recursive = -1;
					$instit = $this->Instit->Localidad->findById($this->passedArgs['Localidad.id']);
					$array_condiciones['Localidad'] = $instit['Localidad']['name'];
					$url_conditions['Localidad.id'] = $this->passedArgs['Localidad.id'];			
				}
            }
            
            
            
			/**
			 *     GESTION 
			 */
            if(isset($this->data['Instit']['gestion_id'])){
				if($this->data['Instit']['gestion_id'] != ''){
					$this->paginate['conditions']['Instit.gestion_id'] = $this->data['Instit']['gestion_id'];
					$this->Instit->Gestion->recursive = -1;
					$aux = $this->Instit->Gestion->findById($this->data['Instit']['gestion_id']);
					$array_condiciones['Ámbito de Gestión'] = $aux['Gestion']['name'];
					$url_conditions['gestion_id'] = $this->data['Instit']['gestion_id'];
				}
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
			if(isset($this->data['Instit']['dependencia_id'])){
				if($this->data['Instit']['dependencia_id'] != ''){
					$this->paginate['conditions']['Instit.dependencia_id'] = $this->data['Instit']['dependencia_id'];
					$this->Instit->Dependencia->recursive = -1;
					$aux = $this->Instit->Dependencia->findById($this->data['Instit']['dependencia_id']);
					$array_condiciones['Dependencia'] = $aux['Dependencia']['name'];
					$url_conditions['dependencia_id'] = $this->data['Instit']['dependencia_id'];
				}
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
			/**
			 *     OFERTA
			 */
			if(isset($this->data['Plan']['oferta_id'])){
				if($this->data['Plan']['oferta_id'] != ''){
					if((int)$this->data['Plan']['oferta_id'] == 0){
						$basura = 1;
					}
					else{
						$this->Instit->asociarPlan = true;
						$this->paginate['conditions']['Plan.oferta_id'] = $this->data['Plan']['oferta_id'];
						
						$this->Instit->Plan->Oferta->recursive = -1;
						$oferta = $this->Instit->Plan->Oferta->findById($this->data['Plan']['oferta_id']);			
						$array_condiciones['Con Oferta'] = $oferta['Oferta']['name'];
						$url_conditions['Plan.oferta_id'] = $this->data['Plan']['oferta_id'];
					}			
				}
			}
		 	if(isset($this->passedArgs['Plan.oferta_id'])){	
            	if($this->passedArgs['Plan.oferta_id'] != '' || $this->passedArgs['Plan.oferta_id'] != 0){
            		if((int)$this->passedArgs['Plan.oferta_id'] == 0){
						$basura = 1;
					}
					else{
					$this->Instit->asociarPlan = true;
					$this->paginate['conditions']['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];
					
					$this->Instit->Plan->Oferta->recursive = -1;	
					$oferta = $this->Instit->Plan->Oferta->findById($this->passedArgs['Plan.oferta_id']);			
					$array_condiciones['Con Oferta'] = $oferta['Oferta']['name'];
					$url_conditions['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];
						
					}			
				}
            }
            
			/**
			 *     SECTOR
			 */
            if(isset($this->data['Plan']['sector'])){
	            if($this->data['Plan']['sector'] != ''){
	            	$this->Instit->asociarPlan = true;
					$this->paginate['conditions']['to_ascii(lower(Plan.sector)) SIMILAR TO ?'] = array($this->Instit->convertir_para_busqueda_avanzada($this->data['Plan']['sector']));
					$array_condiciones['Sector'] = $this->data['Plan']['sector'];
					$url_conditions['Plan.sector'] = $this->data['Plan']['sector'];			
				}
            }
			if(isset($this->passedArgs['Plan.sector'])){	
            	if($this->passedArgs['Plan.sector'] != ''){
            		$this->Instit->asociarPlan = true;
					$this->paginate['conditions']['to_ascii(lower(Plan.sector)) SIMILAR TO ?'] = array($this->Instit->convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['Plan.sector'])));
					$array_condiciones['Sector'] = utf8_decode($this->passedArgs['Plan.sector']);
					$url_conditions['Plan.sector'] = utf8_decode($this->passedArgs['Plan.sector']);			
				}
            }
                            
            
            
            
            
			
        /***********************************************************************/
			
	    $this->Instit->recursive = 1;//para alivianar la carga del server         
		
	    //datos de paginacion
	    $pagin = $this->paginate();
	    
	    //si se encontro solo 1 institucion, ir directamente a la vista de esa institucion
	    if(sizeof($pagin) == 1 && $vino_formulario){
	    	// si el resultado me trajo 1, y eestoy buscando por CUE, entonces ir directamente a la vista d esas institucion
	    	if(isset($this->data['Instit']['cue'])){
            	 if($this->data['Instit']['cue'] != '' || $this->data['Instit']['cue'] != 0 ){
	    			if(($pagin[0]['Instit']['cue'] == $this->data['Instit']['cue']) || (($pagin[0]['Instit']['cue']*100+$pagin[0]['Instit']['anexo'] == $this->data['Instit']['cue']))){
	    				$this->redirect('view/'.$pagin[0]['Instit']['id']);	 
	    			}
            	 }
	    	}	    	   	
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
		$this->autoRender = false; // para uqe no muestre la vista
		
		die($this->Instit->convertir_para_busqueda_avanzada("pepino"));
	}

}
?>