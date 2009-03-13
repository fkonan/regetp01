<?php
class InstitsController extends AppController {

	var $name = 'Instits';
	var $helpers = array('Html', 'Form','Ajax');
	var $paginate = array('order'=>array('Instit.cue' => 'asc')); 

	function index() {		
		$this->Instit->recursive = 0;
		$this->set('instits', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Institución Inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->set('instit', $this->Instit->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Instit->create();
			if ($this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
				$this->redirect(array('action'=>'search_form'));
			} else {
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}
		$gestiones = $this->Instit->Gestion->find('list');
		$dependencias = $this->Instit->Dependencia->find('list');
		$tipoinstits = $this->Instit->Tipoinstit->find('list');
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
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
				$this->redirect(array('action'=>'search_form'));
			} else {
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Instit->read(null, $id);
		}
		$gestiones = $this->Instit->Gestion->find('list');
		$dependencias = $this->Instit->Dependencia->find('list');
		$tipoinstits = $this->Instit->Tipoinstit->find('list');
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		$this->set(compact('gestiones','dependencias','tipoinstits','jurisdicciones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Se ha pasado un id que no existe para esa Institución', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Instit->del($id)) {
			$this->Session->setFlash(__('Se ha eliminado la Institución correctamente', true));
			$this->redirect(array('action'=>'index'));
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
		$this->set(compact('gestiones', 'dependencias', 'tipoinstits', 'jurisdicciones'));
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

		$this->Instit->unbindModelosInnecesarios();

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
				$this->paginate['conditions']['UPPER(Instit.nombre) LIKE'] = '%'.strtoupper($this->data['Instit']['nombre']).'%';
				$array_condiciones['Nombre'] = $this->data['Instit']['nombre'];
				$url_conditions['nombre'] = $this->data['Instit']['nombre'];			
			}
			if(isset($this->passedArgs['nombre'])){	
            	if($this->passedArgs['nombre'] != ''){
					$this->paginate['conditions']['UPPER(Instit.nombre) LIKE'] = '%'.strtoupper($this->passedArgs['nombre']).'%';
					$array_condiciones['Nombre'] = $this->passedArgs['nombre'];
					$url_conditions['nombre'] = $this->passedArgs['nombre'];			
				}
            }
			/**
			 *     DIRECCION
			 */
			if($this->data['Instit']['direccion'] != ''){
				$this->paginate['conditions']['UPPER(Instit.direccion) LIKE'] = '%'.strtoupper($this->data['Instit']['direccion']).'%';
				$array_condiciones['Domicilio'] = $this->data['Instit']['direccion'];			
				$url_conditions['direccion'] = $this->data['Instit']['direccion'];
			}
			if(isset($this->passedArgs['direccion'])){	
            			if($this->passedArgs['direccion'] != ''){
					$this->paginate['conditions']['UPPER(Instit.direccion) LIKE'] = '%'.strtoupper($this->passedArgs['direccion']).'%';
					$array_condiciones['Domicilio'] = $this->passedArgs['direccion'];			
					$url_conditions['direccion'] = $this->passedArgs['direccion'];
				}
			}	
			/**
			 *     LOCALIDAD
			 */
			if($this->data['Instit']['localidad'] != ''){
				$this->paginate['conditions']['UPPER(Instit.localidad) LIKE'] = '%'.strtoupper($this->data['Instit']['localidad']).'%';
				$array_condiciones['Localidad'] = $this->data['Instit']['localidad'];
				$url_conditions['localidad'] = $this->data['Instit']['localidad'];			
			}
			if(isset($this->passedArgs['localidad'])){	
            	if($this->passedArgs['localidad'] != ''){
					$this->paginate['conditions']['UPPER(Instit.localidad) LIKE'] = '%'.strtoupper($this->passedArgs['localidad']).'%';
					$array_condiciones['Localidad'] = $this->passedArgs['localidad'];
					$url_conditions['localidad'] = $this->passedArgs['localidad'];			
				}
            }
            
			/**
			 *     GESTION 
			 */
			if($this->data['Instit']['gestion_id'] != ''){
				$this->paginate['conditions']['Instit.gestion_id'] = $this->data['Instit']['gestion_id'];
				$this->Instit->Gestion->recursive = -1;
				$aux = $this->Instit->Gestion->findById($this->data['Instit']['gestion_id']);
				$array_condiciones['Gestión'] = $aux['Gestion']['name'];
				$url_conditions['gestion_id'] = $this->data['Instit']['gestion_id'];
			}
			if(isset($this->passedArgs['gestion_id'])){
				if($this->passedArgs['gestion_id'] != ''){
					$this->paginate['conditions']['Instit.gestion_id'] = $this->passedArgs['gestion_id'];
					$this->Instit->Gestion->recursive = -1;
					$aux = $this->Instit->Gestion->findById($this->passedArgs['gestion_id']);
					$array_condiciones['Gestión'] = $aux['Gestion']['name'];
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
			if($this->data['Instit']['esanexo']){
				if((int)$this->data['Instit']['esanexo']== -1){
					$basura = 1;
				}else{				
					$this->paginate['conditions']['Instit.esanexo'] = $this->data['Instit']['esanexo'];
					$aux = $this->data['Instit']['esanexo']? 'Si':'No';
					$array_condiciones['Es Anexo'] = $aux;
					$url_conditions['esanexo'] = $this->data['Instit']['esanexo'];
				}
			}
			if(isset($this->passedArgs['esanexo'])){
				if((int)$this->passedArgs['esanexo'] == -1){
						$basura = 1;
					}
				else{
					if($this->passedArgs['esanexo']){
						$this->paginate['conditions']['Instit.esanexo'] = $this->passedArgs['esanexo'];
						$aux = $this->passedArgs['esanexo']? 'Si':'No';
					$array_condiciones['Es Anexo'] = $aux;
						$url_conditions['esanexo'] = $this->passedArgs['esanexo'];
					}
				}
			}
			
			/**
			 *     ACTIVO 
			 */
			if($this->data['Instit']['activo']){
				if((int)$this->data['Instit']['activo']== -1){
					$basura = 1;
				}else{				
					$this->paginate['conditions']['Instit.activo'] = $this->data['Instit']['activo'];
					$aux = $this->data['Instit']['activo']? 'Si':'No';
					$array_condiciones['Activo'] = $aux;
					$url_conditions['activo'] = $this->data['Instit']['activo'];
				}
			}	
			if(isset($this->passedArgs['activo'])){
				if((int)$this->passedArgs['activo'] == -1){
						$basura = 1;
				}
				else{
					if($this->passedArgs['activo']){
						$this->paginate['conditions']['Instit.activo'] = $this->passedArgs['activo'];
						$aux = $this->passedArgs['activo']? 'Si':'No';
						$array_condiciones['Activo'] = $aux;
						$url_conditions['activo'] = $this->passedArgs['activo'];
					}
				}	
			}	
            
			
        /***********************************************************************/
			
	    $this->Instit->recursive = 0;//para alivianar la carga del server         
		
	    //datos de paginacion
        $this->set('instits', $this->paginate());
        $this->set('url_conditions', $url_conditions);
		
        //devuelve un array para mostrar los criterios de busqueda
        $this->set('conditions', $array_condiciones);
	}
	
	
	
	
	
	function planes_relacionados($id = null){
		if (!$id) {
			$this->Session->setFlash(__('Institución Inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('instit', $this->Instit->read(null, $id));
	}

}
?>