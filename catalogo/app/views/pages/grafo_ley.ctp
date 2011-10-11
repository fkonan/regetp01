<?php 
echo $javascript->link('animar_cuadros');
?>
<style type="text/css">
  #descripcion{
    background-color: lightgray;
    border: 2px solid gray;
    border-radius: 10px 10px 10px 10px;
    left: 600px;
    padding: 10px;
    position: absolute;
    top: 50px;
    width: 250px;
    display:none;
  }
</style>
<div class="grid_12">
    <h1>Las políticas para la Educación Técnico Profesional en Argentina</h1>
    <div class="boxblanca boxdocs">        
        Los lineamientos, las estrategias y los programas llevados a cabo a partir del trabajo conjunto,
        de carácter federal, entre las veinticuatro jurisdicciones educativas y el Instituto Nacional de
        Educación Tecnológica están orientados a:
        <ul>
            <li>Fortalecer, en términos de calidad y pertinencia, la educación técnico profesional
                para favorecer procesos de inclusión social y facilitar la incorporación de la juventud al
                mundo del trabajo y la formación continua de los adultos a lo largo de su vida activa,
                y responder a las nuevas exigencias y requerimientos derivados de la innovación
                tecnológica, el crecimiento económico y la reactivación de los sistemas productivos.</li>
            <li>Desarrollar un sistema integrado de educación técnico-profesional que articule
                entre sí los niveles de educación secundaria y superior y éstos con las diversas
                instituciones y programas de formación y capacitación para y en el trabajo, en el marco
                de los requerimientos del desarrollo científico, técnico y tecnológico, de calificación, de
                productividad y de empleo.</li>
            <li>Dar respuesta a la necesidad de otorgar a la educación técnico profesional una
                identidad como modalidad del sistema educativo, significar su carácter estratégico
                en términos de desarrollo social y económico, valorar su estatus social y educativo,
                actualizar sus modelos institucionales y estrategias de intervención aproximándola a
                estándares internacionales de calidad.</li>
        </ul>
        
        La Ley de Educación Técnico Profesional, sancionada en 2005, expresa tales políticas a
        través de la creación de tres instrumentos de regulación y de un fondo de inversión que
        permiten poner en acción criterios federales de unidad nacional. 
        
        <br />
        Esquemáticamente:
        
        <div class="centrado">

          <object data="<?php echo $html->url('/img/grafo.svg') ?>" type="image/svg+xml"
                 width="690" height="340" id="mySVGObject">
          </object>
        </div>
        <div id="descripcion"></div>
        <br />
    </div>
</div>

<script type="text/javascript">
  window.onsvgload = function(){
  	/*texto temporal*/
  	var lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat lacus, facilisis sed scelerisque dictum, accumsan eu nunc. Maecenas sed ligula sed quam luctus consectetur. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.";
    /*ids de cada grupo del svg con su texto corresponidente*/
    var nodos = [
//      {id:"g_bases", titulo: "Bases de Datos de Institucionales de ETP", texto:lorem},
      {id:"g_homologacion", titulo: "Proceso de Homologación", texto:"Consiste en el análisis de planes de estudio relativos a titulaciones técnicas o certificados de formación profesional y su evaluación comparativa con un conjunto de criterios básicos y estándares indicados como referencia para cada uno de ellos, a efectos de establecer su correspondencia. Los marcos de referencia enuncian el conjunto de los criterios básicos y estándares que definen y caracterizan los aspectos sustantivos a ser considerados en el proceso de homologación de los títulos o certificados y sus correspondientes ofertas formativas, brindando los elementos necesarios para llevar a cabo las acciones de análisis y de evaluación comparativa antes señaladas."},
      {id:"g_registro", titulo:"Registro Federal de Instituciones de Educación Técnico Profesional", texto:"El Registro Federal de Instituciones de Educación Técnico Profesional (RFIETP) es la instancia de inscripción de las instituciones que emiten títulos y certificados de Educación Técnica Profesional que presentan cada una de las jurisdicciones provinciales y universidades nacionales. El  RFIETP   contiene los  datos básicos de establecimiento (nombre de la institución, dirección, localidad, departamento, teléfono, director, entre otros), e información referida sus los planes de estudio (títulos, cantidad de horas taller en la semana, cantidad de matriculados, de secciones, entre otras); Esta información resulta de insumo para:        <ol>            <li>Diagnosticar, planificar y llevar a cabo planes de mejora que se apliquen con prioridad a aquellas escuelas que demanden un mayor esfuerzo de reconstrucción y desarrollo</li><li>Fortalecer a aquellas instituciones que se puedan preparar como centros de referencia en su especialidad técnica y </li><li>Alcanzar en todas las instituciones incorporadas los criterios y parámetros de calidad de la educación profesional acordados por el Consejo Federal de Cultura y Educación (Ley  Nº 26.058/2005, Capitulo IV, Artículo Nº 34). El Registro funciona entonces como insumo para la evaluación de los programas de fortalecimiento institucional que presentan las instituciones educativas al INET en el marco de los planes de mejora continua de la calidad de la educación técnico profesional del Fondo Nacional para la Educación Técnico Profesional</li></ol>"},
      {id:"g_catalogo", titulo: "Catálogo Nacional de Títulos y Certificaciones", texto:"Constituye una fuente de información para múltiples usuarios sobre certificados y títulos de educación técnico profesional y sus correspondientes ofertas formativas. Se organiza a partir de criterios sectoriales y territoriales y en función de familias y figuras profesionales."},
//      {id:"g_fortalecimiento", titulo: "Fortalecimiento de la Gestión", texto:lorem},
//      {id:"g_estudios", titulo: "Estudios e Investigaciones", texto:lorem},
      {id:"g_fondo", titulo: "Fondo Nacional para la Educación Técnico Profesional", texto:"Tiene como propósito garantizar la inversión necesaria para asegurar el acceso a todos los ciudadanos a una educación técnico profesional de calidad en todo el territorio de la Nación Argentina. Se financia con un monto anual que no puede ser inferior al 0,2% del total de los Ingresos Corrientes previstos en el Presupuesto Anual Consolidado para el Sector Público Nacional."}
    ];

    animar_cuadros('mySVGObject', nodos, 'descripcion');
  };
</script>
<script src="<?= $this->webroot ?>js/svg/svg.js" data-path="<?=$this->webroot.'js/svg/'?>" ></script>