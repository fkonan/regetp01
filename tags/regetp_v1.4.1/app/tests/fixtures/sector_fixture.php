<?php


class SectorFixture  extends CakeTestFixture {
    var $name = 'Sector';
    //var $import = 'Sector';
    //var $import = array('model' => 'Sector', 'records' => true);

    var $fields = array(
            'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
            'name' => array('type'=>'string', 'null' => true, 'length' => 64),
            'orientacion_id' => array('type'=>'integer', 'null' => false, 'default' => 0),
    );

    var $records = array(
        /**** De Orientacion: ---- Agropecuaria  1 ****/
            array(
                'id' 	=> 3,
                'name'	=> "Agropecuaria",
                'orientacion_id' => 1,
            ),

        /**** De Orientacion: ---- Industrial    2 ****/
            array(
                'id' 	=> 4,
                'name'	=> "Automotriz",
                'orientacion_id' => 2,
            ),
            array(
                'id' 	=> 5,
                'name'	=> "Electr�nica",
                'orientacion_id' => 2,
            ),
            array(
                'id' 	=> 6,
                'name'	=> "Industria de Procesos",
                'orientacion_id' => 2,
            ),

         /**** De Orientacion: ---- Otros        3 ****/
            array(
                'id' 	=> 1,
                'name'	=> "Informatica",
                'orientacion_id' => 3,
            ),
            array(
                'id' 	=> 2,
                'name'	=> "Gastronomia",
                'orientacion_id' => 3,
            ),

    );

}
?>