<?php
class DepartamentosController extends AppController {

	var $name = 'Departamentos';
	var $helpers = array('Html', 'Form');
        var $components = array('RequestHandler');

	
	
	function ajax_select_departamento_form_por_jurisdiccion(){
            $this->layout = 'ajax';
            Configure::write('debug',0);

            $jur_id = 0;
            if ($jur = current($this->data)):
                if (isset($jur)):
                        $jur_id = $jur['jurisdiccion_id'];
                endif;
            endif;

            $deptos = $this->Departamento->con_jurisdiccion('all',$jur_id);

            $this->set('todos', ($jur_id != 0 )?false:true);

            $this->set('deptos', $deptos);

             //prevent useless warnings for Ajax
            $this->render('ajax_select_departamento_form_por_jurisdiccion','ajax');
	}
	
	function ajax_buscar_departamento(){
		$this->set('deptos',$this->Departamento->find('all'));
	}

        function search_departamentos($q = null){
            $this->autoRender = false;

            /*if ( $this->RequestHandler->isAjax() ) {
                Configure::write ( 'debug', 0 );
            }*/

            $response = '';

            if(empty($q)) {
                if (!empty($this->params['url']['q'])) {
                    $q = utf8_decode(strtolower($this->params['url']['q']));
                } else {
                    return utf8_encode("parámetro vacio");
                }
            }

            $items = $this->Departamento->find("all", array(
                            'contain'=> array("Localidad"),
                            'conditions'=> array("OR"=>array(
                                "to_ascii(lower(Localidad.name)) SIMILAR TO ?" => "%". $q ."%",
                                "to_ascii(lower(Departamento.name)) SIMILAR TO ?" => "%". $q ."%"
                                )
                            )
                        )
                    );

            $result = array();

            foreach ($items as $item) {

                array_push($result, array(
                        "id_localidad" => $item['Localidad']['id'],
                        "id_departamento" => $item['Departamento']['id'],
                        "id_jurisdiccion" => $item['Departamento']['Jurisdiccion']['id'],
                        "localidad" => utf8_encode($item['Localidad']['name']),
                        "departamento" => utf8_encode($item['Departamento']['name']),
                        "jurisdiccion" => utf8_encode($item['Departamento']['Jurisdiccion']['name'])
                ));
            }

            echo json_encode($result);
        }

}
?>