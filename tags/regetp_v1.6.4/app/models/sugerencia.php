<?php
class Sugerencia extends AppModel {

	var $name = 'Sugerencia';


        var $validate = array(
		'mensaje' => array('notempty'=>array(
                    'rule'=>'notempty',
                    'message' => 'Introduzca algún mensaje'
                )),
	);

        var $belongsTo = array(
			'User' => array('className' => 'User',
                                        'foreignKey' => 'user_id',
                                        'conditions' => '',
                                        'fields' => '',
                                        'order' => ''
			)
	);
}
?>