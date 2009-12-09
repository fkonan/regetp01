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

<h2>Novedades de la versión 1.3</h2>

<p>
Desde su puesta en funcionamiento en junio del presente año el nuevo sistema RFIETP se encuentra en permanente actualización y mejora, tanto del
contenido de información de la base de datos como de la aplicación que permite su gestión. En esa línea de trabajo a partir del 4 de Diciembre
se ha instalado la versión 1.3 del sistema.
</p>

<p>
A continuación se ofrece un resumen de algunos de los cambios realizados desde su puesta en funcionamiento. 
El listado no es exhaustivo y se orienta principalmente a destacar las mejoras que pueden facilitar el uso 
del sistema desde la perspectiva de un usuario de consulta habitual.
</p>

<p>
Un listado completo de las modificaciones realizadas en esta última versión, puede encontrarlas haciendo click <?php echo $html->link('aquí','/pages/detalle_v1_2');?>.
</p>

<p>
<ul>


<li>
	<li>
		<b>Buscador</b> 
		<ul>
			<li>Se agregó una opción de búsqueda por "nombre completo" que evalúa tipo y número de establecimiento además del nombre propio de la institución. (Ahora se puede buscar, por ejemplo: "Escuela 3 San Martín".)</li>
		   	<li>Se agregaron opciones de búsqueda por oferta y por normativa.</li>
	    	<li>Se mejoraron las búsquedas por localidad y departamento.</li>
	    	<li>Se ordenaron las opciones de búsqueda en diferentes categorías: "por su ubicación", "por su nombre", "por su oferta" y "por otras características".</li>
	    	<li>Se modificó la búsqueda por CUE para que detecte CUEs por coincidencia parcial (Ej: Si se ingresa "118" el programa encuentra todos los CUEs que contengan "118" en cualquier posición).</li>
    		<li>Se agregó la posibilidad de buscar CUE con Anexo. (Ej: "60011800")</li>
		</ul>
	</li>

	<br>

	<li>
		<b>Cuadros</b>
 		<ul>
 			<li>Se presenta a partir de esta versión una serie de cuadros estadísticos relevantes. El primer cuadro publicado ofrece información sobre "Total de Instituciones de Educación Técnica Profesional por ámbito de gestión según división político-territorial". El cuadro se construye dinámicamente con la información más actual de la base de datos y está preparado para su impresión.</li>
 		</ul>
	</li>
	
	<br>
	
	<li>
		<b>Datos de Institución</b>
 		<ul>
 			<li>Se mejoraron y depuraron los siguientes datos de las instituciones: Tipo de Establecimiento, Número, Nombre, Departamento y Localidad.</li>
 			<li>Se agregaron dos categorías nuevas para clasificar instituciones. Por el tipo de institución un establecimiento puede ser clasificado como: "Superior", "Secundario", "Formación Profesional" ó "Con Itinerario Formativo". Por otro lado una institución puede ser categorizada como "Institución de ETP" ó "Institución con programa de ETP". Estas categorizaciones facilitan el procesamiento estadístico que realiza la Unidad de Información. En breve se agregará al aplicativo un glosario con las definiciones correspondientes.</li>
 		</ul>
	</li>
	
	<br>
	
	<li>
		<b>Oferta Educativa</b> 
		<ul>
			<li>Se incorporó una nueva forma de visualizar el listado de ofertas. Se muestran inicialmente los datos correspondientes al año en curso, pero se puede luego navegar por datos históricos y visualizar todos los años.</li>
			<li>Se mejoró la presentación de información de oferta educativa: se incorporó paginación de resultados, y se agregaron opciones de filtro y ordenamiento del listado según distintos criterios.</li>
			<li>Se agregó un sistema de marcas para identificar como pendiente de actualización una institución cuando la documentación de la oferta educativa recibida está incompleta. El sistema informa el motivo del pendiente, el estado del reclamo, etc. Esto permite al usuario conocer el estado de la información e identificar faltantes sin tener que recurrir necesariamente a la Unidad de Información.</li>
		</ul>
	</li>
	
	<br>

  	<li>
  		<b>Diseño</b>
  		<ul type="circle">
    		<li>Se mejoró el diseño de la barra de navegación lateral y la distribución de información en pantalla.</li>
  		</ul>
  	</li>
  	
  	<br>
  	
	<li>
		<b>Optimización</b>
		<ul>
			<li>Se mejoró la velocidad de respuesta del sistema en búsquedas y presentación de información.</li>
		</ul>
	</li>
	   
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