<?php
class CuadrosController extends AppController {

	var $name = 'Cuadros';
	var $uses = array('CustomQuery');
	
	function total_instits_por_gestion_jurisdiccion() {
		$this->CustomQuery->sql = "
				(select
				    j.name as \"División politíco-territorial\" ,
				    sum(CASE WHEN ( i.gestion_id = 1 ) THEN 1 ELSE 0 END )as \"Gestión Estatal\" ,
				    sum(CASE WHEN ( i.gestion_id = 2 ) THEN 1 ELSE 0 END )as \"Gestión Privada\" ,
				    count(*) as \"Total\"
				from instits i
				left join jurisdicciones j on j.id = i.jurisdiccion_id
				where i.activo = 1
				AND i.dependencia_id = 1
				group by
				    j.name
				order by
				    j.name
				)
				union all
				(
				select
				    cast ( 'Universidades Nacionales' as varchar(40)) as \"División politíco-territorial\" ,
				    count(*) as \"Gestión Estatal\",
				    0 as \"Gestión Privada\" ,
				    count(*) as \"Total\"
				from instits i
				where  i.dependencia_id = 2
				AND i.activo = 1
				)
				union all
				(
				select 
				    cast ( 'Total' as varchar(40)) as \"División politíco-territorial\" ,
				    sum(CASE WHEN ( i.gestion_id = 1 OR  i.dependencia_id = 2 ) THEN 1 ELSE 0 END ) as \"Gestión Estatal\" ,
				    sum(CASE WHEN ( i.gestion_id = 2 ) THEN 1 ELSE 0 END )as \"Gestión Privada\" ,
				    count(*) as \"Total\"
				from instits i
				where i.activo = 1)";		
		
		//$data = $this->paginate($this->CustomQuery);
		$data = $this->CustomQuery->query();
		
		$cols = array_keys($data['0']['0']); 
		$this->set('cols', $cols);
		$this->set('queries', $data);
	}
}
?>