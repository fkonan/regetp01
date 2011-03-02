<?php

class SectoresTituloFixture extends CakeTestFixture {
	var $name = 'SectoresTitulo';

        var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
                'titulo_id' => array('type' => 'integer', 'null' => true, 'default' => 0),
                'sector_id' => array('type' => 'integer', 'null' => true, 'default' => 0),
                'subsector_id' => array('type' => 'integer', 'null' => true, 'default' => 0),
                'prioridad' => array('type' => 'integer', 'null' => true, 'default' => 0),
	);

	var $records = array(
		array(
			'id' => 1727,
			'titulo_id' => 60,
			'sector_id' => 2,
			'subsector_id' => 0,
			'prioridad' => 1,
		),
		array(
			'id' => 1738,
			'titulo_id' => 1242,
			'sector_id' => 8,
			'subsector_id' => 0,
			'prioridad' => 1,
		),
		array(
			'id' => 1749,
			'titulo_id' => 55,
			'sector_id' => 24,
			'subsector_id' => 0,
			'prioridad' => 1,
		),
            );
}

?>