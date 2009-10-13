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
<h2>¿Que novedades hay en la versión 1.2?</h2>

<p>
<ul>
	<li><b>Histórico de CUE:</b> Búsqueda por CUE avanzada. Almacenamiento histórico de CUE para aquellas instituciones que lo hayan cambiado.</li>	
	<li><b>Buscador:</b> Se incorporaron más criterios de búsqueda y se reordenó el buscador.</li>
	<li><b>Ofertas: </b>Instituciones con planes pendientes de actualización.</li>
	<li><b>Optimización: </b>Mejoras en la velocidad de búsqueda y navegación.</li>
	<li><b>Reestructuración de la base de datos:</b> Mejores y más estádisticas.</li>
	<li><b>Datos de la Institución:</b>Las institucioones ahora tienen normalizado: Tipo, número y nombre de institución, localidad y departamento.</li>
	<br>
	<ul><li><?php echo $html->link('ver listado completo de mejoras','/pages/detalle_v1_2');?></li></ul>
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
Unidad de Información, Of. 309.
</p>