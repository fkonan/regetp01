<?php
class Query extends AppModel {

	var $name = 'Query';
	var $validate = array(
		'name' => array('notempty',
						'alphaNumeric' => array(
							'rule' => 'alphaNumeric',
							'message'=>'Aqui se escribe el nombre de un archivo, solo se admiten valores alfanuméricos. No ingresar caracteres raros, ni espacios en blanco, ni acentos.')),
		'query' => array('notempty')
	);
	
	
	/**
	 * Me lista todas las categorias que existen en la Queries
	 * si se le pasa como parametro un "*" me trae todas
	 *  
	 * @param string $filtro
	 * @return array $categorias find(all)
	 */
	function listarCategorias($filtro = '*'){
		
		$conditions[] = array('categoria <>'=>"");
		
		if($filtro != '*'){
				$conditions[] = array("categoria LIKE" => "%".$filtro."%");
		}
		
		$categorias =  $this->find('all', array(
					'group' => 'categoria',
					'conditions'=> $conditions,
					'fields' => array('categoria')
		));
		return $categorias;
	}

}
?>