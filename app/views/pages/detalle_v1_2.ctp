
<?php echo $html->image('nuevo.gif',array('width'=> '39px','style'=>'float:left'));?>
<h1 style='padding-left: 55px;'>¿Que hay de nuevo en la versión 1.2?</h1>

<br>
<ul type="disk">
  <li>
    <b>Buscador</b>
  </li>
  <ul type="circle">
    <li> - Se modificó la búsqueda por CUE para que encuentre CUEs parciales. Ej: 2000, 64255, 118.</li>
	<li> - Se agregó la posibilidad de buscar CUE con Anexo. Ej: 600118<b>00</b></li>
	<li> - Se ordenaron las opciones de búsqueda en diferentes categorías: "por su Ubicación", "por su Nombre", "por su Oferta" y "por Otras Características".</li>
    <li> - Se agregó opción de búsqueda por Oferta.</li>
    <li> - Se agregó opción de búsqueda por Normativa.</li>
    <li> - Se normalizaron las búsquedas por localidad y departamento.</li>
	<li> - Se agregó selector de páginas.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Instituciones</b>
  </li>
  <ul type="circle">
	<li> - Se agregó la posibilidad de asignar un CUE histórico a la institución.</li>
	<li> - Se agregó la funcionalidad para que cuando el CUE es modificado el sistema conserve como histórico el CUE anterior.</li>
	<li> - Al momento de dar de alta una institución se modificó para que la opción "estatal" no se encuentre seleccionada por defecto.</li>
	<li> - Al momento de dar de alta o de modificar una institución se agregó una búsqueda de datos "similares" con el objetivo de poder visualizar antes de la carga si la institución 
	       no fue ingresada anteriormente. </li>
  </ul>
  
  <br>
  
  <li>
    <b>Datos de Instituciones</b>
  </li>
  <ul type="circle">
    <li> - Se dividió el atributo "Nombre" en 3 partes: "Tipo de Establecimiento", "Número de Institución" y "Nombre", permitiendo una mejor 
           clasificación al momento de las estadísticas.</li>
	<li> - Se modificó el atributo "Tipo de Institución" por "Tipo de Establecimiento".</li>
	<li> - Se normalizaron y depuraron los datos de Jurisdicción, departamento y Localidad.</li>

	<li> - Se agregaron los atributos "teléfono alternativo" y "mail alternativo" tanto para la institución como para el director.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Oferta Educativa</b>
  </li>
  <ul type="circle">
    <li> - Se agregó la posibilidad de Ordenar el listado de Ofertas que posee la institución.</li>
	<li> - Se agregó la paginación al listado de ofertas.</li>
	<li> - Se agregaron opciones de búsqueda al listado de ofertas.</li>	
	<li> - Se agregó la posibilidad de marcar como pendiente de actualización a una institución cuando la documentación de la oferta educativa recibida está incompleta.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Buscador Histórico de CUE</b>
  </li>
  <ul type="circle">
    <li> - Se agregó la posibilidad de buscar CUEs que hayan pertenecido a una institución.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Pendiente de Actualización</b>
  </li>
  <ul type="circle">
    <li> - Se agregó un listado de Instituciones que presentan una oferta educativa pendiente de actualización, dividido por provincia.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Informes</b>
  </li>  
  <ul type="circle">
    <li> - Nuevo Informe sobre cantidad de Instituciones ingresadas, no ingresadas por ámbito de gestión y tipo de Establecimiento según jurisdicción.</li>
	<li> - Listado de instituciones discriminadas por su oferta.</li>
	<li> - Nuevo Informe sobre Certificados y Títulos separados por su oferta (FP, Itinerarios, Secundario Técnico y Superior Técnico).</li>
	<li> - Informe sobre Planes y Títulos por jurisdicción.</li>
    <li> - Nuevo Informe sobre planes/títulos con la última información registrada para cada establecimiento.</li>
    <li> - Promedio de duración en horas del plan con oferta Formación Profesional, por tipo de establecimiento.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Optimización</b>
  </li>
  <ul type="circle">
    <li> - Se mejoró la velocidad de respuesta del sistema en las búsquedas y navegación del sitio.</li>
  </ul>
</ul>