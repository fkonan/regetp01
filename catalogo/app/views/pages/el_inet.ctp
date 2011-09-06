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
    <h1>El Instituto Nacional de Educación Tecnológica</h1>
    <div class="boxblanca boxdocs">
            
        <h3>Estructura</h3>
        <div>
        <!--[if !IE]>-->
          <object data="../img/entidades.svg" type="image/svg+xml"
                  width="100%" height="400" id="mySVGObject"> <!--<![endif]-->
        <!--[if lt IE 9]>
          <object src="../img/entidades.svg" classid="image/svg+xml"
                  width="700" height="391" id="mySVGObject"> <![endif]-->
        <!--[if gte IE 9]>
          <object data="../img/entidades.svg" type="image/svg+xml"
                  width="700" height="391" id="mySVGObject"> <![endif]-->
          </object>
        </div>
        <div id="descripcion"></div>
                
        <h3>Propósitos</h3>

        Los lineamientos, las estrategias y los programas llevados a cabo, a partir del trabajo 
        conjunto entre las veinticuatro jurisdicciones educativas del país y el INET están 
        orientados a:
        <ol>
            <li>Fortalecer, en términos de calidad y pertinencia, la educación técnico profesional 
                para favorecer procesos de inclusión social y facilitar la incorporación de la juventud al 
                mundo del trabajo y la formación continua de los adultos a lo largo de su vida activa, y 
                responder a las nuevas exigencias y requerimientos derivados de la innovación 
                tecnológica, el crecimiento económico y la reactivación de los sistemas productivos.</li>
            <li>Desarrollar un sistema integrado de educación técnico-profesional que articule entre 
                sí los niveles de educación secundaria y superior y éstos con las diversas instituciones y 
                programas de formación y capacitación para y en el trabajo, en el marco de los 
                requerimientos del desarrollo científico, técnico y tecnológico, de calificación, de 
                productividad y de empleo.</li>
            <li>
                Dar respuesta a la necesidad de otorgar a la educación técnico profesional una 
                identidad como modalidad del sistema educativo, significar su carácter estratégico en 
                términos de desarrollo social y económico, valorar su estatus social y educativo, 
                actualizar sus modelos institucionales y estrategias de intervención aproximándola a 
                estándares internacionales de calidad.
            </li>
        </ol>
        <h3>Ideas eje</h3>
        <ol>
            <li>Carácter estratégico de la educación técnico profesional para el desarrollo social
    y el crecimiento económico.
            </li>
            <li>Vinculación con los sectores de la ciencia y la tecnología, el trabajo y la
    producción.
            </li>
            <li>Relevancia y pertinencia con necesidades sociales y productivas ? sectorial y
    territorial ?.
            </li>
            <li>Efectividad político-técnica de la acción conjunta con las jurisdicciones
    educativas, en el marco de los acuerdos federales.
            </li>
            <li>Integración sistémica y calidad de las instituciones y las trayectorias formativas.
            </li>
            <li>Inversión sostenida para la mejora continua de la educación técnico profesional.
            </li>
        </ol>
    </div>
</div>

<script type="text/javascript">
  window.onsvgload = function(){
    /*texto temporal*/
    var lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat lacus, facilisis sed scelerisque dictum, accumsan eu nunc. Maecenas sed ligula sed quam luctus consectetur. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.";
    var nodos = [
      {id:"g_ministerio", texto:lorem},
      {id:"g_consejo_educ", texto:"Ámbito de concertación, acuerdo y coordinación de la política educativa nacional, presidido por el Ministro de Educación e integrado por las autoridades educativas de las 24 jurisdicciones."},
      {id:"g_secretaria_educ", texto:lorem},
      {id:"g_secretaria_politicas", texto:lorem},
      //{id:"g_inet", texto:lorem},
      {id:"g_consejo_etp", texto:"Consejo asesor del Ministerio de Educación integrado por representantes de los Ministerios de Trabajo, Ciencia y Tecnología, Economía, Producción, cámaras y asociaciones empresarias, sindicatos y gremios sectoriales y docentes, colegios profesionales de técnicos."},
      {id:"g_comision_etp", texto:"Espacio de trabajo conjunto con los equipos político-técnicos de las 24 jurisdicciones del país."}
    ];

    animar_cuadros('mySVGObject', nodos, 'descripcion');
  };
</script>