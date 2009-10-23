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



<h1>Bienvenido al RFIETP</h1>

<?php
if (Configure::read() > 0):
	Debugger::checkSessionKey();
endif;
?>
<br />

<h2>Novedades de la versión 1.2</h2>

<p>
Desde su puesta en funcionamiento en junio del presente año el nuevo sistema RFIETP se 
encuentra en permanente actualización y mejoramiento, tanto respecto del 
contenido de información de la base de datos como de la aplicación que permite 
su gestión. En esa línea de trabajo a partir del 20 de octubre se ha instalado 
la versión 1.2 del sistema.
<br>
<br>
A continuación se ofrece un resumen de algunas de los cambios realizados desde su puesta en 
funcionamiento. El listado no es exhaustivo y se orienta principalmente a destacar las mejoras 
que pueden facilitar el uso del sistema desde la perspectiva de un usuario de consulta habitual.
<br>
<br>
Un listado completo de las modificaciones, más avanzado, se puede consultar siguiendo el link 
del final: <?php echo $html->link('Ver listado completo de mejoras','/pages/detalle_v1_2');?>
<ul>
<li><b>Buscador</b> 
	<ul>
		<li>Se incorporaron criterios de búsqueda y se ordenaron las opciones en diferentes categorías: "por su Ubicación", "por su Nombre", "por su Oferta" y "por Otras Características".</li>
		<li>Se modificó la búsqueda por CUE para que encuentre CUEs parciales (Ej: que contengan "118"), y CUEs con Anexo (Ej: "600118<b>00</b>").</li>
	</ul>
</li>
<br>
<li><b>Datos de Institución</b>
 	<ul><li> Se corrigieron, depuraron y normalizaron los datos de todas las instituciones.</li></ul>
</li>
<br>
<li><b>Oferta</b> 
	<ul><li>Se agregó funcionalidad a la página de oferta permitiendo búsquedas y ordenamientos sobre el listado
			de las mismas.</li>
		<li>Se implementó la posibilidad de marcar como pendiente de actualización a una institución cuando la documentación de la oferta educativa recibida está incompleta.</li>
	</ul>
</li>
<br>	
<li><b>Buscador Histórico de CUE</b>
	<ul>
	  <li>
	  Se agregó la posibilidad de buscar CUEs que hayan pertenecido a una institución.
	  </li>
	</ul>
</li> 
<br>
<li><b>Optimización</b>
	<ul><li> Se mejoró la velocidad de respuesta del sistema en las búsquedas y navegación del sitio.</li></ul>
</li>
<br>
</ul>

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
Unidad de Información: Of. 309.
</p>