<h1>RFIETP - Novedades de la versión 1.4</h1>

<br>
<ul>
    <li><b>Orientación de la Institución</b></li>
    <ul type="circle">
        <li>Se agregó una "Orientación" a cada Institución ingresada.</li>
        <li>Las Orientaciones posibles son: Agropecuaria, Industrial u Otra.</li>
        <li>Se migró información de los excel de la Unidad de Información</li>
    </ul>
    <br>
    <li><b>Títulos de Referencia</b></li>
    <ul type="circle">
        <li>Se agregó la posibilidad de agregar Títulos de Referencia a los planes.</li>
        <li>Se migró información de los excel de la Unidad de Información</li>
    </ul>
    <br>
    <li><b>Cambios Generales</b></li>
    <ul type="circle">
        <li>Se proporcionó una interfaz web de depuración, para que el personal especializado defina los nuevos valores y asi poder visualizar esta nueva información lo antes posible.</li>
        <li>Se realizaron informes estadísticos.</li>
        <li>Se modificaron las vistas de Instituciones y Planes.</li>
        <li>Se incorporaron éstos nuevos campos como criterios de búsqueda en el buscador. (esto solo es válido para los usuarios de la Unidad de Información hasta tanto no se haya cargado toda la información correspondiente a las orientaciones y a los títulos de referencia)</li>
    </ul>
</ul>

<h1>RFIETP - Novedades de la versión 1.3</h1>

<br>

<ul>

	<li>
    <b>Diseño</b>
  </li>
  <ul type="circle">
    <li>Se modificó el encabezado.</li>
    <li>Se modificó el menú de navegación.</li>
    <li>Se agregaron solapas para la navegación de los datos históricos de la matrícula en el listado de ofertas de la institución.</li>
  </ul>
  
   <br>


  <li>
    <b>Buscador</b>
  </li>
  <ul type="circle">
    <li>Se agregó una opción de búsqueda por "nombre completo" que evalúa tipo y número de establecimiento además del nombre propio de la institución. (Ahora se puede buscar, por ejemplo: "Escuela 3 San Martín".)
	</li>
  </ul>
  
  
   <li>
    <b>Cuadros</b>
  </li>
  <ul type="circle">
    <li>Se presenta a partir de esta versión una serie de cuadros estadísticos relevantes. El primer cuadro publicado ofrece información sobre "Total de Instituciones de Educación Técnica Profesional por ámbito de gestión según división político-territorial". El cuadro se construye dinámicamente con la información más actual de la base de datos y está preparado para su impresión.
	</li>
  </ul>
  
  
   <br>
  
  <li>
    <b>Instituciones</b>
  </li>
 	<ul type="circle">
    	<li>Se agregaron dos categorías nuevas para clasificar instituciones. Por el tipo de institución un establecimiento puede ser clasificado como: "Superior", "Secundario", "Formación Profesional" ó "Con Itinerario Formativo". Por otro lado una institución puede ser categorizada como "Institución de ETP" ó "Institución con programa de ETP". Estas categorizaciones facilitan el procesamiento estadístico que realiza la Unidad de Información. En breve se agregará al aplicativo un glosario con las definiciones correspondientes.
		</li>
  	</ul>
  	
  
  <br>
  
  <li>
    <b>Oferta Educativa</b>
  </li>
 	<ul type="circle">
    <li>Se incorporó una nueva forma de visualizar el listado de ofertas. Se muestran inicialmente los datos correspondientes al año en curso, pero se puede luego navegar por datos históricos y visualizar todos los años.</li>
  	</ul>
  	
  	<br />  
  
  
	<li>
    <b>Optimización</b>
  </li>
  <ul type="circle">
    <li>Se implementó Caché  en las páginas clave del sistema para obtener un mejor rendimiento y velocidad de respuesta del servidor.</li>
  </ul>
  
   <br>
   
   
   <li>
    <b>Varios</b>
  </li>
  <ul type="circle">
    <li>Se desarrolló un nuevo módulo para realizar una revisión y reclasificación del trabajo ya realizado en la primera etapa de depuración de la información de "sectores" de títulos y certificados.</li>
    <li>Se elaboraron scripts para imputar automáticamente valores en los nuevos campos creados para las categorías "Relación con ETP" y "Tipo de institución".</li>
    <li>Se desarrolló un depurador para verificación de Relación con ETP y Clase de institución.</li>
    <li>Se realizaron pruebas de acceso al sistema a través de Internet.</li>
  </ul>
   
   
  
  <br><br>
  
  
  

