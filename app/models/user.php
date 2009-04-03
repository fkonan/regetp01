<?php
class User extends AppModel {

	var $name = 'User';
	
	var $actsAs = array('Acl' => array('requester')); 
	
	var $belongsTo = array(
			'Group' => array('className' => 'Group',
								'foreignKey' => 'group_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			))
			;
	
	function parentNode() {    
		if (!$this->id && empty($this->data)) {        
			return null;    
		}    
		$data = $this->data;    
		if (empty($this->data)) {        
			$data = $this->read();    
		}    
		if (!$data['User']['group_id']) {        
			return null;    } 
		else {        
			return array('Group' => array('id' => $data['User']['group_id'])); 
	    }
	}

}
?>