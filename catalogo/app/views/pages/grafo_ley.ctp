<div class="clear separador"></div>
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
    <div class="boxblanca boxdocs">
        <h1>Las políticas para la Educación Técnico Profesional en Argentina</h1>
        <h3>Ley de Educación Técnico Profesional</h3>
        <div>
        <!--[if !IE]>-->
          <object data="../img/grafo.svg" type="image/svg+xml"
                  id="mySVGObject"> <!--<![endif]-->
        <!--[if lt IE 9]>
          <object src="../img/grafo.svg" classid="image/svg+xml"
                   id="mySVGObject"> <![endif]-->
        <!--[if gte IE 9]>
          <object data="../img/grafo.svg" type="image/svg+xml"
                   id="mySVGObject"> <![endif]-->
          </object>
        </div>
        <div id="descripcion"></div>
    </div>
</div>

<script type="text/javascript">
  window.onsvgload = function(){
  	/*texto temporal*/
  	var lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat lacus, facilisis sed scelerisque dictum, accumsan eu nunc. Maecenas sed ligula sed quam luctus consectetur. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.";
    /*ids de cada grupo del svg con su texto corresponidente*/
    var nodos = [
      {id:"g_bases", texto:lorem},
      {id:"g_homologacion", texto:lorem},
      {id:"g_registro", texto:lorem},
      {id:"g_catalogo", texto:lorem},
      {id:"g_fortalecimiento", texto:lorem},
      {id:"g_plan_de_mejoras", texto:lorem},
      {id:"g_evaluacion", texto:lorem},
      {id:"g_estudios", texto:lorem},
      {id:"g_fondo", texto:lorem}
    ];

    animar_cuadros('mySVGObject', nodos, 'descripcion');
  };
</script>