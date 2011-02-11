<?php
class Titulo extends AppModel {

	var $name = 'Titulo';
	var $order = 'Titulo.name';
	
	var $validate = array(
		'name' => array('notempty'),
		'marco_ref' => array('boolean'),
		'oferta_id' => array('numeric'),
		/*'sector_id' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un sector.',
			)
		),
		'subsector_id' => array(
			'correcto_subsector' => array(
				'rule' => array('controlar_coincidencia_sector_subsector'),
				'message'=> 'El subsector no corresponde al sector.'
			)
		)*/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Oferta' => array('className' => 'Oferta',
								'foreignKey' => 'oferta_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
	
	var $hasMany = array(
            'Plan',
            'SectoresTitulo' => array('dependent'=> true) // borra en cascada // esta es la tabla HABTM, pero la necesito aca para hacer consultas mas especificas
            );

        var $hasAndBelongsToMany = array(
            'Sector' => array('joinTable' => 'sectores_titulos'),
            'Subsector' => array('joinTable' => 'sectores_titulos')
        );


        function beforeDelete() {
            // chequea si contiene planes asociados, no permite
            $count = $this->Plan->find('count', array(
                            'conditions'=>array('Plan.titulo_id'=>$this->id)
                        ));
            if ($count == 0) {
                return true;
            }
            else {
                return false;
            }
        }


        function getSimilars($name=null, $titulo_id=null) {
            $similars = array();

            if (!empty($name)) {
                $nombre = $name;
            }
            elseif (!empty($this->data['Titulo']['name'])) {
                $nombre = $this->data['Titulo']['name'];
            }

            if (!empty($titulo_id)) {
                $id = $titulo_id;
            }
            elseif (!empty($this->data['Titulo']['id'])) {
                $id = $this->data['Titulo']['id'];
            }

            if(!empty($nombre)) {
                $conditions = array("lower(Titulo.name)  SIMILAR TO ?" => convertir_texto_plano($nombre));

                if (!empty($id)) {
                    // si esta editando, que no sea el mismo
                    $conditions['Titulo.id <>'] = $id;
                }

                $similars = $this->find('all', array(
                                'conditions' => $conditions));
            }

            return $similars;
        }

}
?>