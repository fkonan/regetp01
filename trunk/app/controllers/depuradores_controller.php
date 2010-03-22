<?php

class DepuradoresController extends AppController {

	var $name = 'Depuradores';
	var $helpers = array('Html', 'Form','Ajax');
	var $uses = array('Instit','Plan','Sector','Jurisdiccion', 'Tipoinstit');
	var $db;
	
	
	
	function agregar_sectores(){
		App::import('Vendor', 'agrega_sectores/main');
		uses ('model' . DS . 'datasources' . DS . 'datasource');
		config('database');
		
		$this->autoRender = false;
			//conecto con la BD de cake default
			$this->db = new DATABASE_CONFIG();
			
			$depurador = new AgregaSectores($this->db->default);
			$depurador->main();	
		
	}
	
	
	/**
	 * 
	 * Esta funcion es la que depuraba los excel que armó Ramiro.
	 * La idea de esto era la de cargar los excel como tablas en BD
	 * luego se borraban los datos de la tabla tipoinstits y despues
	 * se ponian en cero los FK de la tabla instits 
	 * (campos departamentos_id, localidades_id)
	 * Despues de haber inicializado todo en cero, inputo nuevos registros 
	 * a tipoinstits, y los agrego como FK en la tabla instits
	 * 
	 * 
	 * @return nada
	 */
	//le pongo en private para que no se pueda tocar mas desde la web, ya que este script ya esta corrido y funcionando
	private function arreglar_tipoinstits(){
		App::import('Vendor', 'depura_tipoinstit/main');
		uses ('model' . DS . 'datasources' . DS . 'datasource');
		config('database');
		
			$this->autoRender = false;
			//conecto con la BD de cake default
			$this->db = new DATABASE_CONFIG();
			
			$depurador = new DepuraTipoinstits($this->db->default);
			$depurador->main();	
	}
	
	
	
