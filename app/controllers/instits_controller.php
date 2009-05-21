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
		
		$this->set('instit', $this->Instit->read(null, $id));
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
		$tipoinstits = $this->Instit->Tipoinstit->find('list',array('conditions'=>'Tipoinstit.jurisdiccion_id = '.$this->data['Instit']['jurisdiccion_id']));
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		$this->set(compact('gestiones','dependencias','tipoinstits','jurisdicciones'));
		$this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$id );
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
				$this->paginate['conditions']['lower(to_ascii(Instit.nombre)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->data['Instit']['nombre']));
				$array_condiciones['Nombre'] = $this->data['Instit']['nombre'];
				$url_conditions['nombre'] = $this->data['Instit']['nombre'];			
			}
			if(isset($this->passedArgs['nombre'])){	
            	if($this->passedArgs['nombre'] != ''){
					$this->paginate['conditions']['lower(to_ascii(Instit.nombre)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->passedArgs['nombre']));
					$array_condiciones['Nombre'] = $this->passedArgs['nombre'];
					$url_conditions['nombre'] = $this->passedArgs['nombre'];			
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
					$this->paginate['conditions']['lower(to_ascii(Instit.direccion)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->passedArgs['direccion']));
					$array_condiciones['Domicilio'] = $this->passedArgs['direccion'];			
					$url_conditions['direccion'] = $this->passedArgs['direccion'];
				}
			}	
			/**
			 *     LOCALIDAD
			 */
			if($this->data['Instit']['localidad'] != ''){
				$this->paginate['conditions']['lower(to_ascii(Instit.localidad)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->data['Instit']['localidad']));
				$array_condiciones['Localidad'] = $this->data['Instit']['localidad'];
				$url_conditions['localidad'] = $this->data['Instit']['localidad'];			
			}
			if(isset($this->passedArgs['localidad'])){	
            	if($this->passedArgs['localidad'] != ''){
					$this->paginate['conditions']['lower(to_ascii(Instit.localidad)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->passedArgs['localidad']));
					$array_condiciones['Localidad'] = $this->passedArgs['localidad'];
					$url_conditions['localidad'] = $this->passedArgs['localidad'];			
				}
            }
            
			/**
			 *     DEPARTAMENTO
			 */
			if($this->data['Instit']['depto'] != ''){
				$this->paginate['conditions']['lower(to_ascii(Instit.depto)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->data['Instit']['depto']));
				$array_condiciones['Departamento'] = $this->data['Instit']['depto'];
				$url_conditions['depto'] = $this->data['Instit']['depto'];			
			}
			if(isset($this->passedArgs['depto'])){	
            	if($this->passedArgs['depto'] != ''){
					$this->paginate['conditions']['lower(to_ascii(Instit.depto)) SIMILAR TO ?'] = array($this->_convertir_para_busqueda_avanzada($this->passedArgs['depto']));
					$array_condiciones['Departamento'] = $this->passedArgs['depto'];
					$url_conditions['depto'] = $this->passedArgs['depto'];			
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
            
			
        /***********************************************************************/
			
	    $this->Instit->recursive = 0;//para alivianar la carga del server         
		
	    //datos de paginacion
	    $pagin = $this->paginate();
	    
	    //si se encontro solo 1 institucion, ir directame te a la vista de esa institucion
	    if(sizeof($pagin) == 1){
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
		
		$this->data = $this->Instit->read(null,$id);
		if($this->data){
			$cont = 0;
			foreach ($this->data['Plan'] as $p):
				$v_plan_matricula[$cont] = $this->Instit->Plan->Anio->matricula_del_plan($p['id']);
				$v_plan_matricula[$cont]['ciclo'] = $this->Instit->Plan->Anio->ciclo_lectivo_matricula_del_plan($p['id']);
				$cont++;
			endforeach;
			$this->set('planes',$this->data);	
			$this->set('v_plan_matricula',$v_plan_matricula);
			$this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$this->data['Instit']['id'] );
		}
		else{ //cuando la institucion no tiene planes relacionados mostrar esto
			$ins_aux = $this->Plan->Instit->read(null,$id);
			
			$this->set('instit',$ins_aux);
			$this->set('planes',array() );
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
			'/a/' => 'á',
			'/e/' => 'é',
			'/i/' => 'í',
			'/o/' => 'ó',
			'/u/' => 'ú',
		
			'/á/' => '(a|á)',
			'/é/' => '(e|é)',
			'/í/' => '(i|í)',
			'/ó/' => '(o|ó)',
			'/ú/' => '(u|ú)',
			
			'/n/' => 'ñ',
			'/ñ/' => '(n|ñ)'
 
			// Agregar aqui mas caracteres si es necesario
 
		);
		
		$text = preg_replace(array_keys($patron),array_values($patron),$text);
		return $text;		
	}

}
?>