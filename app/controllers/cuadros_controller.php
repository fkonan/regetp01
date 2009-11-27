<?php
class CuadrosController extends AppController {

	var $name = 'Cuadros';
	var $uses = array('CustomQuery');
	
	function total_instits_por_gestion_jurisdiccion() {
		$this->CustomQuery->sql = "
				(SELECT j.name as \"División político-territorial\" ,
	                    sum(CASE WHEN (i.gestion_id = 1 ) THEN 1 ELSE 0 END )as \"Estatal\" ,
	                    sum(CASE WHEN (i.gestion_id = 2 ) THEN 1 ELSE 0 END )as \"Privada\" ,
                        count(*) as \"Total\"
                 FROM   instits i LEFT JOIN jurisdicciones j ON j.id = i.jurisdiccion_id
                 WHERE  i.activo = 1
                 AND    i.dependencia_id <> 2
                 GROUP BY j.name
                 ORDER BY j.name
                )
                UNION ALL
                (
                 SELECT cast ('Universidades Nacionales' as varchar(40)) as \"División político-territorial\",
	                    sum(CASE WHEN (i.gestion_id = 1) THEN 1 ELSE 0 END )as \"Estatal\" ,
	                    sum(CASE WHEN (i.gestion_id = 2) THEN 1 ELSE 0 END )as \"Privada\" ,
                        count(*) as \"Total\"
                 FROM  instits i
                 WHERE i.dependencia_id = 2
                 AND   i.activo = 1
                )
                UNION ALL
                (
                 SELECT cast ( 'Total' as varchar(40)) as \"División político-territorial\" ,
                 sum(CASE WHEN (i.gestion_id = 1) THEN 1 ELSE 0 END ) as \"Estatal\" ,
                 sum(CASE WHEN (i.gestion_id = 2) THEN 1 ELSE 0 END )as \"Privada\",
                 count(*) as \"Total\"
                 FROM   instits i 
                 WHERE  i.activo = 1
                )	
              ";
		
		//$data = $this->paginate($this->CustomQuery);
		$data = $this->CustomQuery->query();
		
		$precols = array(0=>"",1=>"Ámbito de Gestión",2=>"");
		$cols = array_keys($data['0']['0']);
		$this->set('precols', $precols); 
		$this->set('cols', $cols);
		$this->set('queries', $data);
	}
}
?>