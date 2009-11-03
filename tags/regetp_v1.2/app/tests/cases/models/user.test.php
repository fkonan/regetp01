<?php 
/* SVN FILE: $Id$ */
/* User Test cases generated on: 2009-10-01 12:10:06 : 1254410466*/
App::import('Model', 'User');

class TestUser extends User {

	var $cacheSources = false;
}

class UserTest extends CakeTestCase {

	function start() {
		parent::start();
		$this->User = new TestUser();
	}

	function testUserInstance() {
		$this->assertTrue(is_a($this->User, 'User'));
	}

	function test() {

	}
}
?>