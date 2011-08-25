<?php
class InstitsController extends AppController {

    var $name = 'Instits';
    var $helpers = array('Html','Form','Ajax','Cache');
    //var $paginate = array('order'=>array('Instit.cue' => 'asc'),'limit'=>'10');
    var $components = array('Buscable');

    var $sesNames = array(
            'jurisdiccion' => 'Instit.jurisdiccion_id',
            'departamento' => 'Instit.departamento_id',
            'localidad' => 'Instit.localidad_id',
            'jurDepLoc' => 'Instit.JurDepLoc',
            'direccion' => 'Instit.direccion',
            'busqueda_libre' => 'Instit.busqueda_libre',
            'page' => 'Instit.page',
        );

    function index() {
        $this->Instit->recursive = 0;
        $this->set('instits', $this->paginate());
    }

    function view($id = null) {
        $this->pageTitle = "Instituciones";

        if (!$id) {
            $this->Session->setFlash(__('Institución Inválida.', true));
            $this->redirect(array('action'=>'index'));
        }

        $this->Instit->contain(array(   'Localidad', 'Departamento', 'Tipoinstit', 'Jurisdiccion',
                                        'Dependencia', 'Gestion', 'Orientacion', 'Claseinstit', 'EtpEstado',
                                        'Plan' => array(
                                            'order' => array('Plan.oferta_id', 'Plan.nombre'),
                                            'Titulo' => array('Oferta'),
                                            'Oferta')
                                ));
        $instit = $this->Instit->find("first", $id);

        $instit['Instit']['dir_tipodoc_name'] = '';
        $tipodoc = ClassRegistry::init('Tipodoc')->find('first', array(
            'conditions'=>array(
                'Tipodoc.id'=> $instit['Instit']['dir_tipodoc_id'],
        )));
        $instit['Instit']['dir_tipodoc_name'] = $tipodoc['Tipodoc']['abrev'];

        $tipodoc = ClassRegistry::init('Tipodoc')->find('first', array(
            'conditions'=>array(
                'Tipodoc.id'=> $instit['Instit']['vice_tipodoc_id'],
        )));
        $instit['Instit']['vice_tipodoc_name'] = $tipodoc['Tipodoc']['abrev'];

        $programa_de_etp = false;
        // si la institucion es con programa de ETP
        if($instit['EtpEstado']['id']== 1) {
            $programa_de_etp = true;
        }
        
        $this->set('con_programa_de_etp', $programa_de_etp);
        $this->set('relacion_etp', $instit['EtpEstado']['name']);
        $this->set('instit', $instit);
    }
    
    function simpleSearch() {

       if (!empty($this->data)) {
            $this->redirect(array('action' => 'view', $this->data['Instit']['instit_id']));
       }

    }


    function search() {
        
        // preparo los GET params que vienen del formulario enviando type GET
        $getParams = $this->params;
        unset($getParams['url']['url']);
        unset($getParams['url']['ext']);
        
        //para mostrar en vista los patrones de busqueda seleccionados
        $this->paginate['viewConditions'] = array();

        // primero seteo si vino formulario o fue el paginador quien llego a este action"
        $vino_formulario = (!empty($this->data) || (!empty($this->passedArgs)) || !empty($getParams)) ? true : false;

        if ($vino_formulario){

                /*******************************************************************
                 *    INICIALIZACION DE FILTROS
                 *
                 *   Los filtros pueden provenir del formulario o de las variables de paginacion.
                 *
                 * 	Para el primer caso se esta leyendo informacion de $this->data
                 * 	en el segundo caso de this->passedArgs
                 *
                 *
                 */

                /*
                 *          BUSQUEDA LIBRE
                 */
                if(!empty($this->data['Instit']['busqueda_libre'])) {
                    $this->passedArgs = array('busqueda_libre' => $this->data['Instit']['busqueda_libre']);
                }
                if( !empty($this->params['url']['busqueda_libre']) ) {
                     $this->passedArgs = array('busqueda_libre' => $this->params['url']['busqueda_libre']);
                }
                if(!empty($this->passedArgs['busqueda_libre'])) {
                    
                    $q = strtolower($this->passedArgs['busqueda_libre']);
                    

                    if(is_numeric($q)){
                        $q = (int) $q;
                        $this->paginate['Instit']['conditions'] = array("to_char(cue*100+anexo, 'FM999999999FM') SIMILAR TO ?" => "%". $q ."%");
                    }
                    else{
                        //debug(convertir_para_busqueda_avanzada($q)); die();
                        $this->paginate['Instit']['conditions'] = array("(to_ascii(lower(Tipoinstit.name)) || ' n ' || to_ascii(lower(Instit.nroinstit)) || ' ' || lower(Instit.nombre)) SIMILAR TO ?" => convertir_para_busqueda_avanzada($q));
                    }
                    
                    $this->data['Instit']['busqueda_libre'] = $q;

                    $this->paginate['viewConditions']['CUE o Nombre '] = $this->passedArgs['busqueda_libre'];
                }

                //////////////// Automagiccccs filter
                 //     Jurisdiccion
                 $ops[] = array(
                    'field' => 'jurisdiccion_id',
                    'friendlyName' => 'Jurisdicción');

                 //      Departamento
                 $ops[] = array(
                    'field' => 'departamento_id',
                    'friendlyName' => 'Departamento');

                 //      Localidad
                 $ops[] = array(
                    'field' => 'localidad_id',
                    'friendlyName' => 'Localidad');
                 
                 //      Localidad
                 $ops[] = array(
                    'field' => 'direccion',
                    'friendlyName' => 'Domicilio');

                 $this->Buscable->aplicarCriteriosDeBusqueda($ops, true);  

                /*********************************************************************/
                /*          FIN -*-CONDITIONS-*- de busqueda                         */
                /*********************************************************************/

                $this->Instit->recursive = 1;//para alivianar la carga del server
                $pagin = $this->paginate('Instit');

                $this->set('instits', $pagin);
                $this->set('url_conditions', $this->passedArgs);      
                $this->set('conditions', $this->paginate['viewConditions']);
            }
            
            $this->set('vino_formulario', $vino_formulario);
            $this->set('jurisdicciones', $this->Instit->Jurisdiccion->find('list'));
    }
}
?>
