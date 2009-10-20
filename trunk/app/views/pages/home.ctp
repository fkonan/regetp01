<!--[if IE 5]>

<h2 style="color: red">¡¡ ATENCIÓN !! La versión del Internet Explorer no es compatible con ésta web</h2>

<p style="border: red solid 1px; padding: 5px">
Estas usando una versión vieja del Internet Explorer y no te permitirá visualizar y utilizar normalmente ésta página.
El Departamento de Sistemas recomienda usar Firefox para lograr una navegación más rápida y segura.<br />
<a href="http://download.mozilla.org/?product=firefox-3.0.8&os=win&lang=es-ES">Descargar Firefox</a><br /><br />

Requerimientos mínimos para utilizar el <b>Sistema Gestión de Registro</b>:<br />
-: Internet Explorer 6 o superior<br />
-: Mozilla Firefox 2.0 o superior

</p>
<![endif]--> 



<h1>Bienvenido a la versión 1.2 del Registro Federal de Instituciones de ETP</h1>

<?php
if (Configure::read() > 0):
	Debugger::checkSessionKey();
endif;
?>
<br />

<?php echo $html->image('nuevo.gif',array('width'=> '39px','style'=>'float:left'));?>
<h2 style="color: #FE2E2E; padding-left: 55px;">Novedades de la nueva versión</h2>

<p>
<ul>
<li><b>Buscador</b> 
	<ul>
		<li>Se incorporaron criterios de búsqueda y se ordenaron las opciones en diferentes categorías: "por su Ubicación", "por su Nombre", "por su Oferta" y "por Otras Características".</li>
		<li>Se modificó la búsqueda por CUE para que encuentre CUEs parciales (Ej: que contengan "118"), y CUEs con Anexo (Ej: "600118<b>00</b>").</li>
	</ul>
</li>
<br>
<li><b>Datos de Intitución</b>
 	<ul><li> Se corrigieron, depuraron y normalizaron los datos de todas las instituciones.</li></ul>
</li>
<br>
<li><b>Oferta</b> 
	<ul><li>Se agregó funcionalidad a la página de oferta permitiendo búsquedas y ordenamientos sobre el listado
			de las mismas, y se implementó la posibilidad de marcar como pendiente de actualización a una institución cuando la documentación de la oferta educativa recibida está incompleta. </li>
	</ul>
</li>
<br>	
<li><b>Buscador Histórico de CUE</b>
	<ul><li>Se agregó la posibilidad de buscar CUEs que hayan pertenecido a una institución.
	</li></ul>
</li> 
<br>
<li><b>Optimización</b>
	<ul><li> Se mejoró la velocidad de respuesta del sistema en las búsquedas y navegación del sitio.</li></ul>
</li>
<br>
</ul>

<div><?php echo $html->link('ver listado completo de mejoras','/pages/detalle_v1_2');?></div>

<br>
<hr>
<br>

<p>
Para realizar consultas sobre el funcionamiento del programa ó para 
notificar problemas técnicos: Int. 2010
</p>
<p>
Para realizar consultas sobre los contenidos de información del Registro 
de Instituciones: Int. 4032/4033.
</p>
<p>
Unidad de Información, Of. 309.
</p>