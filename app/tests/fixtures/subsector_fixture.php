<?php 
/* SVN FILE: $Id$ */
/* Subsector Fixture generated on: 2009-10-21 11:10:27 : 1256131287*/
 
class SubsectorFixture extends CakeTestFixture {
	var $name = 'Subsector';
	//var $import = 'Subsector';
	
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => true, 'length' => 64),
			'sector_id' => array('type'=>'integer', 'null' => false, 'default' => '0')
			);
	
	var $records = array(array(
			'id'  => 2,
			'name'  => 'Subsector 2 de Sector 3',
			'sector_id'  => 3
			));
}
?>