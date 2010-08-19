<?php
/* Etapa Fixture generated on: 2010-04-29 09:04:52 : 1272544012 */
class EtapaFixture extends CakeTestFixture {
	var $name = 'Etapa';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 40),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'EGB'
		),
            array(
			'id' => 2,
			'name' => 'POLIMODAL'
		),
            array(
			'id' => 3,
			'name' => 'MEDIA'
		),
            array(
			'id' => 4,
			'name' => 'CB'
		),
            array(
			'id' => 5,
			'name' => 'CS'
		),
	);
}
?>