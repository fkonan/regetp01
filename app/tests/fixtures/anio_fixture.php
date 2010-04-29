<?php
/* Anio Fixture generated on: 2010-04-29 09:04:46 : 1272544006 */
class AnioFixture extends CakeTestFixture {
	var $name = 'Anio';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'plan_id' => array('type' => 'integer', 'null' => false),
		'ciclo_id' => array('type' => 'integer', 'null' => false),
		'old_item' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'anio' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'etapa_id' => array('type' => 'integer', 'null' => false),
		'matricula' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'secciones' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'hs_taller' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
	);

	var $records = array(
		array(
			'id' => 1,
			'plan_id' => 1,
			'ciclo_id' => 1,
			'old_item' => 1,
			'anio' => 1,
			'etapa_id' => 1,
			'matricula' => 1,
			'secciones' => 1,
			'hs_taller' => 1,
			'created' => '2010-04-29 09:26:46',
			'modified' => '2010-04-29 09:26:46'
		),
	);
}
?>