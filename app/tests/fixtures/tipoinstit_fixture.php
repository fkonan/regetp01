<?php
/* Tipoinstit Fixture generated on: 2010-04-29 09:04:13 : 1272544033 */
class TipoinstitFixture extends CakeTestFixture {
	var $name = 'Tipoinstit';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'jurisdiccion_id' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'null' => false, 'length' => 100),
	);

	var $records = array(
		array(
			'id' => 1,
			'jurisdiccion_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>