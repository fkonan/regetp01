<?php
class ZFondoWorksController extends AppController {

    var $name = 'ZFondoWorks';
    var $helpers = array('Html', 'Form');
    /**
     * @var ZFondoWork
     */
    var $ZFondoWork;


    /**
     * Este es el migrador final.
     * Es el que pasa de la tabla z_fondo_work a fondos y linea_de_acciones
     * @property $FondoTemporal
     */
    function migrator() {
        $iMi = $this->ZFondoWork->migrar('ij', 3, true);
        switch ($iMi) {
            case -1:
                $msg = "Hay alguna linea de accion de la tabla lineas_de_acciones que no machea con las lineas de acciones de la tabla z_fondo_work";
                $msg_type = "notice";
                break;

            case ($iMi > 0):
                $msg = "Migración OK";
                $msg_type = "success";
                break;

            case ($iMi < 1):
                $msg = "La migración resultó con ERRORES";
                $msg_type = "error";
                break;
        }

        $this->set('msg',$msg);
        $this->set('msg_type',$msg_type);
    }
}

?>