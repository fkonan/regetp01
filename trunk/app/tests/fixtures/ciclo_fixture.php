<?php
/* Ciclo Fixture generated on: 2010-04-29 09:04:47 : 1272544007 */
class CicloFixture extends CakeTestFixture {
	var $name = 'Ciclo';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 10),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ip'
		),
	);
}
?>