<h1>RFIETP - Novedades de la versión 1.2</h1>

<br>
<ul >
  <li>
    <b>Buscador</b>
  </li>
  <ul type="circle">
    <li> Se modificó la búsqueda por CUE para que encuentre CUEs parciales. Ej: 2000, 64255, 118.</li>
	<li> Se agregó la posibilidad de buscar CUE con Anexo. Ej: 600118<b>00</b></li>
	<li> Se ordenaron las opciones de búsqueda en diferentes categorías: "por su Ubicación", "por su Nombre", "por su Oferta" y "por Otras Características".</li>
    <li> Se agregó opción de búsqueda por Oferta.</li>
    <li> Se agregó opción de búsqueda por Normativa.</li>
    <li> Se normalizaron las búsquedas por localidad y departamento.</li>
	<li> Se agregó selector de páginas.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Instituciones</b>
  </li>
  <ul type="circle">
	<li> Se agregó la posibilidad de asignar un CUE histórico a la institución.</li>
	<li> Se agregó la funcionalidad para que cuando el CUE es modificado el sistema conserve como histórico el CUE anterior.</li>
	<li> Al momento de dar de alta una institución se modificó para que la opción "estatal" no se encuentre seleccionada por defecto.</li>
	<li> Al momento de dar de alta o de modificar una institución se agregó una búsqueda de datos "similares" con el objetivo de poder visualizar antes de la carga si la institución 
	       no fue ingresada anteriormente. </li>
  </ul>
  
  <br>
  
  <li>
    <b>Datos de Instituciones</b>
  </li>
  <ul type="circle">
    <li> Se dividió el atributo "Nombre" en 3 partes: "Tipo de Establecimiento", "Número de Institución" y "Nombre", permitiendo una mejor 
           clasificación al momento de las estadísticas.</li>
	<li> Se modificó el atributo "Tipo de Institución" por "Tipo de Establecimiento".</li>
	<li> Se normalizaron y depuraron los datos de Jurisdicción, departamento y Localidad.</li>
	<li> Se agregaron los atributos "teléfono alternativo" y "mail alternativo" para la institución.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Oferta Educativa</b>
  </li>
  <ul type="circle">
    <li> Se agregó la posibilidad de Ordenar el listado de Ofertas que posee la institución.</li>
	<li> Se agregó la paginación al listado de ofertas.</li>
	<li> Se agregaron opciones de búsqueda al listado de ofertas.</li>	
	<li> Se agregó la posibilidad de marcar como pendiente de actualización a una institución cuando la documentación de la oferta educativa recibida está incompleta.</li>
  </ul>  
  <br>
  
  <li>
    <b>Buscador Histórico de CUE</b>
  </li>
  <ul type="circle">
    <li> Se agregó la posibilidad de buscar CUEs que hayan pertenecido a una institución.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Pendiente de Actualización</b>
  </li>
  <ul type="circle">
    <li> Se agregó un listado de Instituciones que presentan una oferta educativa pendiente de actualización, dividido por provincia.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Informes</b>
  </li>  
  <ul type="circle">
    <li> Nuevo Informe sobre cantidad de Instituciones ingresadas, no ingresadas por ámbito de gestión y tipo de Establecimiento según jurisdicción.</li>
	<li> Listado de instituciones discriminadas por su oferta.</li>
	<li> Nuevo Informe sobre Certificados y Títulos separados por su oferta (FP, Itinerarios, Secundario Técnico y Superior Técnico).</li>
	<li> Informe sobre Planes y Títulos por jurisdicción.</li>
    <li> Nuevo Informe sobre planes/títulos con la última información registrada para cada establecimiento.</li>
    <li> Promedio de duración en horas del plan con oferta Formación Profesional, por tipo de establecimiento.</li>
  </ul>
  
  <br>
  
  <li>
    <b>Optimización</b>
  </li>
  <ul type="circle">
    <li> Se mejoró la velocidad de respuesta del sistema en las búsquedas y navegación del sitio.</li>
  </ul>
</ul>