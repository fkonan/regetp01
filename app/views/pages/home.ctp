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
encuentra en permanente actualización y mejora, tanto del 
contenido de información de la base de datos como de la aplicación que permite 
su gestión. En esa línea de trabajo a partir del 20 de octubre se ha instalado 
la versión 1.2 del sistema.
</p>
<p>
A continuación se ofrece un resumen de algunas de los cambios realizados desde su puesta en 
funcionamiento. El listado no es exhaustivo y se orienta principalmente a destacar las mejoras 
que pueden facilitar el uso del sistema desde la perspectiva de un usuario de consulta habitual.
</p>
<p>
Un listado completo de las modificaciones, más avanzado, se puede <?php echo $html->link('consultar aquí.','/pages/detalle_v1_2');?>
</p>

<p>
<ul>
<li><b>Buscador</b> 
	<ul>
	   	<li>Se agregó opción de búsqueda por oferta.</li>
    	<li>Se agregó opción de búsqueda por normativa.</li>
    	<li>Se mejoraron las búsquedas por localidad y departamento.</li>
    	<li>Se ordenaron las opciones de búsqueda en diferentes categorías: "por su ubicación", "por su nombre", "por su oferta" y "por otras características".</li>
    	<li>Se modificó la búsqueda por CUE para que detecte CUEs por coincidencia parcial (Ej: Si se ingresa "118" el programa encuentra todos los CUEs que contengan "118" en cualquier posición).</li>
    	<li>Se agregó la posibilidad de buscar CUE con Anexo. (Ej: 2"60011800")</li>
	</ul>
</li>
<br>
<li><b>Datos de Institución</b>
 	<ul><li>Se mejoraron y depuraron los siguientes datos de las instituciones: Tipo de Establecimiento, Número, Nombre, Departamento y Localidad.</li></ul>
</li>
<br>
<li><b>Oferta Educativa</b> 
	<ul>
		<li>Se mejoró la presentación de información de oferta educativa: se incorporó paginación de resultados, y se agregaron opciones de filtro y ordenamiento del listado según distintos criterios.</li>
		<li>Se agregó un sistema de marcas para identificar como pendiente de actualización una institución cuando la documentación de la oferta educativa recibida está incompleta. El sistema informa el motivo del pendiente, el estado del reclamo, etc. Esto permite al usuario conocer el estado de la información e identificar faltantes sin tener que recurrir necesariamente a la Unidad de Información.</li>
	</ul>
</li>
<br>
<li><b>Optimización</b>
	<ul><li>Se mejoró la velocidad de respuesta del sistema en búsquedas y presentación de información.</li></ul>
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
Unidad de Información: Of. 311.
</p>