	/**
	 * 
	 * Con este se depuran los departamentos y localidades que no estan 
	 * correctamente setteados en la tabla instits
	 * 
	 * @return unknown_type void
	 */
	function deptoyloc(){		
		//debug($this->data);die();
		if (!empty($this->data)) {
			if ($valor = $this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
								
			} else {
				print_r($this->Instit->validationErrors);
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}			
		
		$conditions = array('Instit.activo'=>1, array('OR'=> array('Instit.departamento_id'=>0, 'Instit.localidad_id'=>0)));
		
		$this->data =$this->Instit->find('first',array('conditions'=>$conditions,'order'=>'Instit.jurisdiccion_id DESC'));
		$total =$this->Instit->find('count',array('conditions'=>$conditions));
			
		//le pongo el valor vacio para que la vista muestre vacio. Luego el beforeSave se va a encargar d eagregarle un CERO para que cumpla con el NOT NULL de la BD
		if(isset($this->data['Instit']['anio_creacion']) && $this->data['Instit']['anio_creacion'] == 0){
			$this->data['Instit']['anio_creacion'] = '';
		}
		
		
		$tipoinstits = $this->Instit->Tipoinstit->find('list');
		$jurisdicciones = $this->Instit->Jurisdiccion->find('list');
		

		$tipoinstits = $this->Instit->Tipoinstit->find('list',array('conditions'=>'Tipoinstit.jurisdiccion_id = '.$this->data['Instit']['jurisdiccion_id'],'order'=>'Tipoinstit.name'));
		
		
		$departamentos = $this->Instit->Departamento->find('list',array('order'=>'name','conditions'=>array('jurisdiccion_id'=>$this->data['Instit']['jurisdiccion_id'])));
		$localidades = $this->Instit->Localidad->find('list',array('order'=>'name'));
		$this->set(compact('jurisdicciones','departamentos','localidades','tipoinstits'));	
		$this->set('falta_depurar',$total);
	}
	
	
	 /**
	 * Interfaz para depurar los tipointits
	 * 
	 * @return unknown_type void
	 */
	function tipoinstits(){				
		if (!empty($this->data)) {
			if ($valor = $this->Instit->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la Institución correctamente', true));
								
			} else {
				print_r($this->Instit->validationErrors);
				$this->Session->setFlash(__('La Institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}			
		
		$conditions = array('Instit.activo'=>1,'Instit.tipoinstit_id'=>0);
		
		$this->Instit->recursive = 1;
		$this->data =$this->Instit->find('first',array('conditions'=>$conditions,'order'=>'Instit.jurisdiccion_id DESC'));
		$total =$this->Instit->find('count',array('conditions'=>$conditions));
			
		//le pongo el valor vacio para que la vista muestre vacio. Luego el beforeSave se va a encargar d eagregarle un CERO para que cumpla con el NOT NULL de la BD
		if(isset($this->data['Instit']['anio_creacion']) && $this->data['Instit']['anio_creacion'] == 0){
			$this->data['Instit']['anio_creacion'] = '';
		}

		$tipoinstis = $this->Instit->Tipoinstit->find('list',array('conditions'=>'Tipoinstit.jurisdiccion_id = '.$this->data['Instit']['jurisdiccion_id'],'order'=>'Tipoinstit.name'));
		$this->set('tipoinstits', $tipoinstis);
		$this->set('falta_depurar',$total);

	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	function sectores($jur_id=0){		
		if (!empty($this->data)) 
		{				
				if(isset($this->data['Instit']['jurisdiccion_id']))
				{
					$jur_id = $this->data['Instit']['jurisdiccion_id'];
				}
				else
				{
					$this->Plan->id = $this->data['Plan']['id']; 
					if (!empty($this->data['Plan']['sector_id'])):
			  			if ($this->data['Plan']['sector_id'] != '' || $this->data['Plan']['sector_id'] != 0): 
			  				$this->Sector->recursive = -1;
			  				$this->Sector->id = $this->data['Plan']['sector_id'];
			  				$sec_aux = $this->Sector->read();
			  				$this->data['Plan']['sector'] = $sec_aux['Sector']['name'];
			  			endif;
			  		endif;
	  		  		
			  		$fields = array('nombre', 'sector_id', 'subsector_id');
			  		if($this->data['Plan']['sector_id'])
					{
						$fields[] = 'sector';
					}	
	  		
					
					if ($valor = $this->Plan->save(	$this->data ,array('validate'=>true,'fieldList'=>$fields))) {	
						$this->Session->setFlash(__('Se ha guardado el Plan correctamente', true));
										
					} else {
						debug($this->Plan->validationErrors);
						$this->Session->setFlash(__('El Plan no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
					}
				}
		}
		
		$conditions = array('Instit.activo'=>1, 'Plan.sector_id'=>0);
		if($jur_id!=0) $conditions['Instit.jurisdiccion_id'] =  $jur_id;
		
		$this->Plan->recursive = 1;
		$this->data =$this->Plan->find('first',array('conditions'=>$conditions));
		$total =$this->Plan->find('count',array('conditions'=>$conditions));

		$instit = $this->Plan->Instit->find('first',array('conditions'=>array('Instit.id'=>$this->data['Instit']['id'])));
		$this->data['Instit']['nombre'] = $instit['Instit']['nombre_completo'];

		$sectores = $this->Plan->Sector->find('list',array('order'=>'Sector.name'));
		$sectores[0]="SIN DATOS";
		$this->set('sectores',$sectores);

		$jurisdicciones = $this->Jurisdiccion->find('list',array('order'=>'Jurisdiccion.name'));
		$this->set('jurisdicciones',$jurisdicciones);
		$this->set('falta_depurar',$total);
		$this->set('jur_id',$jur_id);
		
		
		/***********************************/
		/*           Sugerencia            */
		/***********************************/
		$sector_sug = $this->Plan->Sector->find('first',array('conditions'=>array('name'=>$this->data['Plan']['sector'])));
		$sector_sug = ($sector_sug['Sector']['id']!="")?$sector_sug['Sector']['id']:'0';
		$this->set('sector_sug',$sector_sug);
			
		$subsectores = $this->Plan->Subsector->con_sector('list',$sector_sug);
		$this->set('subsectores',$subsectores);
	}
	
	function clases_y_etp()
	{		
		if (!empty($this->data)) 
		{	
			/*
			if ($this->Instit->save($this->data ,false, array('claseinstit_id, etp_estado_id'))) {	
				$this->Session->setFlash(__('Se ha guardado la institución correctamente', true));
			} else {
				debug($this->Instit->validationErrors);
				$this->Session->setFlash(__('La institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
			*/
			$this->Instit->id =  $this->data['Instit']['id'];
			
			
			if($this->Instit->saveField('claseinstit_id',  $this->data['Instit']['claseinstit_id']) &&
				$this->Instit->saveField('etp_estado_id',  $this->data['Instit']['etp_estado_id']) &&
				$this->Instit->saveField('tipoinstit_id',  $this->data['Instit']['tipoinstit_id'])
			)
			{
				$this->Session->setFlash(__('Se ha guardado la institución correctamente', true));
			}else{
				debug($this->Instit->validationErrors);
				$this->Session->setFlash(__('La institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
			}
		}		
		
		$conditions = array('activo' =>1,
							'OR'=>array(	'Instit.claseinstit_id'=>0,
											'Instit.etp_estado_id' =>0)
		);
		
		
		$falta_depurar = $this->Instit->find('count',array('conditions'=>$conditions));
		$this->data = $this->Instit->find('first',array('conditions'=>$conditions));
		
		$tipoinstit = $this->Instit->Tipoinstit->find('list', array('conditions'=>array('jurisdiccion_id'=>$this->data['Instit']['jurisdiccion_id']) ));
		
		$this->Instit->Plan->unbindModel(array('belongsTo' => array('Instit')));
		$planes = $this->Instit->Plan->find('all',array('conditions'=>array('Plan.instit_id'=>$this->data['Instit']['id'])));
		
		$claseinstits = $this->Instit->Claseinstit->find('list');
		$claseinstits[0] = "Seleccione";
		
		$etp_estados = $this->Instit->EtpEstado->find('list',array('order'=>'id DESC'));
		
		$this->set('falta_depurar', $falta_depurar);
		$this->set(compact('etp_estados', 'claseinstits','planes','tipoinstit'));
	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	function sectores_por_sectores($sec_id=0){		
		if (!empty($this->data)) 
		{				
			if(isset($this->data['Plan']['sector_id_filtro']))
			{
				$sec_id = $this->data['Plan']['sector_id_filtro'];
			}
			else
			{
				$this->Plan->id = $this->data['Plan']['id']; 
				if (!empty($this->data['Plan']['sector_id'])):
		  			if ($this->data['Plan']['sector_id'] != '' || $this->data['Plan']['sector_id'] != 0): 
		  				//$this->Sector->recursive = -1;
		  				//$this->Sector->id = $this->data['Plan']['sector_id'];
		  				//$sec_aux = $this->Sector->read();
		  				//$this->data['Plan']['sector'] = $sec_aux['Sector']['name'];
		  				$this->data['Plan']['sector'] = "1";
		  			endif;
		  		endif;
  		  		
		  		$fields = array('nombre', 'sector_id', 'subsector_id');
		  		if($this->data['Plan']['sector_id'])
				{
					$fields[] = 'sector';
				}	
  		
				if ($valor = $this->Plan->save(	$this->data ,array('validate'=>true,'fieldList'=>$fields))) {	
					$this->Session->setFlash(__('Se ha guardado el Plan correctamente', true));
									
				} else {
					debug($this->Plan->validationErrors);
					$this->Session->setFlash(__('El Plan no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
				}
			}
		}
		 
                $conditions = array('Instit.activo'=>1, array('OR' =>
                                array(	'Plan.sector <>'=>'1',
                                        'Plan.sector_id'=>0,
                                        'Plan.subsector_id'=>0,
                        )));
		if($sec_id!=0) $conditions['Plan.sector_id'] =  $sec_id;
		
		$this->Plan->recursive = 1;
		$this->data =$this->Plan->find('first',array('conditions'=>$conditions));
		$total =$this->Plan->find('count',array('conditions'=>$conditions));

		$instit = $this->Plan->Instit->find('first',array('conditions'=>array('Instit.id'=>$this->data['Instit']['id'])));
		$this->data['Instit']['nombre'] = $instit['Instit']['nombre_completo'];

		$sectores = $this->Plan->Sector->find('list',array('order'=>'Sector.name'));
		$sectores[0]="TODOS";
		
		$this->set('sectores',$sectores);
		$this->set('falta_depurar',$total);
		$this->set('sec_id',$sec_id);
		
		
		/***********************************/
		/*           Sugerencia            */
		/***********************************/
		$sector_sug['Sector']['id'] = "";
		$subsector_sug['Subsector']['id'] = "";
		if(isset($this->data['Plan'])) {
			$sector_sug = $this->Plan->Sector->find('first',array('conditions'=>array('Sector.id'=>$this->data['Plan']['sector_id'])));
			$subsector_sug = $this->Plan->Subsector->find('first',array('conditions'=>array('Subsector.id'=>$this->data['Plan']['subsector_id'])));
		}
			
		$sector_sug = ($sector_sug['Sector']['id']!="")?$sector_sug['Sector']['id']:'0';
		$this->set('sector_sug',$sector_sug);
		
		$subsector_sug = ($subsector_sug['Subsector']['id']!="")?$subsector_sug['Subsector']['id']:'0';
		$this->set('subsector_sug',$subsector_sug);
			
		$subsectores = $this->Plan->Subsector->con_sector('list',$sector_sug);
		$this->set('subsectores',$subsectores);
	}
	
	function depurar_similares() {
		$vectorcito = array();
    	$this->paginate['recursive'] = -1;
    	$this->paginate['limit'] = 50;
    	$instits = $this->paginate();
    	$conta = 0;
    	foreach($instits as $i) {
    		$similares = $this->Instit->getSimilars($i);
    		
    		if ( count($similares) > 0 ) {
    			$vectorcito[$conta] = $i;
    			$vectorcito[$conta]['Similares'] = $similares;
    			$vectorcito[$conta]['Error'] = $this->Instit->validationErrors;
    			$conta++;
    		}		    		
    	}
    	
    	$this->set('instits_similars',$vectorcito);
    	
    }
    
	function depurar_orientacion() {
		$tipoinstit_seleccionado = 0;
		
		if (empty($this->data['Form']['claseinstit_id'])) {
	    	if (!empty($this->data['Instit'])) 
			{	
				$this->Instit->id =  $this->data['Instit']['id'];
				if($this->Instit->saveField('orientacion_id',  $this->data['Instit']['orientacion_id']))
				{
					$this->Session->setFlash(__('Se ha guardado la institución correctamente', true));
				}else{
					debug($this->Instit->validationErrors);
					$this->Session->setFlash(__('La institución no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
				}
			}
		}
		
		
    	$conditions = array('activo' =>1, 'Instit.orientacion_id'=>0);
    	if ( !empty($this->data['Form']['claseinstit_id']) ) {
    		$tipoinstit_seleccionado = $this->data['Form']['claseinstit_id'];
    		$conditions['Instit.claseinstit_id'] = $this->data['Form']['claseinstit_id'];
    	}
		else {
			if (!empty($this->data['Instit']['claseinstit_id'])) {
				$tipoinstit_seleccionado = $this->data['Instit']['claseinstit_id'];
				$conditions['Instit.claseinstit_id'] = $this->data['Instit']['claseinstit_id'];
			}
		}
		
		$falta_depurar = $this->Instit->find('count',array('conditions'=>$conditions));
		$this->data = $this->Instit->find('first',array(
									'conditions'=>$conditions
		));
		
		$tipoinstits = $this->Instit->Claseinstit->find('list');
		//$tipoinstits = $this->Instit->Tipoinstit->dameConJurisdiccion('list'); 
		
		$planes = $this->Instit->Plan->find('all',array('conditions'=>array('Plan.instit_id'=>$this->data['Instit']['id']),
														'contain'=>array(
																'Sector'=>array('Orientacion'),
																'Anio' => array('Ciclo'),
		)));
		
		
		$orientaciones = $this->Instit->Plan->Sector->Orientacion->find('list');
		
		$etp_estados = $this->Instit->EtpEstado->find('list',array('order'=>'id DESC'));
		
		$this->Instit->id = $this->data['Instit']['id'];
		$orientacionSugerida = $this->Instit->getOrientacionSegunSusPlanes();
		
		$this->set('falta_depurar', $falta_depurar);
		$this->set('tipoinstit_seleccionado', $tipoinstit_seleccionado);
		$this->set(compact( 'etp_estados', 'orientaciones','planes','tipoinstits',
							'orientacionSugerida'));
		
    }
    
    function depurar_titulos() {
    	/********************** GUARDADO DE LOS PLANES SELECCIONADOS *******/
 		if (!empty($this->data['Plan'])){
 			//$this->Plan->save();
 			$planesGuardar = array();

                        //@var $planes_sin_titulo   me indica si fueron seleccionado titulos para
                        //guardar alos cuales no le introdujeron QUE titulo era
                        $planes_sin_titulo = false;
 			foreach ($this->data['Plan'] as $p=>$a) {
                                // para evitar que se guarde cuando solo fue
                                // seleccionado el select que era para indicar el titulo generico, pero no tenia fines de guardado
 				if ( "$p" != 'titulo_id') {
	 				if ($a['selected']) {
                                            if (!empty($a['titulo_id'])){
	 					unset($a['selected']);
	 					$planesGuardar[] = $a;
                                            } else {
                                                 $planes_sin_titulo = true;
                                            }
	 				}
 				}
 			}

 			if ($this->Plan->saveAll(
 						$planesGuardar,
 						array('fieldList'=>array('titulo_id'), 'validate'=>false)
			)){
                                $text = '';
                                if ($planes_sin_titulo){
                                    $text = 'Algunos planes seleccionados no tenian indicado el título';
                                }
 				$this->Session->setFlash(__( $text.'<br>Se han guardado '.count($planesGuardar).' planes', true));
 			} else {
 				$this->Session->setFlash('Fallo el guardado');
 			}
 		}
    	/***************************** FIN GUARDADO DE LOS PLANES ***************/




 		/********************** BUSCADOR DE PLANES *******/

 	    // para el paginator que pueda armar la url
        $url_conditions = array();

        /**
         *    PLANES POR OFERTA
         */
        /**
         *     OFERTA
         */
        if(!empty($this->data['FPlan']['oferta_id'])) {
                    $this->paginate['Plan']['conditions']['Plan.oferta_id'] = $this->data['FPlan']['oferta_id'];

                    $this->Plan->Oferta->recursive = -1;
                    $oferta = $this->Plan->Oferta->findById($this->data['FPlan']['oferta_id']);
                    $url_conditions['Plan.oferta_id'] = $this->data['FPlan']['oferta_id'];
        }
        if(!empty($this->passedArgs['Plan.oferta_id'])) {
                    $this->paginate['Plan']['conditions']['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];

                    $this->Plan->Oferta->recursive = -1;
                    $oferta = $this->Plan->Oferta->findById($this->passedArgs['Plan.oferta_id']);
                    $url_conditions['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];

                    $this->data['FPlan']['oferta_id'] = $this->passedArgs['Plan.oferta_id'];
        }

        /**
         *     SECTOR
         */
        if(!empty($this->data['FPlan']['sector_id'])) {
                $this->paginate['Plan']['conditions']['Plan.sector_id'] = $this->data['FPlan']['sector_id'];
                $this->Plan->Sector->recursive = -1;
                $sector = $this->Plan->Sector->findById( $this->data['FPlan']['sector_id']);
                $url_conditions['Plan.sector_id'] = $this->data['FPlan']['sector_id'];
        }
        if(!empty($this->passedArgs['Plan.sector_id'])) {
                $this->paginate['Plan']['conditions']['Plan.sector_id'] = $this->passedArgs['Plan.sector_id'];
                $this->Plan->Sector->recursive = -1;
                $sector = $this->Plan->Sector->findById($this->passedArgs['Plan.sector_id']);
                $url_conditions['Plan.sector_id'] = $this->passedArgs['Plan.sector_id'];

                $this->data['FPlan']['sector_id'] = $this->passedArgs['Plan.sector_id'];
        }


         /**
         *     SUBSECTOR
         */
        if(!empty($this->data['FPlan']['subsector_id'])) {
                $this->paginate['Plan']['conditions']['Plan.subsector_id'] = $this->data['FPlan']['subsector_id'];
                $this->Plan->Subsector->recursive = -1;
                $subsector = $this->Plan->Subsector->findById( $this->data['FPlan']['subsector_id']);
                $url_conditions['Plan.subsector_id'] = $this->data['FPlan']['subsector_id'];
        }
        if(!empty($this->passedArgs['Plan.subsector_id'])) {
                $this->paginate['Plan']['conditions']['Plan.subsector_id'] = $this->passedArgs['Plan.subsector_id'];
                $this->Plan->Subsector->recursive = -1;
                $sector = $this->Plan->Subsector->findById($this->passedArgs['Plan.subsector_id']);
                $url_conditions['Plan.subsector_id'] = $this->passedArgs['Plan.subsector_id'];

                $this->data['FPlan']['subsector_id'] = $this->passedArgs['Plan.subsector_id'];
        }

          /**
         *     JURISDICCION
         */
        if(!empty($this->data['FPlan']['jurisdiccion_id'])) {
                $this->paginate['Plan']['conditions']['Instit.jurisdiccion_id'] = $this->data['FPlan']['jurisdiccion_id'];
                $this->Plan->Instit->Jurisdiccion->recursive = -1;
                $jur =  $this->Plan->Instit->Jurisdiccion->findById( $this->data['FPlan']['jurisdiccion_id']);
                $url_conditions['Instit.jurisdiccion_id'] = $this->data['FPlan']['jurisdiccion_id'];
        }
        if(!empty($this->passedArgs['Instit.jurisdiccion_id'])) {
                $this->paginate['Plan']['conditions']['Instit.jurisdiccion_id'] = $this->passedArgs['Instit.jurisdiccion_id'];
                $this->Plan->Instit->Jurisdiccion->recursive = -1;
                $jur =  $this->Plan->Instit->Jurisdiccion->findById( $this->data['FPlan']['jurisdiccion_id']);
                $url_conditions['Instit.jurisdiccion_id'] = $this->passedArgs['Instit.jurisdiccion_id'];

                $this->data['FPlan']['jurisdiccion_id'] = $this->passedArgs['Instit.jurisdiccion_id'];
        }


        /***********************************************************************/
        /*                               Busqueda                              */
        /***********************************************************************/

        $this->Plan->recursive = 1;//para alivianar la carga del server

        //datos de paginacion
        $this->paginate['order'] = array('Plan.titulo_id ASC');

        $this->paginate['Plan']['limit'] = 10;
    	if(!empty($this->data['FPlan']['limit'])) {
    		$url_conditions['FPlan.limit'] = $this->data['FPlan']['limit'];
            $this->paginate['Plan']['limit'] = $this->data['FPlan']['limit'];
        }
        if(!empty($this->passedArgs['FPlan.limit'])) {
        	$url_conditions['FPlan.limit'] = $this->passedArgs['FPlan.limit'];
            $this->data['FPlan']['limit'] = $this->passedArgs['FPlan.limit'];
        }

        // Condicion necesaria
        $url_conditions['Plan.titulo_id'] = 0;
       	$this->paginate['Plan']['conditions']['Plan.titulo_id'] = 0;
       	//$this->paginate['Plan']['conditions']['Instit.activo'] = 1;

        $planes = $this->paginate('Plan');

        $this->set('planes', $planes);

        $this->set('url_conditions', $url_conditions);

        $ofertas = $this->Plan->Oferta->find('list');

        $this->Plan->Sector->order ='Sector.name';
        $sectores = $this->Plan->Sector->find('list');

        $this->Plan->Subsector->order ='Subsector.name';
        $subsectores = $this->Plan->Subsector->find('list');

        $this->Instit->Jurisdiccion->order = 'Jurisdiccion.name';
        $jurisdicciones = $this->Instit->Jurisdiccion->find('list');

 		$titulos = $this->Plan->Titulo->find('list');

    	$this->set(compact('planes','titulos','ofertas',
    	'sectores','subsectores','jurisdicciones'));
    }
}

?>