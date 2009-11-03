<?php 
/* SVN FILE: $Id$ */
/* Subsector Fixture generated on: 2009-10-21 11:10:27 : 1256131287*/

class SubsectorFixture extends CakeTestFixture {
	var $name = 'Subsector';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => true, 'length' => 64),
			'sector_id' => array('type'=>'integer', 'null' => false, 'default' => '0'),
			'indexes' => array('0' => array())
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'sector_id'  => 1
			));
}
?>