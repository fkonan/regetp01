<?php
set_time_limit(60*60*0.5); // media hora de ejecucion limite

class FondoTemporalesController extends AppController {

	var $name = 'FondoTemporales';
	var $helpers = array('Html', 'Form', 'Paginator');
        var $instits=NULL;
        var $tipoInstits=NULL;
        var $localidades=NULL;
        var $lineasDeAccion=NULL;
        var $components = array('RequestHandler');

        /*function beforeFilter() {
            parent::beforeFilter();
            
            $this->Instits = ClassRegistry::init("Instit");
            $this->Instits->recursive = 1;
            $this->instits = $this->Instits->find("all", array(
                        'limit'=>'50', // SACAR!
                        'fields'=> array('cue','nombre','nroinstit')));

            //$this->tipoInstits = $this->Instits->Tipoinstit->find("all", array(
            //            'limit'=>'5')); // SACAR!
        }*/

	function index() {
		$this->FondoTemporal->recursive = 0;
                $this->paginate = array('conditions'=>array('tipo'=>array('i','j')));
                $this->set('fondos', $this->paginate());
	}

        function checked_instits() {
                $checkedTotals = null;
                $checkedInstit = null;
                
		$this->FondoTemporal->recursive = 0;

                if (@is_numeric($this->passedArgs['checkedInstit'])) {
                    $checkedInstit = $this->passedArgs['checkedInstit'];
                    $checkedTotals = null;
                }
                elseif(@is_numeric($this->passedArgs['checkedTotals'])){
                    $checkedTotals = $this->passedArgs['checkedTotals'];
                    $checkedInstit = null;
                }
                
                if($checkedInstit != null){
                    $this->paginate = array('conditions'=>array('tipo'=>'i', 'cue_checked'=>$checkedInstit),
                                            'contain'=>array('Instit'=>array('Tipoinstit(name)')));
                }
                else{
                    $this->paginate = array('conditions'=>array('tipo'=>array('i','j'), 'totales_checked'=>$checkedTotals),
                                            'contain'=>array('Instit'=>array('Tipoinstit(name)')));
                }

                $this->set('fondos', $this->paginate());
                $this->set('checkedInstit', $checkedInstit);
                $this->set('checkedTotals', $checkedTotals);
	}

        function error_report() {
                $report = '';
                $fondoInfo = '';
                $fondoError = '';
                $i = 1;
                
         	$this->FondoTemporal->recursive = 0;

                $fondos = $this->FondoTemporal->find("all",
                            array('conditions'=>array('tipo'=>array('i','j'), "OR" => array('cue_checked'=>2, 'totales_checked'=>array(2,3))), 'order' => array('anio,trimestre,linea')));
                foreach ($fondos as $fondo){
                    $fondoInfo =  "Año: " . $fondo['FondoTemporal']['anio'] . " " .
                                  "Trimestre: " . $fondo['FondoTemporal']['trimestre'] . " " .
                                  "Linea del Excel: " . $fondo['FondoTemporal']['linea'] . " - ";
                    $difference = abs($fondo['FondoTemporal']['f01'] +
                                  $fondo['FondoTemporal']['f02a'] +
                                  $fondo['FondoTemporal']['f02b'] +
                                  $fondo['FondoTemporal']['f02c'] +
                                  $fondo['FondoTemporal']['f03a'] +
                                  $fondo['FondoTemporal']['f03b'] +
                                  $fondo['FondoTemporal']['f04'] +
                                  $fondo['FondoTemporal']['f05'] +
                                  $fondo['FondoTemporal']['f06a'] +
                                  $fondo['FondoTemporal']['f06b'] +
                                  $fondo['FondoTemporal']['f06c'] +
                                  $fondo['FondoTemporal']['f07a'] +
                                  $fondo['FondoTemporal']['f07b'] +
                                  $fondo['FondoTemporal']['f07c'] +
                                  $fondo['FondoTemporal']['f08'] +
                                  $fondo['FondoTemporal']['f09'] +
                                  $fondo['FondoTemporal']['f10'] +
                                  $fondo['FondoTemporal']['f10'] +
                                  $fondo['FondoTemporal']['equipinf'] +
                                  $fondo['FondoTemporal']['refaccion'] -
                                  $fondo['FondoTemporal']['total']);

                    if($fondo['FondoTemporal']['cue_checked'] == 2){
                        $fondoError = $i . "-" . $fondoInfo .
                                      "El CUE:" . $fondo['FondoTemporal']['cuecompleto']  . " se encuentra en duda \r\n";
                    
                        $i++;
                    }

                    if($fondo['FondoTemporal']['totales_checked'] == 2 || $fondo['FondoTemporal']['totales_checked'] == 3){
                        $fondoError = $fondoError . $i . "-" . $fondoInfo .
                                      "La suma de las lineas de acción tienen una diferencia de $" . $difference  . " con el total \r\n";
                    
                        $i++;
                    }

                }
                
                $report = $report . $fondoError;
                
                $this->set('report', $report);
	}

