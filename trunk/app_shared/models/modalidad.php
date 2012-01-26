<?php
class Modalidad extends AppModel {

    var $name = 'Modalidad';
    var $order = 'Modalidad.name';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $hasMany = array(
            'Instit',
    );

}
?>