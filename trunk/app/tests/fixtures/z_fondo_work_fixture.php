<?php 
/* SVN FILE: $Id$ */
/* ZFondoWork Fixture generated on: 2010-04-22 12:01:13 : 1271948473*/

class ZFondoWorkFixture extends CakeTestFixture {
	var $name = 'ZFondoWork';
	var $table = 'z_fondo_work';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'anio' => array('type'=>'integer', 'null' => true, 'default' => '0'),
		'trimestre' => array('type'=>'integer', 'null' => true, 'default' => '0'),
		'jurisdiccion_id' => array('type'=>'integer', 'null' => true, 'default' => '0'),
		'jurisdiccion_name' => array('type'=>'string', 'null' => true, 'length' => 40),
		'memo' => array('type'=>'string', 'null' => true, 'length' => 100),
		'cuecompleto' => array('type'=>'string', 'null' => true, 'length' => 100),
		'instit' => array('type'=>'string', 'null' => true, 'length' => 200),
		'instit_name' => array('type'=>'string', 'null' => true, 'length' => 200),
		'departamento' => array('type'=>'string', 'null' => true, 'length' => 100),
		'localidad' => array('type'=>'string', 'null' => true, 'length' => 100),
		'f01' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f02a' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f02b' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f02c' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f03a' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f03b' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f04' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f05' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f06a' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f06b' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f06c' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f07a' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f07b' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f07c' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f08' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'f09' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'total' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'equipinf' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'refaccion' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'instit_id' => array('type'=>'integer', 'null' => true, 'default' => '0'),
		'observacion' => array('type'=>'string', 'null' => true, 'default' => '0', 'length' => 500),
		'totales_checked' => array('type'=>'integer', 'null' => true, 'default' => '0'),
		'cue_checked' => array('type'=>'integer', 'null' => true, 'default' => '0'),
		'tipo' => array('type'=>'string', 'null' => true, 'length' => 14),
		'f10' => array('type'=>'float', 'null' => true, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id' => 1,
		'anio' => 2009,
		'trimestre' => 1,
		'jurisdiccion_id' => 2,
		'jurisdiccion_name' => 'CABA',
		'memo' => 'Lorem ipsum dolor sit amet',
		'cuecompleto' => '24567801',
		'instit' => 'Lorem ipsum dolor sit amet',
		'instit_name' => 'Lorem ipsum dolor sit amet',
		'departamento' => 'Lorem ipsum dolor sit amet',
		'localidad' => 'Lorem ipsum dolor sit amet',
		'f01' => 10,
		'f02a' => 0,
		'f02b' => 0,
		'f02c' => 0,
		'f03a' => 0,
		'f03b' => 0,
		'f04' => 0,
		'f05' => 15,
		'f06a' => 0,
		'f06b' => 0,
		'f06c' => 0,
		'f07a' => 0,
		'f07b' => 0,
		'f07c' => 0,
		'f08' => 0,
		'f09' => 0,
		'total' => 25,
                'f10' => 0,
		'equipinf' => 0,
		'refaccion' => 0,
		'instit_id' => 1,
		'observacion' => 'Lorem ipsum dolor sit amet',
		'totales_checked' => 1,
		'cue_checked' => 1,
		'tipo' => 'i',
	));
}
?>