<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2009-09-23 10:15:16 : 1253711716*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
		'username' => array('type'=>'string', 'null' => false, 'default' => ''),
		'nombre' => array('type'=>'string', 'null' => false, 'default' => ''),
		'apellido' => array('type'=>'string', 'null' => false, 'default' => ''),
		'password' => array('type'=>'string', 'null' => false, 'default' => ''),
		'mail' => array('type'=>'string', 'null' => false, 'default' => ''),
		'oficina' => array('type'=>'string', 'null' => false, 'default' => ''),
		'interno' => array('type'=>'string', 'null' => false, 'default' => ''),
		'role' => array('type'=>'string', 'null' => false, 'default' => '')
	);
	
	var $records = array(array(
		'id'  => 1,
		'username'  => "nickname",
		'nombre'  => "Nombre",
		'apellido'  => "Apellido",
		'password'  => "algunapass",
		'mail'  => "email@mail.com",
		'oficina'  => "310",
		'interno'  => "0",
		'role'  => "editor"
	));
}
?>