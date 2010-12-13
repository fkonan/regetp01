<?php
/**
 * Inicializa el paginator con las condiciones especificadas
 * 
 */
class BuscableComponent extends Object {

    /* @var $controller Controller */
    var $controller;

    /**
     *
     * @var array, listado de opciones a buscar
     * Opciones psibles son:
     *      string model => nombre del modelo
     *      string field => nombre del campo que quiero buscar
     *      string friendlyName => es el nombre que aparecerá en la pàgina de resultados de la búsqueda. Por ejemplo "Nombre de la Institución"
     *      boolean forceText => hace que el valor buscado sea un texto si o si. Aunque venga un número como filtro de bñusqueda.
     *      boolean asociarPlan => para realizar busquedas avanzadas en el sector del titulo por ejemplo
     * 
     */
    var $searchOptions = array();


    function initialize(&$controller, $settings=array()){
        $this->controller = $controller;
    }
    
    /**
     *
     * @param array $o -- Options array
     * Opciones psibles son:
     *      string model => nombre del modelo
     *      string field => nombre del campo que quiero buscar
     *      string friendlyName => es el nombre que aparecerá en la pàgina de resultados de la búsqueda. Por ejemplo "Nombre de la Institución"
     *      boolean forceText => hace que el valor buscado sea un texto si o si. Aunque venga un número como filtro de bñusqueda.
     *      boolean asociarPlan => para realizar busquedas avanzadas en el sector del titulo por ejemplo
     *
     */
    function aplicarCriteriosDeBusqueda($o = null) {
        if (empty($o)) {
            $o = $this->searchOptions;
        }
        
        if (count($o) == 0) return -1; // no hay nada que buscar

        // inicializo array de opciones
        $model = $o['model'];
        $field = $o['field'];
        $friendlyName = empty($o['friendlyName']) ? $field : $o['friendlyName'];
        $forceText = empty($o['forceText']) ? false : true;
        $valor = null;
        $asociarPlan = empty($o['asociarPlan']) ? false : true;

        $modelField = $model.'.'.$field;

        // lista de modelos que se van a consultar en la query
        $this->controller->paginate['modelosInvolucrados'] = array();



        // paso al vector del paginador para unificar la busqueda
        if(!empty($this->controller->data[$model][$field])) {
            $valor = $this->controller->data[$model][$field];
        }

        if( !empty($this->controller->passedArgs[$modelField]) ) {
            $valor = $this->controller->passedArgs[$modelField];
        }
        $this->controller->passedArgs[$modelField] = $valor;


        if( !empty($valor) ) {

            if ($asociarPlan) {
                $this->controller->Instit->asociarPlan = true;
            }


            $this->controller->paginate['modelosInvolucrados'][] = $model;

            $friendlyName = empty($friendlyName) ?  $field : $friendlyName;
            $this->controller->paginate['viewConditions'][$friendlyName] = $friendlyName;

            if ( (!is_numeric($valor) && !is_array($valor)) && is_string($valor) || $forceText === true) {
                // es texto
                $this->controller->paginate[$this->controller->modelClass]['conditions'][$modelField]
                    = convertir_para_busqueda_avanzada(utf8_decode($valor));
                $array_condiciones[$modelField] = utf8_decode($valor);
                $url_conditions[$field] = utf8_decode($valor);
            } else {
                if (substr($field,-3) == '_id') {

                    // es FK, por lo tanto me traigo el nombre
                    // para mostrar en el resutado de busquedas (para mostrar en la vista el camp "name" del Modelo
                    $miniModel = substr($field, 0, strlen($field)-3);
                    $model  = Inflector::camelize($miniModel);
                    $rModel =& ClassRegistry::init($model);

                    $rModel->id = $valor;
                    $this->controller->paginate['viewConditions'][$friendlyName] = $rModel->field('name');
                }

                // es un numero, como por ejemplo una FK
                $this->controller->paginate[$this->controller->modelClass]['conditions'][$modelField] = $valor;
            }
        }
    }
}
?>
