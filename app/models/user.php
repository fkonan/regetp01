<?php
class User extends AppModel {

	var $name = 'User';
        var $actsAs = array('Acl' => array('type' => 'requester'));
	
	
	var $hasMany = array('UserLogin');

        //The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(

			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			));

        var $validate = array(
            'username' => array(
                'notEmpty' => array( // or: array('ruleName', 'param1', 'param2' ...)
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'El Usuario no puede quedar vacío.'
			)
                ),
            'password' => array(
                'notEmpty' => array( // or: array('ruleName', 'param1', 'param2' ...)
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar una Password.'
			)
                )
         );

        function parentNode() {
            return null;
        }

        function parentNodeId() {
           if (!$this->id && empty($this->data)) {
               return null;
           }

           $aro = $this->Aro->find('all', array('fields' => array('parent_id'),
                            'conditions'=>array('foreign_key'=>$this->id)));

           return $aro[0]['Aro']['parent_id'];
           //return array('Group' => array('id' => $data['User']['group_id']));
        }

	/**
         * After save callback
         *
         * Update the aro for the user.
         *
         * @access public
         * @return void
         */
        function afterSave($created) {
                if (!$created) {
                    $node = $this->node();
                    $aro = $node[0];
                    $aro['Aro']['parent_id'] = $this->data['User']['grupo'];
                    $this->Aro->save($aro);
                }
                else {
                    $node = $this->node();
                    $aro = $node[0];
                    $aro['Aro']['alias'] = $this->data['User']['username'];
                    $aro['Aro']['parent_id'] = $this->data['User']['grupo'];
                    $this->Aro->save($aro);
                }
        }
}
?>