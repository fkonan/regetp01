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
        /*
         * Este numero es el total de registros, o filas que hay en el excel original.
         * es la suma de todos los fondos.
         * es el conteo, de todas las lineas del excel que tienen datos, omitiendo
         * el total de la jurisdiccion. 
         * O sea, es el total de instituciones y jurisdiccionales entregados
         * @var integer
         */
        $cantDeFondosDelExcel = 7594;

        $iMi = $this->ZFondoWork->migrar('ij', 3, true);
        switch ($iMi) {
            case -1:
                $msg =  $this->ZFondoWork->migrationStatus;
                $msg_type = "notice";
                break;

            case ($iMi > 0):
                $msg = $this->ZFondoWork->migrationStatus;
                $msg_type = "success";
                break;

            case ($iMi < 1):
                $msg = "La migración resultó con ERRORES";
                $msg_type = "error";
                break;
        }
        $msg_check = '';
        $msg_check_type = '';
        if (!$this->ZFondoWork->checkCantRegistrosFondoConExcel($cantDeFondosDelExcel)) {
            $msg_check = 'No se migraron todos los registros que hay en el excel original.';
            $msg_check_type = 'error';
        }
        $this->set('msg',$msg);
        $this->set('msg_type',$msg_type);
        $this->set('msg_check',$msg_check);
        $this->set('msg_check_type',$msg_check_type); 
    }
}

?>