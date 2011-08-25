<div class="clear separador"></div>
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
    <div class="boxblanca boxdocs">
        <h1>Estructura del Instituto Nacional de Educación Tecnológica</h1>
        <div>
        <!--[if !IE]>-->
          <object data="../img/entidades.svg" type="image/svg+xml"
                  width="700" height="391" id="mySVGObject"> <!--<![endif]-->
        <!--[if lt IE 9]>
          <object src="../img/entidades.svg" classid="image/svg+xml"
                  width="700" height="391" id="mySVGObject"> <![endif]-->
        <!--[if gte IE 9]>
          <object data="../img/entidades.svg" type="image/svg+xml"
                  width="700" height="391" id="mySVGObject"> <![endif]-->
          </object>
        </div>
        <div id="descripcion"></div>
        <h1>Propósitos</h1>

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
        <h1>Ideas eje</h1>
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

  /* esto es un hack para que jquery me deje animar propiedades que no son de CSS */
  var $_fx_step_default = $.fx.step._default;
  $.fx.step._default = function (fx) {
    if (!fx.elem.customAnimate) return $_fx_step_default(fx);
    fx.elem[fx.prop] = fx.now;
    fx.elem.updated = true;
  };

  window.onsvgload = function(){
    /*ids de cada grupo del svg con su texto corresponidente*/
    var nodos = [
      {id:"g_ministerio", texto:""},
      {id:"g_consejo_educ", texto:"Ámbito de concertación, acuerdo y coordinación de la política educativa nacional, presidido por el Ministro de Educación e integrado por las autoridades educativas de las 24 jurisdicciones."},
      {id:"g_secretaria_educ", texto:""},
      {id:"g_secretaria_politicas", texto:""},
      {id:"g_inet", texto:""},
      {id:"g_consejo_etp", texto:"Consejo asesor del Ministerio de Educación integrado por representantes de los Ministerios de Trabajo, Ciencia y Tecnología, Economía, Producción, cámaras y asociaciones empresarias, sindicatos y gremios sectoriales y docentes, colegios profesionales de técnicos."},
      {id:"g_comision_etp", texto:"Espacio de trabajo conjunto con los equipos político-técnicos de las 24 jurisdicciones del país."}
    ];


    var doc = document.getElementById('mySVGObject').contentDocument;
    var len = nodos.length;
    for(var i = 0; i<len ; i++){
      var nodo = doc.getElementById(nodos[i]["id"]);
      $(nodo).mouseenter(get_resizer(nodo, 1,1.2, nodos[i]["texto"]))
             .mouseleave(get_resizer(nodo, 1.2,1));
    }
    
    function get_resizer(nodo, scaleFrom, scaleTo, text){
      return function(){
        if(text){
          $("#descripcion").hide().text(text).fadeIn("fast");  
        }else{
          $("#descripcion").fadeOut();
        }
        
        var object = nodo
        /*este DIV se crea pero no se agrega al DOM, es solamente para tener algun
          lugar donde meter la propiedad a animar (scale)*/
        var tmpObj = $.extend($('<div>')[0], {
          scale: scaleFrom,
          customAnimate: true,
          updated: true
        });
        $(tmpObj).animate({"scale": scaleTo},{duration:500, 
          step:function (scale, fx) {
            var c = $(object).find("rect");
            var tx = parseFloat(c.attr("x")) + parseFloat(c.attr("width"))/2;
            tx = tx - tx*scale;
            var ty = parseFloat(c.attr("y")) + parseFloat(c.attr("height"))/2;
            ty = ty - ty*scale;
            /*el translate se hace porque el scale me mueve el centro del objeto*/
            var transform = "translate("+(tx).toString()+","+(ty).toString()+"), scale("+(scale).toString()+")";
            object.setAttribute("transform",transform);
          }
        });
      }
    }
  };
</script>