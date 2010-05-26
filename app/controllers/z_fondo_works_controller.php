<?php
set_time_limit(60*60*0.5); // media hora de ejecucion limite

class ZFondoWorksController extends AppController {

    var $name = 'ZFondoWorks';
    var $helpers = array('Html', 'Form');
    /**
     * @var ZFondoWork
     */
    var $ZFondoWork;


    /**
     *
     * @param boolean $validar default en true Esta variable es para que no me haga el checkeo de totales al inicio y al final
     * @param integer $cantDeFondosDelExcel default en 7021. Indica el numero de registros que hay en el excel original
     * @param integer $cantRegistros, default en 0 para que traiga todos. Es el LIMIT que quiero ponerle al traerme registros para procesar
     * @param boolean $eliminarArchivosDeFondoYLineas default en true. Si esta en true me elimina los registros que haya en fondos y fondos_lineas_de_acciones
     * @return <type>
     */
    function migrator($validar = 1, $cantDeFondosDelExcel = 7021, $cantRegistros = 0, $eliminarArchivosDeFondoYLineas = 1) {
        if ( $validar) {
            $tempsComprobacion = $this->ZFondoWork->temporalesFiltradosX('ijc', $cantRegistros, $eliminarArchivosDeFondoYLineas);
            $totTemps = count($tempsComprobacion);
            if ( $totTemps != $cantDeFondosDelExcel) {
                $this->set('msg', '');
                $this->set('msg_type', '');
                $this->set('msg_check', "hay solo $totTemps registros en z_fondo_work, cuando en el excel hay $cantDeFondosDelExcel.");
                $this->set('msg_check_type', 'error');
                return;
            }
        }


        $iMi = $this->ZFondoWork->migrar('ijc', $cantRegistros, $eliminarArchivosDeFondoYLineas);
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
                $msg = "La migración resultó con ERRORES: ".$this->ZFondoWork->migrationStatus;
                $msg_type = "error";
                break;
        }
        $msg_check = '';
        $msg_check_type = '';
        $pasoOk = $this->ZFondoWork->checkCantRegistrosFondoConExcel($cantDeFondosDelExcel);
        if ($pasoOk != 0) {
            $msg_check = "[$pasoOk registros en el excel)]. No se migraron todos los registros que hay en el excel original.";
            $msg_check_type = 'error';
        }
        $this->set('msg',$msg);
        $this->set('msg_type',$msg_type);
        $this->set('msg_check',$msg_check);
        $this->set('msg_check_type',$msg_check_type); 
    }
}

?>