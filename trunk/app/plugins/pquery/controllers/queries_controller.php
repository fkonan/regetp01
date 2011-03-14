<?php
App::import('Model','Pquery.CustomQUery');

class QueriesController extends PqueryAppController {

	var $name = 'Queries';
	var $helpers = array('Html', 'Form','Ajax');
	var $components = array('Auth','RequestHandler');

        var $categorias_descargas = array(1=>"Instits",2=>"Planes",3=>"Titulos",4=>"Temporal");
        

	function index() {
		$this->Query->recursive = 0;
		$this->set('queries', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Query.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('query', $this->Query->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Query->create();
			if ($this->Query->save($this->data)) {
				$this->Session->setFlash(__('The Query has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Query could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Query', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Query->save($this->data)) {
				$this->Session->setFlash(__('The Query has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Query could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Query->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Query', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Query->del($id)) {
			$this->Session->setFlash(__('Query deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function descargar_queries() {
		
		$categorias = array();
		$this->set('categorias',$this->categorias_descargas);

                $queries = array();

                foreach($this->categorias_descargas as $key=>$categoria){
                    $conditions['categoria']= $key;
                    $queries[$key]=$this->Query->find('all',array('order'=>'id,modified DESC', 'conditions'=>$conditions));
                }

		$this->set('queries',$queries);
	}
	
	/**
	 * esto me construye un excel en la vista con el id de la query
	 * @param $id
	 */
	function contruye_excel($id){
		$this->layout = 'excel';
		Configure::write('debug',0);
		$this->RequestHandler->setContent('xls', 'application/vnd.ms-excel');
		$res = $this->Query->findById($id);
		$sql = $res['Query']['query'];
		$this->Query->recursive = -1;
		$consulta_ejecutada = $this->Query->query($sql);

		$precols = array_keys($consulta_ejecutada[0]);

                $quitar_columnas = $consulta_ejecutada[0][0];
		while(list($key,$value) = each($quitar_columnas)):
			$columnas[] = $key;
		endwhile;

		$this->set('nombre',$res['Query']['name']);
		$this->set('columnas',$columnas);
		$this->set('filas',$consulta_ejecutada);

	}
	
	
	function listado_categorias()
	{
		Configure::write('debug', 0);
		$this->Query->recursive = -1;
                
		$categorias = array();
		if(!empty($this->data['Query']['categoria'])){
			$categorias = $this->Query->listarCategorias($this->data['Query']['categoria']);
		}
                if (!empty($this->passedArgs['term'])) {
                    $categorias = $this->passedArgs['term'];
                }
		if (empty($categorias)) {
			$categorias = $this->Query->listarCategorias('*'); // me trae todas
		}



		$this->set('categorias',$categorias);
		$this->set('string_categoria',$this->data['Query']['categoria']);
		$this->layout = 'ajax';
	}



        function list_view($id="") {
            $this->layout = "sin_menu";
            $this->CustomQuery =& ClassRegistry::init('Pquery.CustomQuery');

            if (isset($this->passedArgs['query.id'])) {
                $id = $this->passedArgs['query.id'];
            }

            if (!$id) {
                $this->Session->setFlash(__('Invalid id for Query', true));
                $this->redirect(array('action'=>'index'));
            }

            $this->rutaUrl_for_layout[] =array('name'=> 'Queries','link'=>'/Instits/add' );
            $res = $this->Query->findById($id);

            $this->CustomQuery->setSql($res['Query']['query']);

            
            if (!empty($this->passedArgs['viewAll'])) {
                if ($this->passedArgs['viewAll'] == 'true') {
                    $data = $this->CustomQuery->query();
                    $viewAll = false;
                }
            }
            else if (!empty($this->passedArgs['preview'])) {
                if ($this->passedArgs['preview']) {
                    $this->layout = null;
                    $this->CustomQuery->setSql($res['Query']['query']. " LIMIT 5");
                    $data = $this->CustomQuery->query();
                    $viewAll = true;
                }
            } else {
                $data = $this->paginate($this->CustomQuery);
                $viewAll = true;
            }

            $precols = array_keys($data[0]);
            //$cols = array_keys($data['0']['0']);
            $this->set('cols', $precols);
            $url_conditions['query.id'] = $id;
            $this->set('queries', $data);
            $this->set('url_conditions', $url_conditions);
            $this->set('name', $res['Query']['name']);
            $this->set('descripcion', $res['Query']['description']);
            $this->set('viewAll', $viewAll);
            $this->set('preview', !empty($this->passedArgs['preview']));


            if ($this->RequestHandler->ext == 'xls') {
                $this->layout = 'xls';
                $this->render('xls/'.$this->action);
            }
        }


}
?>