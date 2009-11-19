<?php
class JurisdiccionesController extends AppController {

	var $name = 'Jurisdicciones';
	var $helpers = array('Html', 'Form');
	
	function index() {
		$this->Jurisdiccion->recursive = 0;
		$this->set('jurisdicciones', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Jurisdiccion.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('jurisdiccion', $this->Jurisdiccion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Jurisdiccion->create();
			if ($this->Jurisdiccion->save($this->data)) {
				$this->Session->setFlash(__('The Jurisdiccion has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Jurisdiccion could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Jurisdiccion', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Jurisdiccion->save($this->data)) {
				$this->Session->setFlash(__('The Jurisdiccion has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Jurisdiccion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Jurisdiccion->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Jurisdiccion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Jurisdiccion->del($id)) {
			$this->Session->setFlash(__('Jurisdiccion deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	
	
	
	/********************************************************************
	 * 
	 * 
	 *  RequestAction
	 * 
	 * 
	 */
	
	function get_name($id){
		$this->Jurisdiccion->recursive = -1;
		$varaux = $this->Jurisdiccion->read(null,$id);
		return $varaux['Jurisdiccion']['name'];
	}
	
	
	function planofertajuris(){
		$sql = "select distinct	j.name as jurisdiccion, count(p.id) as total,
								sum( CASE WHEN (p.oferta_id = 1) THEN (1) ELSE	(0) END ) as FP,
								sum( CASE WHEN (p.oferta_id = 2) THEN (1) ELSE	(0) END ) as IT,
								sum( CASE WHEN (p.oferta_id = 3) THEN (1) ELSE	(0)	END ) as SEC_TEC,
								sum( CASE WHEN (p.oferta_id = 4) THEN (1) ELSE	(0) END ) as SUP_TEC /*,
								sum( CASE WHEN (p.oferta_id = 5) THEN (1) ELSE	(0) END ) as SEC,
								sum( CASE WHEN (p.oferta_id = 6) THEN (1) ELSE	(0)	END ) as SUP,
								sum( CASE WHEN (p.oferta_id = 7) THEN (1) ELSE	(0)	END ) as CL */
				from instits i
				left join departamentos d on (d.id = i.departamento_id)
				left join localidades l on (l.id = i.localidad_id)
				left join jurisdicciones j on (j.id = i.jurisdiccion_id)
				left join tipoinstits t on (i.tipoinstit_id = t.id)
				left join gestiones g on (g.id = i.gestion_id)
				left join planes p on (i.id = p.instit_id)
				left join ofertas o on (p.oferta_id = o.id)
				left join anios a on (p.id = a.plan_id)
				left join sectores s on (p.sector_id = s.id)
				where  i.activo = 1 
				AND	a.ciclo_id = 2009
				group by j.name";
		
		$jus_aux = $this->Jurisdiccion->query($sql);
		$jus = array();
		foreach($jus_aux as $key=>$value) {
			$jus[] = $value[0];
		}
		
		$headers= array();
		foreach($jus_aux[0][0] as $key=>$value) {
			$name= $key;
			switch($name) {
				case "jurisdiccion":
					$headers[] = "Jurisdicción";
					break;
				case "total":
					$headers[] = "Total";
					break;
				case "fp":
					$headers[] = "Formación Profesional";
					break;
				case "it":
					$headers[] = "Itinerario";
					break;
				case "sec_tec":
					$headers[] = "Secundario Técnico";
					break;
				case "sup_tec":
					$headers[] = "Superior Técnico";
					break;
				default:
					$headers[] = $name;
			}
		}
		
		$this->set('jurisdicciones', $jus);
		$this->set('headers', $headers);
	}
}
?>