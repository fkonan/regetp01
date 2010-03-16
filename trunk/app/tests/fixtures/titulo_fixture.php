<?php 
/* SVN FILE: $Id$ */
/* Titulo Fixture generated on: 2010-03-16 11:03:42 : 1268749422*/

class TituloFixture extends CakeTestFixture {
	var $name = 'Titulo';
	var $table = 'titulos';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'length' => 200),
			'marcoref' => array('type'=>'boolean', 'null' => false, 'default' => 'false'),
			'oferta_id' => array('type'=>'integer', 'null' => false),
			'indexes' => array('0' => array())
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'marcoref'  => 1,
			'oferta_id'  => 1
			));
}
?>