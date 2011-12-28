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

<br />

<h2>Versión <?php echo Configure::read('regetpVersion');?></h2>

<p>Desde su puesta en funcionamiento en junio de 2009 el sistema RFIETP se encuentra en permanente actualización y mejoramiento, tanto del contenido de información de la base de datos como de la aplicación que permite su gestión. En esa línea de trabajo a partir del 5 de diciembre de 2011 se ha instalado la versión  <?php echo Configure::read('regetpVersion');?> del sistema. Sus principales novedades son:</p>
<ul>
    <li>Se publicaron los Planes de Mejora correspondientes al tercer trimestre del 2011.</li>
    <li>Se mejoró el procedimiento de registro de nuevos usuarios al sistema (con gestión automática de contraseña privada y segura).</li>
    <li>Se mejoró el mensaje de alerta de oferta educativa desactualizada para las instituciones, especificando el último ciclo de actualización como referencia.</li>
    <li>Se agregó el atributo "Carrera prioritaria" a los Títulos de referencia para identificar los Títulos incorporados al Programa Nacional de Becas Bicentenario.</li>
    <li>Se ordenó la presentación de oferta educativa en toda la aplicación según el siguiente criterio: Secundaria técnica, Superior y Formación Profesional.</li>
</ul>
Un listado completo de las modificaciones realizadas en esta última versión, puede encontrarlas haciendo click
<? echo $html->link('aquí','/pages/detalle_versiones')?>.
</p>

<br/>
<hr/>
<br/>

<?php echo $this->element('contacto'); ?>