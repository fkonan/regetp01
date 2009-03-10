<?php
class InstitsController extends AppController {

	var $name = 'Instits';
	var $helpers = array('Html', 'Form','Ajax');

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
				$this->redirect(array('action'=>'index'));
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
			$this->redirect(array('action'=>'index'));
		}
		
		if (!empty($this->data)) {
			if ($this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
				$this->redirect(array('action'=>'index'));
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

		
		//
        // Filtro si viene por el formulario
        //
		if (!empty($this->data)) {							
		 	
            if(isset($this->data['Instit']['cue'])){	
                    // set the conditions
                    $this->paginate['conditions']['Instit.cue LIKE'] = '%'.$this->data['Instit']['cue'].'%';
                     // set the Search data, so the form remembers the option
                  	$array_condiciones['Cue'] = $this->data['Instit']['cue'];
                  	$url_conditions['cue'] = $this->data['Instit']['cue'];
            }
            
            if(isset($this->data['Instit']['tipoinstit_id'])){
				if( $this->data['Instit']['tipoinstit_id'] != '' || $this->data['Instit']['tipoinstit_id'] != 0){
	                $this->paginate['conditions']['Instit.tipoinstit_id'] = $this->data['Instit']['tipoinstit_id'];
					$array_condiciones['Tipo Institución']= $this->data['Instit']['tipoinstit_id'];
					$url_conditions['tipoinstit_id'] = $this->data['Instit']['tipoinstit_id'];		
				}
            }

			
			if($this->data['Instit']['jurisdiccion_id'] != ''){
				if((int)$this->data['Instit']['jurisdiccion_id'] == 0){
					$basura = 1;
				}
				else{
					$this->paginate['conditions']['Instit.jurisdiccion_id'] = $this->data['Instit']['jurisdiccion_id'];
					$array_condiciones['Jurisdiccion'] = $this->data['Instit']['jurisdiccion_id'];
					$url_conditions['jurisdiccion_id'] = $this->data['Instit']['jurisdiccion_id'];
				}			
			}
						
			if($this->data['Instit']['nombre'] != ''){
				$this->paginate['conditions']['UPPER(Instit.nombre) LIKE'] = '%'.strtoupper($this->data['Instit']['nombre']).'%';
				$array_condiciones['Nombre'] = '%'.($this->data['Instit']['nombre']).'%';
				$url_conditions['nombre'] = $this->data['Instit']['nombre'];			
			}
			if($this->data['Instit']['direccion'] != ''){
				$this->paginate['UPPER(Instit.direccion) LIKE'] = '%'.strtoupper($this->data['Instit']['direccion']).'%';
				$array_condiciones['Direccion'] = '%'.$this->data['Instit']['direccion'].'%';			
				$url_conditions['direccion'] = $this->data['Instit']['direccion'];
			}
			
			
			if($this->data['Instit']['gestion_id'] != ''){
				$this->paginate['conditions']['Instit.gestion_id'] = $this->data['Instit']['gestion_id'];
				$array_condiciones['Gestion'] = $this->data['Gestion']['name'];
				$url_conditions['gestion_id'] = $this->data['Instit']['gestion_id'];
			}			
		
			if($this->data['Instit']['dependencia_id'] != ''){
				$this->paginate['conditions']['Instit.dependencia_id'] = $this->data['Instit']['dependencia_id'];
				$array_condiciones['Dependencia'] = $this->data['Dependencia']['name'];
				$url_conditions['dependencia_id'] = $this->data['Instit']['dependencia_id'];
			}
			
			if($this->data['Instit']['esanexo']){
				if((int)$this->data['Instit']['esanexo']== -1){
					$basura = 1;
				}else{				
					$this->paginate['conditions']['Instit.esanexo'] = $this->data['Instit']['esanexo'];
					$array_condiciones['Es Anexo'] = $this->data['Instit']['esanexo'];
					$url_conditions['esanexo'] = $this->data['Instit']['esanexo'];
				}
			}
			
			if($this->data['Instit']['activo']){
				if((int)$this->data['Instit']['activo']== -1){
					$basura = 1;
				}else{				
					$this->paginate['conditions']['Instit.activo'] = $this->data['Instit']['activo'];
					$array_condiciones['Activo'] = $this->data['Instit']['activo'];
					$url_conditions['activo'] = $this->data['Instit']['activo'];
				}
			}	
			
		}	
		//
        // Filtro si viene por paginacion
        //
		if (sizeof($this->passedArgs)>1) {							
		 	
            if(isset($this->passedArgs['cue'])){	
                    // set the conditions
                    $this->paginate['conditions']['Instit.cue LIKE'] = '%'.$this->passedArgs['cue'].'%';
                     // set the Search data, so the form remembers the option
                  	$array_condiciones['Cue'] = $this->passedArgs['cue'];
                  	$url_conditions['cue'] = $this->passedArgs['cue'];
            }
            
            if(isset($this->passedArgs['tipoinstit_id'])){	
				if($this->passedArgs['tipoinstit_id'] != '' || $this->passedArgs['tipoinstit_id'] != 0){
	                $this->paginate['conditions']['Instit.tipoinstit_id'] = $this->passedArgs['tipoinstit_id'];
					$array_condiciones['Tipo Institución']= $this->passedArgs['tipoinstit_id'];
					$url_conditions['tipoinstit_id'] = $this->passedArgs['tipoinstit_id'];		
				}
            }
			
            if(isset($this->passedArgs['jurisdiccion_id'])){	
            	if($this->passedArgs['jurisdiccion_id'] != '' || $this->passedArgs['jurisdiccion_id'] != 0){
            		if((int)$this->passedArgs['jurisdiccion_id'] == 0){
						$basura = 1;
					}
					else{
					$this->paginate['conditions']['Instit.jurisdiccion_id'] = $this->passedArgs['jurisdiccion_id'];
					$array_condiciones['Jurisdiccion'] = $this->passedArgs['jurisdiccion_id'];
					$url_conditions['jurisdiccion_id'] = $this->passedArgs['jurisdiccion_id'];
					}			
				}
            }
            
            if(isset($this->passedArgs['nombre'])){	
            	if($this->passedArgs['nombre'] != ''){
					$this->paginate['conditions']['UPPER(Instit.nombre) LIKE'] = '%'.strtoupper($this->passedArgs['nombre']).'%';
					$array_condiciones['Nombre'] = '%'.($this->passedArgs['nombre']).'%';
					$url_conditions['nombre'] = $this->passedArgs['nombre'];			
				}
            }
            
			if(isset($this->passedArgs['direccion'])){	
            			if($this->passedArgs['direccion'] != ''){
					$this->paginate['UPPER(Instit.direccion) LIKE'] = '%'.strtoupper($this->passedArgs['direccion']).'%';
					$array_condiciones['Direccion'] = '%'.$this->passedArgs['direccion'].'%';			
					$url_conditions['direccion'] = $this->passedArgs['direccion'];
				}
			}			
			
			if(isset($this->passedArgs['gestion_id'])){	
						if($this->passedArgs['gestion_id'] != ''){
					$this->paginate['conditions']['Instit.gestion_id'] = $this->passedArgs['gestion_id'];
					$array_condiciones['Gestion'] = $this->passedArgs['gestion_id'];
					$url_conditions['gestion_id'] = $this->passedArgs['gestion_id'];
				}
			}			
			
			if(isset($this->passedArgs['dependencia_id'])){
				if($this->passedArgs['dependencia_id'] != ''){
					$this->paginate['conditions']['Instit.dependencia_id'] = $this->passedArgs['dependencia_id'];
					$array_condiciones['Dependencia'] = $this->passedArgs['dependencia_id'];
					$url_conditions['dependencia_id'] = $this->passedArgs['dependencia_id'];
				}
			}
			
			if(isset($this->passedArgs['esanexo'])){
				if((int)$this->passedArgs['esanexo'] == -1){
						$basura = 1;
					}
				else{
					if($this->passedArgs['esanexo']){
						$this->paginate['conditions']['Instit.esanexo'] = $this->passedArgs['esanexo'];
						$array_condiciones['Es Anexo'] = $this->passedArgs['esanexo'];
						$url_conditions['esanexo'] = $this->passedArgs['esanexo'];
					}
				}
			}
			
			if(isset($this->passedArgs['activo'])){
				if((int)$this->passedArgs['activo'] == -1){
						$basura = 1;
				}
				else{
					if($this->passedArgs['activo']){
						$this->paginate['conditions']['Instit.activo'] = $this->passedArgs['activo'];
						$array_condiciones['Activo'] = $this->passedArgs['activo'];
						$url_conditions['activo'] = $this->passedArgs['activo'];
					}
				}	
			}	
		}	
		
	    $this->Instit->recursive = 0;         
		
        $this->set('instits', $this->paginate());
        $this->set('conditions', $array_condiciones);
        $this->set('url_conditions', $url_conditions);
        
	}

}
?>