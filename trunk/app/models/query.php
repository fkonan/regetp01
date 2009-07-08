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

}
?>