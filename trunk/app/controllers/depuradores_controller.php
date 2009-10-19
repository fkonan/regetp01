<?php







class DepuradoresController extends AppController {

	var $name = 'Depuradores';
	var $helpers = array('Html', 'Form','Ajax');
	var $uses = array('Instit','Plan','Sector','Jurisdiccion');
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
	function planes($jur_id=0){				
		if (!empty($this->data)) {
			if(isset($this->data['Instit']['jurisdiccion_id']))
			{
				$jur_id = $this->data['Instit']['jurisdiccion_id'];
			}
			else
			{
				$this->Plan->id = $this->data['Plan']['id']; 
				if ($valor = $this->Plan->save(	array('nombre'=>$this->data['Plan']['nombre'], 'sector_id'=>$this->data['Plan']['sector_id']),
												array('validate'=>true, 'fieldList'=>array('nombre', 'sector_id')))) {	
					$this->Session->setFlash(__('Se ha guardado el Plan correctamente', true));
									
				} else {
					print_r($this->Plan->validationErrors);
					$this->Session->setFlash(__('El Plan no pudo ser guardada. Escriba nuevamente el campo incorrecto.', true));
				}
			}
		}
		
		$conditions = array('Instit.activo'=>1, 'Plan.sector_id'=>0);
		if($jur_id!=0) $conditions['Instit.jurisdiccion_id'] =  $jur_id;
		
		$this->Plan->recursive = 1;
		$this->data =$this->Plan->find('first',array('conditions'=>$conditions,'order'=>'Plan.id DESC'));
		$total =$this->Plan->find('count',array('conditions'=>$conditions));

		$instit = $this->Plan->Instit->find('first',array('conditions'=>array('Instit.id'=>$this->data['Instit']['id'])));
		$this->data['Instit']['nombre'] = $instit['Instit']['nombre_completo'];

		//$tipoinstis = $this->Instit->Tipoinstit->find('list',array('conditions'=>'Tipoinstit.jurisdiccion_id = '.$this->data['Instit']['jurisdiccion_id'],'order'=>'Tipoinstit.name'));
		$sectores = $this->Plan->Sector->find('list',array('order'=>'Sector.name'));
		$this->set('sectores',$sectores);
		$jurisdicciones = $this->Jurisdiccion->find('list',array('order'=>'Jurisdiccion.name'));
		$this->set('jurisdicciones',$jurisdicciones);
		$this->set('falta_depurar',$total);
		$this->set('jur_id',$jur_id);
	}
}
?>