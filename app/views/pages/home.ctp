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

<h2>Versión 1.4</h2>

<ul>
    <li><b>Orientación de la Institución</b></li>
    <ul type="circle">
        <li>Se agregó una "Orientación" a cada Institución ingresada.</li>
        <li>Se migró información de los excel de la Unidad de Información</li>
    </ul>

    <li><b>Títulos de Referencia</b></li>
    <ul type="circle">
        <li>Se agrego la posibilidad de agregar Títulos de Referencia a los planes.</li>
        <li>Se migró información de los excel de la Unidad de Información</li>
    </ul>

    <li><b>Cambios generales</b></li>
    <ul type="circle">
        <li>Se proporcionó una interfaz web de depuración, para que el personal especializado defina los nuevos valores y asi poder visualizar esta nueva información lo antes posible.</li>
        <li>Se realizaron informes estadísticos.</li>
    </ul>
</ul>

<br>

<p>
Un listado completo de las modificaciones realizadas en esta última versión, puede encontrarlas haciendo click <?php echo $html->link('aquí','/pages/detalle_v1_2');?>.
</p>

	 
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