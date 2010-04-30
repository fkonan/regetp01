<?php
set_time_limit(60*60*0.5); // media hora de ejecucion limite

class FondoTemporalesController extends AppController {

	var $name = 'FondoTemporales';
	var $helpers = array('Html', 'Form', 'Paginator');
        var $instits=NULL;
        var $tipoInstits=NULL;
        var $localidades=NULL;
        var $lineasDeAccion=NULL;

        function beforeFilter() {
            parent::beforeFilter();
            
            $this->Instits = ClassRegistry::init("Instit");
            $this->Instits->recursive = 1;
            $this->instits = $this->Instits->find("all", array(
                        'limit'=>'50', // SACAR!
                        'fields'=> array('cue','nombre','nroinstit')));

            //$this->tipoInstits = $this->Instits->Tipoinstit->find("all", array(
            //            'limit'=>'5')); // SACAR!
        }

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
                
                if(!empty($checkedInstit)){
                    $this->paginate = array('conditions'=>array('tipo'=>'i', 'cue_checked'=>$checkedInstit));
                }
                else{
                    $this->paginate = array('conditions'=>array('tipo'=>'i', 'totales_checked'=>$checkedTotals));
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
                            array('conditions'=>array('tipo'=>'i', "OR" => array('cue_checked'=>2, 'totales_checked'=>array(2,3)))));

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
		//$lineasDeAcciones = $this->FondoTemporal->LineasDeAccion->find('list');
		$this->set('difference', $difference);
                $this->set(compact('instits','jurisdicciones'));//,'lineasDeAcciones'));
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
                                  'order'=> array('FondoTemporal.jurisdiccion_id'),
                                  'limit'=>'500'));

            $this->Instits = ClassRegistry::init("Instit");
            $this->Instits->recursive = 0;
            $this->Instits->Tipoinstit->recursive = 0;
            $this->Instits->Departamento->recursive = 0;

            $jurisdiccion_id = '';

            // auditoria
            $instits_checked = $instits_en_duda = $instits_no_checked = 0;

            if (count($fondos))
            {
                foreach ($fondos as $fondo)
                {
                    $cue_checked = $instit_checked = false;

                    // 1. Acota proceso a Jurisdiccion con jurisdiccion_id
                    if ($jurisdiccion_id != $fondo['FondoTemporal']['jurisdiccion_id'])
                    {
                        // si cambia la jurisdiccion re-setea la coleccion de instits con
                        // la que va a trabajar
                        $jurisdiccion_id = $fondo['FondoTemporal']['jurisdiccion_id'];
                        
                        // acota a instits de esta jurisdiccion
                        $this->instits = $this->Instits->find("all", array(
                        'conditions'=> array('Instit.jurisdiccion_id' => $jurisdiccion_id),
                        'fields'=> array('id','cue','nombre','nroinstit','anexo'),
                        'contain'=>array('Localidad(name)','Tipoinstit(name)'=>array('Jurisdiccion(name)'))));

                        // trae todos los tipoInstits de esta jurisdiccion ordenados por cantidad de
                        $this->tipoInstits = $this->Instits->Tipoinstit->find("all", array(
                                'conditions'=> array('jurisdiccion_id' => $jurisdiccion_id),
                                'order'=> array('LENGTH(Tipoinstit.name)'=>'desc')
                            ));
                        //$localidades = $this->Instits->Departamento->Localidad->con_depto_y_jurisdiccion('all',$jurisdiccion_id);
                    }

                    // 2. Compara CUEs
                    if (strlen($fondo['FondoTemporal']['cuecompleto']))
                    {
                        // valida por nro de CUE
                      /* $instit = $this->Instits->find("all",array(
                            'conditions'=> array('"cue"*100+"anexo"'=>$fondo['FondoTemporal']['cuecompleto'],
                                                'Instit.jurisdiccion_id' => $jurisdiccion_id),
                            'fields'=> array('id','cue','nombre','nroinstit','tipoinstit_id'),
                            'contain'=>array('Localidad(name)','Tipoinstit(name)'=>array('Jurisdiccion(name)')
                            )));
                       */
                        $instit = $this->getInstitByCueIncompleto($this->instits, $fondo['FondoTemporal']['cuecompleto']);

                        if ($instit)
                        {
                            // el CUE fue encontrado
                            pr($instit);

                            $text = $fondo['FondoTemporal']['instit'];

                            $string_procesado = $this->optimizar_cadena($text);
                            $array_words = explode(" ", $string_procesado);
                       pr($string_procesado);
                            // chequea el numero y tipo de instit
                            if ($this->compara_numeroInstit($array_words, $instit['Instit']['nroinstit']))
                            {
                                if ($this->compara_tipoInstit($string_procesado, $this->tipoInstits)) 
                                {
                                    echo "<br>CUE coincide, TIPO y NRO coinciden!";
                                    $instit_checked = true;
                                    $instits_checked++;

                                    // edita cue_checked en 1 y asigna instit_id
                                    $this->asignarInstitYEstadoATemp($instit['Instit']['id'], 1, $fondo['FondoTemporal']['id']);
                                }
                                else
                                {
                                    $string_procesado_aux = $this->optimizar_cadena($instit['Instit']['nombre_completo']);
                                    $string_procesado_aux = $this->str_sin_tipoInstit($string_procesado_aux, $this->tipoInstits);

                                    $array_words_aux = explode(" ", $string_procesado_aux);

                                    if ($string_procesado == $string_procesado_aux ||
                                        $this->compara_institNombres($array_words, $array_words_aux)) {
                                        // tienen el mismo nombre
                                        $instit_checked = true;
                                        echo "<br>NOMBRES Y NUMERO COINCIDEN!!! asigna 1";

                                        // edita cue_checked en 1 y asigna instit_id
                                        $this->asignarInstitYEstadoATemp($instit['Instit']['id'], 1, $fondo['FondoTemporal']['id']);

                                        $instits_checked++;
                                    }
                                }
                            }
                            
                            if (!$instit_checked)
                            {
                                // edita cue_checked en 2 (duda)
                                $this->asignarInstitYEstadoATemp($instit['Instit']['id'], 2, $fondo['FondoTemporal']['id']);
                                $instits_en_duda++;
                                echo "asigna 2<br>";
                                pr($array_words);
                            }

                            $cue_checked = true;
                        }
                    }

                    if (!$cue_checked)
                    {
                        echo "<br>CUE NO coincide!";
                        $instit_checked = false;
                        if (strlen($fondo['FondoTemporal']['instit']))
                        {
                            // compara nombres
                            $text = $fondo['FondoTemporal']['instit'];

                            $string_procesado = $this->optimizar_cadena($text);
                            $string_procesado = $this->str_sin_tipoInstit($string_procesado, $this->tipoInstits);
                            $array_words = explode(" ", $string_procesado);

                            if (count($this->instits)) {
                                foreach ($this->instits as $instit)
                                {
                                    $string_procesado_aux = $this->optimizar_cadena($instit['Instit']['nombre_completo']);
                                    $string_procesado_aux = $this->str_sin_tipoInstit($string_procesado_aux, $this->tipoInstits);

                                    $array_words_aux = explode(" ", $string_procesado_aux);

                                    // chequea el numero de instit
                                    if ($this->compara_numeroInstit($array_words, $instit['Instit']['nroinstit'])) 
                                    {
                                        if ($string_procesado == $string_procesado_aux || 
                                            $this->compara_institNombres($array_words, $array_words_aux)) {
                                            // tienen el mismo nombre
                                            $instit_checked = true;
                                            echo "<br>NOMBRES Y NUMERO COINCIDEN!!!";
                                            $instits_checked++;
                                            
                                            // edita cue_checked en 1 y asigna instit_id
                                            $this->asignarInstitYEstadoATemp($instit['Instit']['id'], 1, $fondo['FondoTemporal']['id']);

                                            break;
                                        }
                                    }

                                    // si el name de la tabla Tipoinstit contiene parte del nombre
                                    /*if ($this->compara_tipoInstit($string_procesado, $this->tipoInstits)) {

                                    }*/
                                }
                            }
                        }

                        if (!$instit_checked) {
                            $instits_no_checked++;
                            echo $string_procesado;
                        }
                    }
                }
            }
            
            $this->set('instits_checked', $instits_checked);
            $this->set('instits_en_duda', $instits_en_duda);
            $this->set('instits_no_checked', $instits_no_checked);
	}

        function getCueCompleto($cueincompleto, $anexo=0) {
            return $cueincompleto*100 + $anexo;
        }

        function getInstitByCueIncompleto($instits, $cue_incompleto) {
            foreach ($instits as $k=>$instit) {
                if ($instit['Instit']['cue']*100+$instit['Instit']['anexo'] == $cue_incompleto)
                {
                    return $instit;
                }
            }
        }

        function asignarInstitYEstadoATemp($instit_id, $estado, $temp_id) {
            /*$this->data = $this->FondoTemporal->read(null, $temp_id);
            if (!empty($this->data)) {
                $this->data['FondoTemporal']['cue_checked'] = $estado;
                $this->data['FondoTemporal']['instit_id'] = $instit_id;
                if ($this->FondoTemporal->save($this->data)) {
                } else {
                        $this->Session->setFlash(__('El FondoTemporal id '.$temp_id.' no pudo ser actualizado.', true));
                }
            }
            */
            // evita un select gigante en cada update
            $this->FondoTemporal->query("UPDATE z_fondo_work SET cue_checked=".$estado.", instit_id=".$instit_id." WHERE id=".$temp_id.";");
        }

        

        /**
	 *
	 * compara dos nombres de instit sin tipo ni numero
	 *
	 * @param $array_words_temp
         * @param $array_words
	 */
        function compara_InstitNombres($array_words_temp, $array_words)
        {
            // ordena un vector por length de palabras desc
            //usort($array_words_temp, array("FondoTemporalesController", "length_cmp"));

            // quitar N° , comparar cada posicion con todas las de array_words
            $palabras_totales = count($array_words_temp);
            $peso = 0;
            for ($i=0; $i < count($array_words_temp); $i++) {
                // que no sea nº
                /*$pos_temp = strpos($array_words_temp[$i],'nº');
                if ($pos_temp === false) {*/
                    foreach ($array_words as $array_word) {
                        if ($array_words_temp[$i] == $array_words) {
                            $peso++;
                        }
                        elseif (strlen($array_word) >= 4 && strlen($array_words_temp[$i]) >= 4) {
                            if (levenshtein($array_words_temp[$i], $array_word) <= 1) {
                                $peso++;
                            }
                        }
                    }
               /* }
                else {
                    $palabras_totales--;
                }*/
            }

            if (count($array_words) > count($array_words_temp)) {
                $limit = count($array_words);
            } else {
                $limit = count($array_words_temp);
            }

            // compara limit con el peso encontrado
            if ($peso > 0 && $peso > $limit/2) {
                pr($array_words_temp);
                pr($array_words);

                echo "TRUE! limit: ".$limit."   -   peso: ".$peso;
                return true;
            }
            
            return false;
        }

        function length_cmp( $a, $b ) {
            return strlen($b)-strlen($a);
        }


        /**
	 *
	 * compara el nro de instit que viene en el array de words con el enviado
         * por parametro
	 *
	 * @param $words
         * @param $nroinstit
	 */
        function compara_numeroInstit($words, $nroinstit) {
            $numero = '';

            foreach ($words as $value1) {
                // busca por nº
                $pos = strpos($value1,'nº');
                if ($pos !== false) {
                    $numero = str_replace('nº','',$value1);
                    break;
                }
                else
                {
                    // busca por A- (privados)
                    $pos = strpos($value1,'a-');
                    if ($pos !== false) {
                        $numero = $value1;
                        break;
                    }
                }
                
                // busca por D.E.
                /*$pos = strpos($value1,'de');
                if ($pos !== false) {
                    $numero = str_replace('nº','',$value1);
                }*/
            }

            if (!strlen($numero)) {
                // no tiene ningun numero en su nombre
                return true;
            }

            if (is_numeric($numero)) {
                return ((int)$numero == (int)strtolower($nroinstit));
            }
            else {
                return (strtolower($numero) == strtolower($nroinstit));
            }
        }

        /**
	 *
	 * compara el tipo de instit inmerso en el nombre con los tipos existentes
	 *
	 * @param $instit
         * @param $tiposInstit
	 */
        function compara_tipoInstit($instit, $tiposInstit)
        {
            $instit = $this->completa_tipoInstit_abreviados($instit);

            foreach ($tiposInstit as $tipoInstit) {
                $pos = strpos(strtoupper($instit), strtoupper($tipoInstit['Tipoinstit']['name']));
                
                if ($pos !== false)
                {
                    // contiene el TIPO
                    return true;
                }
            }

            return false;

        }

        
        /**
	 *
	 * completa cadena en caso de tener abreviaturas
	 *
	 * @param $instit
	 */
        function completa_tipoInstit_abreviados($instit) {
            $instit = str_replace('.','',strtolower($instit));
            
            $a = array('eet',
                       'escuela de educacion tecnica',
                       'e alternancia',
                       'et agro ',
                       'etagro ',
                       'etagro',
                       'eagro ',
                       'et ',
                       'inspt',
                       'centro ',
                       'cent ',
                       'cfl',
                       'cfp',
                       'centro fp',
                       'centro de formacion profesional',
                       'centro de formacion laboral',
                       'cea',
                       'centro de educacion agricola',
                       'eea',
                       'cfr',
                       'eee',
                       'efa',
                       'efp',
                       'cept',
                       'centro educativo para la produccion total',
                       'centro educativo para la produccion',
                       'cpet',
                       'ies',
                       'iea',
                       'eem',
                       'isfdyt',
                       'isfd y t',
                       'mm',
                       'mision monotecnica',
                       'monotec ',
                       'enet',
                       'isp',
                       'ceder',
                       'ipem',
                       'cens',
                       'copyco',
                       'centro de orientacion profesional y capacitacion obrera',
                       'uep',
                       'iset',
                       'eeat',
                       'cecla',
                       'epet',
                       'epnm',
                       'etp',
                       'itec',
                       'cct',
                       'cemoe',
                       'epea',
                       'cepaho',
                       'ufidet',
                       'eetpi',
                       'eetpa',
                       'ispi'
                );
            
            $b = array("ESCUELA DE EDUCACIÓN TÉCNICA (E.E.T.)",
                       "ESCUELA DE EDUCACIÓN TÉCNICA (E.E.T.)",
                       "ESCUELA DE ALTERNANCIA",
                       "ESCUELA TÉCNICA AGROPECUARIA ",
                       "ESCUELA TÉCNICA AGROPECUARIA ",
                       "ESCUELA TÉCNICA AGROPECUARIA ",
                       "ESCUELA AGROTÉCNICA ",
                       "ESCUELA DE EDUCACIÓN TÉCNICA (E.E.T.) ",
                       "INSTITUTO NACIONAL SUPERIOR DEL PROFESORADO TÉCNICO (I.N.S.P.T.)",
                       "centro ",
                       "CENTRO EDUCATIVO DE NIVEL TERCIARIO (C.E.N.T.) ",
                       "CENTRO DE FORMACIÓN LABORAL",
                       "CENTRO DE FORMACIÓN PROFESIONAL (C.F.P.)",
                       "CENTRO DE FORMACIÓN PROFESIONAL (C.F.P.)",
                       "CENTRO DE FORMACIÓN PROFESIONAL (C.F.P.)",
                       "CENTRO DE FORMACIÓN LABORAL",
                       "CENTRO DE EDUCACIÓN AGRÍCOLA (C.E.A.)",
                       "CENTRO DE EDUCACIÓN AGRÍCOLA (C.E.A.)",
                       "ESCUELA DE EDUCACIÓN AGRARIA (E.E.A.)",
                       "CENTRO DE FORMACIÓN RURAL (C.F.R.)",
                       "ESCUELA DE EDUCACIÓN ESPECIAL (E.E.E.)",
                       "ESCUELA DE LA FAMILIA AGRICÓLA (E.F.A.)",
                       "ESCUELA DE FORMACIÓN PROFESIONAL",
                       "CENTRO EDUCATIVO PARA LA PRODUCCIÓN TOTAL (C.E.P.T.)",
                       "CENTRO EDUCATIVO PARA LA PRODUCCIÓN TOTAL (C.E.P.T.)",
                       "CENTRO EDUCATIVO PARA LA PRODUCCIÓN TOTAL (C.E.P.T.)",
                       "COLEGIO PROVINCIAL DE EDUCACIÓN TECNOLÓGICA (C.P.E.T.)",
                       "INSTITUTO DE EDUCACIÓN SUPERIOR (I.E.S.)",
                       "INSTITUTO DE ENSEÑANZA AGROPECUARIA (I.E.A.)",
                       "ESCUELA DE EDUCACIÓN MEDIA (E.E.M.)",
                       "INSTITUTO DE EDUCACIÓN SUPERIOR DE FORMACIÓN DOCENTE Y TÉCNICA (I.S.F.D.yT.)",
                       "INSTITUTO DE EDUCACIÓN SUPERIOR DE FORMACIÓN DOCENTE Y TÉCNICA (I.S.F.D.yT.)",
                       "MISIÓN MONOTÉCNICA (M.M.)",
                       "MISIÓN MONOTÉCNICA (M.M.)",
                       "MISIÓN MONOTÉCNICA (M.M.) ",
                       "ESCUELA NACIONAL DE EDUCACIÓN TÉCNICA (E.N.E.T.)",
                       "INSTITUTO DE EDUCACIÓN SUPERIOR DEL PROFESORADO (I.S.P.)",
                       "CENTRO DE DESARROLLO REGIONAL (CE.DE.R.)",
                       "INSTITUTO PROVINCIAL DE EDUCACIÓN MEDIA (I.P.E.M.)",
                       "CENTRO EDUCATIVO DE NIVEL SECUNDARIO (C.E.N.S.)",
                       "CENTRO DE ORIENTACIÓN PROFESIONAL Y CAPACITACIÓN OBRERA (C.O.P.Y.C.O.)",
                       "CENTRO DE ORIENTACIÓN PROFESIONAL Y CAPACITACIÓN OBRERA (C.O.P.Y.C.O.)",
                       "UNIDAD EDUCATIVA PRIVADA (U.E.P.)",
                       "INSTITUTO DE EDUCACIÓN SUPERIOR DE EDUCACIÓN TÉCNICA (I.S.E.T.)",
                       "ESCUELA DE EDUCACIÓN AGROTÉCNICA (E.E.A.T.)",
                       "CENTRO DE CAPACITACIÓN LABORAL (CE.C.LA.)",
                       "ESCUELA PROVINCIAL DE EDUCACIÓN TÉCNICA (E.P.E.T.)",
                       "ESCUELA PROVINCIAL DE NIVEL MEDIO (E.P.N.M.)",
                       "ESCUELA TÉCNICA PROVINCIAL (E.T.P.)",
                       "INSTITUTO TECNOLÓGICO (I.TEC.)",
                       "CENTRO DE CAPACITACIÓN PARA EL TRABAJO (C.C.T.)",
                       "CENTRO DE MANO DE OBRA ESPECIALIZADA (CE.M.O.E.)",
                       "ESCUELA PROVINCIAL DE EDUCACIÓN AGROPECUARIA (E.P.E.A.)",
                       "CENTRO EDUCATIVO PARA EL HOGAR (CE.PA.HO.)",
                       "UNIDAD DE FORMACIÓN, INVESTIGACIÓN Y DESARROLLO TECNOLÓGICO (U.F.I.D.E.T.)",
                       "ESCUELA DE ENSEÑANZA TÉCNICA PARTICULAR INCORPORADA (E.E.T.P.I.)",
                       "ESCUELA DE EDUCACIÓN TÉCNICA PARTICULAR AUTORIZADA (E.E.T.P.A.)",
                       "INSTITUTO DE EDUCACIÓN SUPERIOR PARTICULAR INCORPORADA (I.S.P.I.)"
                );

            return trim(strtolower(str_replace($a, $b, $instit)));
        }

        /**
	 *
	 * elimina el tipoInstit de la cadena dada
	 *
	 * @param $instit
         * @param $tiposInstit
	 */
        function str_sin_tipoInstit($instit, $tiposInstit)
        {
            foreach ($tiposInstit as $tipoInstit) {
                $b[] = $this->optimizar_cadena($tipoInstit['Tipoinstit']['name']);
            }

            $instit = strtolower(str_replace($b, '', $instit));

            $instit = str_replace('.','',strtolower($instit));

            $a = array('eet',
                       'escuela de educacion tecnica',
                       'e alternancia',
                       'et agro ',
                       'etagro ',
                       'etagro',
                       'eagro ',
                       'et ',
                       'inspt',
                       'cent ',
                       'cfp',
                       'cfl',
                       'centro fp',
                       'cea',
                       'eea',
                       'cfr',
                       'eee',
                       'efa',
                       'efp',
                       'cept',
                       'cpet',
                       'ies',
                       'iea',
                       'eem',
                       'isfdyt',
                       'isfd y t',
                       'mm',
                       'enet',
                       'isp',
                       'ceder',
                       'ipem',
                       'cens',
                       'copyco',
                       'uep',
                       'iset',
                       'eeat',
                       'cecla',
                       'epet',
                       'epnm',
                       'etp',
                       'itec',
                       'cct',
                       'cemoe',
                       'epea',
                       'cepaho',
                       'ufidet',
                       'eetpi',
                       'eetpa',
                       'ispi'
                );

            $instit = str_replace($a, '', $instit);
            $instit = str_replace('()', '', $instit);

            // elimina espacios en blanco en exceso (maximo deja uno)
            $instit = preg_replace('/\s\s+/', ' ', $instit);

            return trim(strtolower($instit));
        }


        /**
	 *
	 * optimiza nombre de instits para una futura comparacion
	 *
	 * @param $text
	 */
	function optimizar_cadena($text){
		
                // elimina acentos y especiales
                $a = array('à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
                $b = array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
                $text = str_replace($a, $b, $text);

                $text = strtolower($text);

                // algunos casos tienen = en lugar de -
                $text = str_replace("=","-",$text);
      
                // mas especiales
                $a = array('agro.', 'e. ', 'et'," -", '- ', '. ', '°');
                $b = array('agro ', 'e ', 'et ', ' ', ' ', ' ', 'º');
                $text = str_replace($a, $b, $text);

                // elimina espacios en blanco en exceso (maximo deja uno)
                $text = preg_replace('/\s\s+/', ' ', $text);

                $palabras_reservadas = array(
                       /* "colegio",
                        "escuela",
                        "esc ",
                        "instituto",
                        "et",
                        "e ",
                        "eet",*/
                        "- ",
                        " - ",
                        "."
                );

                // elimina palabras reservadas
                $text = str_replace($palabras_reservadas, '', $text);

                // junta los n°
                $text = str_replace("nº ","nº",$text);
                // algunos casos tienen N'
                $text = str_replace("n' ","nº",$text);
                // algunos casos tienen N|
                $text = str_replace("n| ","nº",$text);
                
                // separa "nº" si esta pegado al nombre
                $pos = $pos_fin = '';
                $pos = strpos($text,'º');
                if ($pos !== false)
                {
                    $fin = false;
                    for ($i=($pos+1); $i<strlen($text) && !$fin; $i++)
                    {
                        if (!is_numeric($text[$i])) {
                            $fin = true;
                            $pos_fin = $i;
                        }
                    }

                    if ($pos_fin > $pos) {
                        // pone espacio luego del numero
                        $text = substr($text, 0, $pos_fin)."".substr($text, $pos_fin);
                    }
                }
                

		return trim($text);
	}

        function validar_totales() {
            $totalSmallDiference = 10;
            $total = 0;

            $this->FondoTemporal->recursive = 0;

            /*VALIDACION HORIZONTAL*/
            $fondos = $this->FondoTemporal->find("all",
                            array('conditions'=> array('tipo'=>'i', 'totales_checked'=>0)));
            
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
                             $fondo['FondoTemporal']['f10'] -
                             $fondo['FondoTemporal']['total']);

                    /*Total Chequeado*/
                    if($total == 0){
                        $fondo['FondoTemporal']['totales_checked'] = 1;
                    }/*Total con diferencia pequeña ---> Ajuste*/
                    elseif($total < $totalSmallDiference){
                        $fondo['FondoTemporal']['totales_checked'] = 2;
                    }/*Total con diferencia grande*/
                    else{
                        $fondo['FondoTemporal']['totales_checked'] = 3;
                    }
            }
            
            $this->FondoTemporal->saveAll($fondos);

            $this->redirect(array('action'=>'checked_instits'));
        }
}
?>