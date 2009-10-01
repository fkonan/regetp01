<?php
class HistorialCuesController extends AppController {

	var $name = 'HistorialCues';
	var $helpers = array('Html', 'Form','Ajax');
	var $paginate = array('order'=>array('HistorialCue.cue' => 'asc'),'limit'=>'10'); 

	function beforeFilter(){
		parent::beforeFilter();
		$this->rutaUrl_for_layout[] =array('name'=> 'Buscador Histórico','link'=>'/HistorialCues/search_form' );
	}
	
	function index() {		
		$this->Instit->recursive = 0;
		$this->set('instits', $this->paginate());
	}

	function view($id = null) {
	}

	function add() {		
	}

	function edit($id = null) {
	}

	function delete($id = null) {
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
	}
	
	/**
	 * Esta accion es el procesamiento del formulario de busqueda
	 * maneja las condiciones de la busqueda y el paginador
	 *
	 */
	function search(){

		$array_condiciones = array();
		$url_conditions    = array();
		
		/* **************************************************** */
		/* * Seteo la relaciòn con Instits en Full other join * */
		/* **************************************************** */

		$this->HistorialCue->setBelongsToInstitTypeFull();
		
		if(isset($this->data['HistorialCues']['cue'])){
			if($this->data['HistorialCues']['cue'] != '' || $this->data['HistorialCues']['cue'] != 0 ){
				if($this->HistorialCue->Instit->isCUEValid($this->data['HistorialCues']['cue']) < 0){
					$this->Session->setFlash("El CUE: '".$this->data['HistorialCues']['cue']."' no es válido.");
					$this->redirect('search_form');
				}

           	 	$arr_cond1 = array('OR'=> array(
           	 						'CAST(HistorialCue.cue as character(60)) SIMILAR TO ?' => '%'.$this->data['HistorialCues']['cue'].'%',
									'CAST(Instit.cue as character(60)) SIMILAR TO ?' => '%'.$this->data['HistorialCues']['cue'].'%'
           	 	));
				
           	 	$arr_cond2 = array();
				
				$cond_text = "";
				$long      = strlen($this->data['HistorialCues']['cue']);

				if($long == 8 || $long == 9){
					$arr_cond2 = array('CAST(HistorialCue.cue as character(60)) SIMILAR TO ?' => '%'.substr($this->data['HistorialCues']['cue'],0,$long-2).'%');
					$cond_text = substr($this->data['HistorialCues']['cue'],0,$long-2)." - " ;
				}
            	 		
				$this->paginate['conditions'] = array('OR'=> array($arr_cond1,$arr_cond2));
				$array_condiciones['CUE']     = $cond_text.$this->data['HistorialCues']['cue'];
				$url_conditions['cue'] = $this->data['HistorialCues']['cue'];
			}
		}

		if(isset($this->passedArgs['cue'])){	
			if($this->passedArgs['cue'] != '' || $this->passedArgs['cue'] != 0 ){
           	 	$arr_cond1 = array('OR'=> array(
           	 						'CAST(HistorialCue.cue as character(60)) SIMILAR TO ?' => '%'.$this->passedArgs['cue'].'%',
									'CAST(Instit.cue as character(60)) SIMILAR TO ?' => '%'.$this->passedArgs['cue'].'%'
           	 	));
				
				
				$arr_cond2 = array();
				$cond_text = "";
				$long     = strlen($this->passedArgs['cue']);

				if($long == 8 || $long == 9){
					$arr_cond2 = array('CAST(HistorialCue.cue as character(60)) SIMILAR TO ?' => '%'.substr($this->passedArgs['cue'],0,$long-2).'%');
					$cond_text = substr($this->passedArgs['cue'],0,$long-2)." - " ;
				}
            	 		
				$this->paginate['conditions'] = array('OR'=> array($arr_cond1,$arr_cond2));
				$array_condiciones['CUE'] = $this->passedArgs['cue'];
				$url_conditions['cue'] = $this->passedArgs['cue'];
			}
		}
            
	    $this->HistorialCue->recursive = 1;         
	    $data = $this->paginate();

	    /* ************************************************************ */
		/* * Llamo el find de instit para que arme el nombre completo * */
		/* ************************************************************ */

	    $totInstit = count($data);
		for ($i=0;$i<$totInstit;$i++){
			$nombre_completo = $this->HistorialCue->Instit->find(array('Instit.id'=>$data[$i]['Instit']['id']));
			$data[$i]['Instit']['nombre_completo'] = $nombre_completo['Instit']['nombre_completo'];
		}
		debug($data);
        $this->set('instits', $data);
        $this->set('url_conditions', $url_conditions);
        $this->set('conditions', $array_condiciones);
	}
}
?>