        function observacion_report() {
                $report = '';
                $fondoInfo = '';
                $fondoError = '';
                $i = 1;

         	$this->FondoTemporal->recursive = 0;

                $fondos = $this->FondoTemporal->find("all",
                            array('conditions'=>array('totales_checked = 1',"FondoTemporal.observacion != ''")));
                
                foreach ($fondos as $fondo){
                    $fondoInfo =  "Año: " . $fondo['FondoTemporal']['anio'] . " " .
                                  "Trimestre: " . $fondo['FondoTemporal']['trimestre'] . " " .
                                  "Linea del Excel: " . $fondo['FondoTemporal']['linea'];

                    $report = $report . $fondoInfo . "\r\n-----------------------------------------------------------------\r\n" . $fondo['FondoTemporal']['observacion'] . "\r\n";
                }


                $this->set('report', $report);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FondoTemporal.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('fondo', $this->FondoTemporal->read(null, $id));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FondoTemporal', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->FondoTemporal->save($this->data)) {
				$this->Session->setFlash(__('The FondoTemporal has been saved', true));
				$this->redirect(array('action'=>'checked_instits'));
			} else {
				$this->Session->setFlash(__('The FondoTemporal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FondoTemporal->read(null, $id);
		}

                $difference = $this->data['FondoTemporal']['f01'] +
                             $this->data['FondoTemporal']['f02a'] +
                             $this->data['FondoTemporal']['f02b'] +
                             $this->data['FondoTemporal']['f02c'] +
                             $this->data['FondoTemporal']['f03a'] +
                             $this->data['FondoTemporal']['f03b'] +
                             $this->data['FondoTemporal']['f04'] +
                             $this->data['FondoTemporal']['f05'] +
                             $this->data['FondoTemporal']['f06a'] +
                             $this->data['FondoTemporal']['f06b'] +
                             $this->data['FondoTemporal']['f06c'] +
                             $this->data['FondoTemporal']['f07a'] +
                             $this->data['FondoTemporal']['f07b'] +
                             $this->data['FondoTemporal']['f07c'] +
                             $this->data['FondoTemporal']['f08'] +
                             $this->data['FondoTemporal']['f09'] +
                             $this->data['FondoTemporal']['f10'] +
                             $this->data['FondoTemporal']['f10'] +
                             $this->data['FondoTemporal']['equipinf'] +
                             $this->data['FondoTemporal']['refaccion'] -
                             $this->data['FondoTemporal']['total'];

		$instits = $this->FondoTemporal->Instit->find('list');
		$jurisdicciones = $this->FondoTemporal->Jurisdiccion->find('list');
                $error = $this->data['FondoTemporal']['observacion'] . date('d-m-Y H:i') . " - " . "La suma de las lineas de acción tienen una diferencia de $" . abs($difference)  . " con el total \r\n";
		//$lineasDeAcciones = $this->FondoTemporal->LineasDeAccion->find('list');
		$this->set('difference', $difference);
                $this->set('error', $error);
                $this->set(compact('instits','jurisdicciones'));//,'lineasDeAcciones'));
	}

        function edit_cue($id = null) {
		if (!$id && empty($this->data)) {
                        $this->Session->setFlash(__('Invalid FondoTemporal', true));
			$this->redirect(array('action'=>'checked_instits'));
		}
		if (!empty($this->data)) {
                        debug($this->data);
                        if ($this->FondoTemporal->save($this->data)) {
				$this->Session->setFlash(__('The FondoTemporal has been saved', true));
				$this->redirect(array('action'=>'checked_instits'));
			} else {
				$this->Session->setFlash(__('The FondoTemporal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FondoTemporal->read(null, $id);
                }

		$allinstits = $this->FondoTemporal->Instit->find('list');
		$posible_jurisdicciones = $this->FondoTemporal->Jurisdiccion->find('list');

                $this->set(compact('allinstits','posible_jurisdicciones'));
	}

        function search_instits($q = null){
            $this->autoRender = false;
            
            if ( $this->RequestHandler->isAjax() ) {
              Configure::write ( 'debug', 0 );
            }
            
            $response = '';
            
            if(empty($q)) {
                if (!empty($this->params['url']['q'])) {
                    $q = utf8_decode(strtolower($this->params['url']['q']));
                } else {
                    return utf8_encode("parámetro vacio");
                }
            }

            if(is_numeric($q)){
                $items = $this->FondoTemporal->Instit->find("all", array(
                    'contain'=> array(
                        'Tipoinstit', 'Jurisdiccion', 'HistorialCue'
                    ),
                    'conditions'=> array(
                        "to_char(cue*100+anexo, 'FM999999999FM') SIMILAR TO ?" => "%". $q ."%"
                        
                    )
                ));

                /*$cues_h = $this->FondoTemporal->Instit->HistorialCue->find("all", array(
                    'conditions'=> array(
                        "OR"=>array(
                        "cue = ?" => $q,
                        "(cue * 100 + anexo) = ?" => $q )
                    )
                ));*/

            }
            else{
                $items = $this->FondoTemporal->Instit->find("all", array(
                    'contain'=> array(
                        'Tipoinstit', 'Jurisdiccion', 'HistorialCue'
                    ),
                    'conditions'=> array(
                        "(lower(Tipoinstit.name) || lower(Instit.nombre)) SIMILAR TO ?" => $this->FondoTemporal->Instit->convertir_para_busqueda_avanzada($q)
                    )
                ));
            }

            $result = array();

            foreach ($items as $item) {
                $cuecompleto = $item['Instit']['cue']*100+$item['Instit']['anexo'];
                
                array_push($result, array(
                        "id" => $item['Instit']['id'],
                        "cue" => $item['Instit']['cue']*100+$item['Instit']['anexo'],
                        "nombre" => utf8_encode($item['Instit']['nombre']),
                        "nroinstit" => utf8_encode($item['Instit']['nroinstit']),
                        "anio_creacion" => utf8_encode($item['Instit']['anio_creacion']),
                        "direccion" => utf8_encode($item['Instit']['direccion']),
                        "depto" => utf8_encode($item['Instit']['depto']),
                        "localidad" => utf8_encode($item['Instit']['localidad']),
                        "cp" => utf8_encode($item['Instit']['cp']),
                        "tipo" => utf8_encode($item['Tipoinstit']['name']),
                        "jurisdiccion" => utf8_encode($item['Jurisdiccion']['name']),
                        "cue_anterior" => utf8_encode($item['HistorialCue'][0]['cue'])
                ));
            }

            echo json_encode($result);

            //echo $response;

        }

        function uncheckInstit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FondoTemporal', true));
                }
                else {
                    $this->data = $this->FondoTemporal->read(null, $id);
                    if (!empty($this->data)) {
                        $this->data['FondoTemporal']['cue_checked'] = 0;
                        if ($this->FondoTemporal->save($this->data)) {
                        } else {
                                $this->Session->setFlash(__('El FondoTemporal id '.$fondo['FondoTemporal']['id'].' no pudo ser actualizado.', true));
                        }
                    }
                }

                $this->redirect(array('action'=>'checked_instits'));
	}

        function checkInstit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FondoTemporal', true));
                }
                else {
                    $this->data = $this->FondoTemporal->read(null, $id);
                    if (!empty($this->data)) {
                        $this->data['FondoTemporal']['cue_checked'] = 1;
                        if ($this->FondoTemporal->save($this->data)) {
                        } else {
                                $this->Session->setFlash(__('El FondoTemporal id '.$fondo['FondoTemporal']['id'].' no pudo ser actualizado.', true));
                        }
                    }
                }

                $this->redirect(array('action'=>'checked_instits', 'checked'=>'2'));
	}

