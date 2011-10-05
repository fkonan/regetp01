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
        <div class="centrado">
                        
             <object data="<?php echo $html->url('/img/entidades.svg') ?>" type="image/svg+xml" width="700" height="400"
                  id="mySVGObject"> 
            </object>

          
        </div>
        <div id="descripcion"></div>
                
        <!--<h3>Propósitos</h3>

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
        </ol>-->
    </div>
</div>

<script type="text/javascript">
  window.onsvgload = function(){
    /*texto temporal*/
    var lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat lacus, facilisis sed scelerisque dictum, accumsan eu nunc. Maecenas sed ligula sed quam luctus consectetur. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.";
    var nodos = [
      {id:"g_ministerio", titulo: "Ministerio de Educación", link:"http://www.me.gov.ar/"},
      {id:"g_consejo_educ", titulo: "Consejo Federal de Educación", texto:"Ámbito de concertación, acuerdo y coordinación de la política educativa nacional, presidido por el Ministro de Educación Nacional e integrado por las autoridades educativas de las 23 provincias argentinas y de la Ciudad Autónoma de Buenos Aires.<br/><p>Para obtener más información <a target='_blank' href='http://portal.educacion.gov.ar/consejo/2009/12/04/el-consejo/'>haga click aquí</a></p>"},
      //{id:"g_secretaria_educ___"},
      //{id:"g_secretaria_politicas___"},
      {id:"g_inet", link:"http://www.inet.edu.ar/"},
      {id:"g_consejo_etp", titulo: "Consejo Nacional de Educación Trabajo y Producción (CONETyP)", texto:"Este Consejo, cuya Secretaría Permanente lleva la Dirección Ejecutiva del INET, tiene como función asesorar al Ministro de Educación en todos los aspectos que tiendan a la vinculación de la educación con el mundo del trabajo, de la producción, de la ciencia y la tecnología.<BR /> En el marco de dicho Consejo se desarrollan foros sectoriales, constituidos por referentes clave de cada sector, a partir de los cuales se elaboran las propuestas específicas de formación y capacitación.<BR />Para asegurar su representatividad, el CONETyP se conforma con representantes de los Ministerios de Educación, de Trabajo y de Producción, de Ciencia y Tecnología, del Consejo Federal de Educación, de las cámaras empresarias - en particular de la pequeña y mediana empresa -, de las organizaciones de los trabajadores, incluidas las entidades gremiales docentes, las entidades profesionales de técnicos, y de entidades empleadoras que brindan educación técnico profesional de gestión privada."},
      {id:"g_comision_etp", titulo: "Comisión Federal de Educación Técnico Profesional",texto: "Esta Comisión creada por Ley de Educación Técnico Profesional Nº 26058, art. 49 y 50 tiene como propósito principal garantizar los circuitos de consulta técnica para la formulación y seguimiento de los programas federales orientados a la aplicación de dicha Ley en el marco de los acuerdos del Consejo Federal de Educación, como organismo de concertación de la política educativa nacional.<br/>La Comisión Federal de Educación Técnico Profesional está integrada por los representantes de las provincias y del Gobierno de la Ciudad Autónoma de Buenos Aires, designados por las máximas autoridades jurisdiccionales respectivas y su actividad está coordinada por la Dirección Ejecutiva del INET."}
    ];

    animar_cuadros('mySVGObject', nodos, 'descripcion');
  };
</script>
<script src="<?= $this->webroot ?>js/svg/svg.js" data-path="<?=$this->webroot.'js/svg/'?>" ></script>