        function uncheckTotals($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FondoTemporal', true));
                }
                else {
                    $this->data = $this->FondoTemporal->read(null, $id);
                    if (!empty($this->data)) {
                        $this->data['FondoTemporal']['totales_checked'] = 0;
                        if ($this->FondoTemporal->save($this->data)) {
                        } else {
                                $this->Session->setFlash(__('El FondoTemporal id '.$fondo['FondoTemporal']['id'].' no pudo ser actualizado.', true));
                        }
                    }
                }

                $this->redirect(array('action'=>'checked_instits'));
	}

        function checkTotals($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FondoTemporal', true));
                }
                else {
                    $this->data = $this->FondoTemporal->read(null, $id);
                    if (!empty($this->data)) {
                        $this->data['FondoTemporal']['totales_checked'] = 1;
                        if ($this->FondoTemporal->save($this->data)) {
                        } else {
                                $this->Session->setFlash(__('El FondoTemporal id '.$fondo['FondoTemporal']['id'].' no pudo ser actualizado.', true));
                        }
                    }
                }

                $this->redirect(array('action'=>'checked_instits', 'checked'=>'2'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for FondoTemporal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FondoTemporal->del($id)) {
			$this->Session->setFlash(__('FondoTemporal deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


        function validar_instits() {
            $this->FondoTemporal->recursive = 0;
            $fondos = $this->FondoTemporal->find("all",
                            array('conditions'=> array('tipo'=>'i', 'cue_checked'=>0),
                                  'order'=> array('FondoTemporal.jurisdiccion_id')));
                                  //'limit'=>'500'));

            $this->Instits = ClassRegistry::init("Instit");
            $this->Instits->recursive = 0;
            $this->Instits->Tipoinstit->recursive = 0;
            $this->Instits->Departamento->Localidad->recursive = 0;

            $jurisdiccion_id = '';

            // todas las localidades (solo una vez)
            $localidades = $this->Instits->Departamento->Localidad->find('all', array(
                                'order'=> array('LENGTH(Localidad.name)'=>'desc')
                            ));
            
            // auditoria
            $instits_checked = $instits_en_duda = $instits_no_checked = 0;

            if (count($fondos))
            {
                foreach ($fondos as $fondo)
                {
                    $cue_checked = $instit_checked = false;
                    $en_duda_instit_id = '';

                    // 1. Acota proceso a Jurisdiccion con jurisdiccion_id
                    if ($jurisdiccion_id != $fondo['FondoTemporal']['jurisdiccion_id'])
                    {
                        // si cambia la jurisdiccion re-setea la coleccion de instits con
                        // la que va a trabajar
                        $jurisdiccion_id = $fondo['FondoTemporal']['jurisdiccion_id'];
                        
                        // acota a instits de esta jurisdiccion
                        $this->instits = $this->Instits->find("all", array(
                        'conditions'=> array('Instit.jurisdiccion_id' => $jurisdiccion_id),
                        'fields'=> array('id','cue','nombre','nroinstit','anexo')));
                        
                        // trae todos los tipoInstits de esta jurisdiccion ordenados por cantidad de
                        $this->tipoInstits = $this->Instits->Tipoinstit->find("all", array(
                                'conditions'=> array('jurisdiccion_id' => $jurisdiccion_id),
                                'order'=> array('LENGTH(Tipoinstit.name)'=>'desc')
                            ));

                        //$localidades = $this->Instits->Departamento->Localidad->con_depto_y_jurisdiccion('all',$jurisdiccion_id);
                    }

                    // instit_name tiene prioridad, viene mas completo
                    if (strlen($fondo['FondoTemporal']['instit_name'])) {
                        $text = $fondo['FondoTemporal']['instit_name'];
                    }
                    elseif (strlen($fondo['FondoTemporal']['instit'])) {
                        $text = $fondo['FondoTemporal']['instit'];
                    }
                    else {
                        $text = '';
                    }

                    // 2. Compara CUEs
                    if (strlen($fondo['FondoTemporal']['cuecompleto']))
                    {
                        // valida por nro de CUE
                        $instit = $this->FondoTemporal->getInstitByCueIncompleto($this->instits, $fondo['FondoTemporal']['cuecompleto']);

                        if ($instit)
                        {
                            // el CUE fue encontrado
                            // chequea el numero y tipo de instit
                            if ($this->FondoTemporal->compara_numeroInstit($text, $instit['Instit']['nroinstit']))
                            {
                                if ($this->FondoTemporal->compara_tipoInstit($text, $this->tipoInstits))
                                {
                                    $instit_checked = true;
                                    $instits_checked++;

                                    // edita cue_checked en 1 y asigna instit_id
                                    $this->FondoTemporal->setObservacion($fondo, "Instit checked. Coincidieron CUE, número y tipo.");
                                    $this->FondoTemporal->asignarInstitYEstadoATemp($instit['Instit']['id'], 1, $fondo['FondoTemporal']['id'], $fondo['FondoTemporal']['observacion']);
                                }
                                elseif ($this->FondoTemporal->compara_institNombres($text, $instit['Instit']['nombre'], $this->tipoInstits, $localidades)) {
                                    // tienen el mismo nombre
                                    $instit_checked = true;

                                    // edita cue_checked en 1 y asigna instit_id
                                    $this->FondoTemporal->setObservacion($fondo, "Instit checked. Coincidieron CUE, número y nombre, NO tipo.");
                                    $this->FondoTemporal->asignarInstitYEstadoATemp($instit['Instit']['id'], 1, $fondo['FondoTemporal']['id'], $fondo['FondoTemporal']['observacion']);

                                    $instits_checked++;
                                }
                                else {
                                    $this->FondoTemporal->setObservacion($fondo, "La institucion se encuentra en duda. Coincide CUE, no coincidieron tipo y nombre.");
                                }
                            }
                            else {
                                $this->FondoTemporal->setObservacion($fondo, "La institucion se encuentra en duda. Coincide CUE, no coincide número.");
                            }
                            
                            if (!$instit_checked)
                            {
                                // edita cue_checked en 2 (duda)
                                /*$this->FondoTemporal->asignarInstitYEstadoATemp($instit['Instit']['id'], 2, $fondo['FondoTemporal']['id'], $fondo['FondoTemporal']['observacion']);
                                $instits_en_duda++;*/
                                $en_duda_instit_id = $instit['Instit']['id'];
                            }

                            $cue_checked = true;
                        }
                        else {
                            $this->FondoTemporal->setObservacion($fondo, "El CUE no existe en el registro.");
                        }
                    }

                    if (!$instit_checked)
                    {
                        $instit_checked = false;
                        if (strlen($text))
                        {
                            // compara nombres
                            if (count($this->instits)) {
                                foreach ($this->instits as $instit)
                                {
                                    // chequea el numero de instit
                                    if ($this->FondoTemporal->compara_numeroInstit($text, $instit['Instit']['nroinstit']))
                                    {
                                        if ($this->FondoTemporal->compara_institNombres($text, $instit['Instit']['nombre'], $this->tipoInstits, $localidades)) {
                                            // tienen el mismo nombre
                                            $instit_checked = true;
                                            
                                            $instits_checked++;
                                            
                                            // edita cue_checked en 1 y asigna instit_id
                                            $this->FondoTemporal->setObservacion($fondo, "Instit checked. Coinciden número y nombre.");
                                            $this->FondoTemporal->asignarInstitYEstadoATemp($instit['Instit']['id'], 1, $fondo['FondoTemporal']['id'], $fondo['FondoTemporal']['observacion']);

                                            break;
                                        }
                                    }
                                }
                            }
                        }

                        if (!$instit_checked) {
                            if ($en_duda_instit_id) {
                                // edita cue_checked en 2 (duda)
                                $this->FondoTemporal->asignarInstitYEstadoATemp($en_duda_instit_id, 2, $fondo['FondoTemporal']['id'], $fondo['FondoTemporal']['observacion']);
                                $instits_en_duda++;
                            }
                            else {
                                // edita cue_checked en 0
                                $this->FondoTemporal->setObservacion($fondo, "La institucion no pudo ser chequeada.");
                                $this->FondoTemporal->asignarInstitYEstadoATemp(0, 0, $fondo['FondoTemporal']['id'], $fondo['FondoTemporal']['observacion']);
                                $instits_no_checked++;
                            }
                        }
                    }
                }
            }

            $mensaje = "Instits checkeds: " . $instits_checked .
            "; Instits en duda: " . $instits_en_duda .
            "; Instits NO checked: " .  $instits_no_checked;

            $this->Session->setFlash(__($mensaje, true));
	    $this->redirect(array('action'=>'checked_instits'));
	}

        
        function validar_totales() {
            $totalSmallDiference = 10;
            $total = 0;

            $this->FondoTemporal->recursive = 0;

            /*VALIDACION HORIZONTAL*/
            $fondos = $this->FondoTemporal->find("all",
                            array('conditions'=> array("OR"=> array("tipo = 'i'","tipo='j'"), 'totales_checked'=>0)));
            
            foreach ($fondos as &$fondo){
                    $totales_checked = false;

                    $total = abs($fondo['FondoTemporal']['f01'] +
                             $fondo['FondoTemporal']['f02a'] +
                             $fondo['FondoTemporal']['f02b'] +
                             $fondo['FondoTemporal']['f02c'] +
                             $fondo['FondoTemporal']['f03a'] +
                             $fondo['FondoTemporal']['f03b'] +
                             $fondo['FondoTemporal']['f04'] +
                             $fondo['FondoTemporal']['f05'] +
                             $fondo['FondoTemporal']['f06a'] +
                             $fondo['FondoTemporal']['f06b'] +
                             $fondo['FondoTemporal']['f06c'] +
                             $fondo['FondoTemporal']['f07a'] +
                             $fondo['FondoTemporal']['f07b'] +
                             $fondo['FondoTemporal']['f07c'] +
                             $fondo['FondoTemporal']['f08'] +
                             $fondo['FondoTemporal']['f09'] +
                             $fondo['FondoTemporal']['f10'] +
                             $fondo['FondoTemporal']['equipinf']+
                             $fondo['FondoTemporal']['refaccion'] -
                             $fondo['FondoTemporal']['total']);

                    /*Total Chequeado*/
                    if($total == 0){
                        $fondo['FondoTemporal']['totales_checked'] = 1;
                    }/*Total con diferencia pequeña ---> Ajuste*/
                    elseif($total < $totalSmallDiference){
                        $fondo['FondoTemporal']['totales_checked'] = 2;

                        if(strlen($this->data['FondoTemporal']['observacion']) > 0){
                            $error = $this->data['FondoTemporal']['observacion'] . "\r\n" . date('d-m-Y H:i') . " - " . "La suma de las lineas de acción tienen una diferencia de $" . abs($difference)  . " con el total \r\n";
                        }
                        else{
                            $error = date('d-m-Y H:i') . " - " . "La suma de las lineas de acción tienen una diferencia de $" . abs($total)  . " con el total \r\n";
                        }

                    }/*Total con diferencia grande*/
                    else{
                        $fondo['FondoTemporal']['totales_checked'] = 3;

                        if(strlen($this->data['FondoTemporal']['observacion']) > 0){
                            $error = $this->data['FondoTemporal']['observacion'] . "\r\n" . date('d-m-Y H:i') . " - " . "La suma de las lineas de acción tienen una diferencia de $" . abs($difference)  . " con el total \r\n";
                        }
                        else{
                            $error = date('d-m-Y H:i') . " - " . "La suma de las lineas de acción tienen una diferencia de $" . abs($total)  . " con el total \r\n";
                        }
                    }
            }
            
            $this->FondoTemporal->saveAll($fondos);

            $this->redirect(array('action'=>'checked_instits'));
        }
}
?>
