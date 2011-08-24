<?php
echo $javascript->link(array(
    'jquery.mousewheel.min',
    'mapbox.min',
    'jquery.blockUI'
));
echo $html->css('catalogo.estaticas');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.js-tabs-ofertas').tabs();
        $(".viewport").mapbox({mousewheel: true, layerSplit: 8});
        
        jQuery(".map-control a").click(function() {//control panel 
            var viewport = $(this).closest('.mapwrapper').find('.viewport'); 
            //this.className is same as method to be called 
            if(this.className == "zoom" || this.className == "back") { 
                viewport.mapbox(this.className, 2);//step twice 
            } 
            else { 
                viewport.mapbox(this.className); 
            } 
            return false; 
        }); 
         
    })
</script>

<div class="clear separador"></div>

<div class="grid_12">
    <div class="boxblanca boxdocs">
        <h1>Distribución geográfica Instituciones de ETP</h1>
        <div>
            <div class="js-tabs-ofertas tabs">
                <ul id="ofertas-tabs" class="horizontal-shadetabs">
                    <li>
                        <a id="htab-1" href="#ver-oferta-1">Nivel Superior</a>
                    </li>
                    <li>
                        <a id="htab-2" href="#ver-oferta-2">Nivel Secundario</a>
                    </li>
                    <li>
                        <a id="htab-3" href="#ver-oferta-3">Formación Profesional</a>
                    </li>
                </ul>

                <div id="ver-oferta-1" class="descargas-container" style="">
                    <div class="grid_6">
                        <h3> Mapa </h3>
                        <div class="mapwrapper">
                            <div class="viewport"> 
                                <div style="background: url(../img/home/mapaSup2011.jpg) no-repeat; width: 486px; height: 688px;"> 
                                    <!--top level map content goes here--> 
                                </div> 
                                <div style="height: 1719px; width: 1215px;"> 
                                    <? echo $html->image('home/mapaSup2011_1.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="height: 2456px; width: 1735px;"> 
                                    <? echo $html->image('home/mapaSup2011_2.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="height: 3508px; width: 2479px;"> 
                                    <? echo $html->image('home/mapaSup2011_3.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                            </div> 
                            <div class="map-control">
                                <a class="left" href="#left">Left</a>
                                <a class="right" href="#right">Right</a>
                                <a class="up" href="#up">Up</a>
                                <a class="down" href="#down">Down</a>
                                <a class="zoom" href="#zoom">Zoom</a>
                                <a class="back" href="#zoom_out">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="grid_4" style="margin-left:25px;">
                        <h3> Datos Generales </h3>
                        <ul>
                            <li>820 instituciones registradas en RFIETP</li>
                            <li>176.817 matriculados</li>
                            <li>57% de Gestión estatal</li>
                        </ul>
                        <br/>
                        <h3> Gráfico (Hac click sobre la imagen)</h3>
                        <div>
                            <? echo $html->image('home/graficoNivelSuperior.png', array('class' => 'grafico_barras docimg', 'style' => 'width:388px')); ?>
                        </div>
                        <br/>
                        <h3>Buscador</h3>
                        <div class="grid_4">
                            <div class="boxgris boxoferta">
                                <h4><?php echo $html->link('Nivel Superior Técnico', array('controller' => 'titulos', 'action' => 'search', SUP_TEC_ID)); ?></h4>

                                <?php
                                echo $html->link('más información', array('controller' => 'titulos', 'action' => 'search', SUP_TEC_ID), array('class' => 'mas_info_azul'));
                                ?>
                                <ul style="margin-left: 0px; padding-left: 17px;">
                                    <li>Requisitos de ingreso: Secundaria completa</li>
                                    <li>Duración: 3 o 4 años</li>
                                    <li>Título otorgado: Técnico Superior (en distintas especialidades).</li>
                                </ul>
                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>

                </div>
                <div id="ver-oferta-2" class="descargas-container" style="">
                    <div class="grid_6">
                        <h3> Mapa </h3>
                        <div class="mapwrapper">
                            <div class="viewport"> 
                                <div style="background: url(../img/home/mapaSec2011.jpg) no-repeat; width: 486px; height: 688px;"> 
                                    <!--top level map content goes here--> 
                                </div> 
                                <div style="height: 1719px; width: 1215px;"> 
                                    <? echo $html->image('home/mapaSec2011_1.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="height: 2456px; width: 1735px;"> 
                                    <? echo $html->image('home/mapaSec2011_2.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="height: 3508px; width: 2479px;"> 
                                    <? echo $html->image('home/mapaSec2011_3.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                            </div> 
                            <div class="map-control">
                                <a class="left" href="#left">Left</a>
                                <a class="right" href="#right">Right</a>
                                <a class="up" href="#up">Up</a>
                                <a class="down" href="#down">Down</a>
                                <a class="zoom" href="#zoom">Zoom</a>
                                <a class="back" href="#zoom_out">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="grid_4" style="margin-left:25px;">
                        <h3> Datos Generales </h3>
                        <ul>
                            <li>1.578 instituciones registradas en RFIETP</li>
                            <li>610.899 matriculados</li>
                            <li>87% de Gestión estatal</li>
                        </ul>
                        <br/>
                        <h3> Gráfico (Hac click sobre la imagen)</h3>
                        <div>
                            <? echo $html->image('home/graficoNivelSecundario.png', array('class' => 'ver_grafico_barras docimg', 'style' => 'width:388px')); ?>
                        </div>
                        <br/>
                        <h3>Buscador</h3>
                        <div class="grid_4">
                            <div class="boxgris boxoferta">
                                <h4><?php echo $html->link('Nivel Secundario Técnico', array('controller' => 'titulos', 'action' => 'search', SEC_TEC_ID)); ?></h4>

                                <?php
                                echo $html->link('más información', array('controller' => 'titulos', 'action' => 'search', SEC_TEC_ID), array('class' => 'mas_info_azul'));
                                ?>
                                <ul style="margin-left: 0px; padding-left: 17px;">
                                    <li>Requisitos de ingreso: Primaria completa</li>
                                    <li>Duración: 6 o 7 años</li>
                                    <li>Título otorgado: Técnico (en distintas especialidades).</li>
                                </ul>
                                <br />
                            </div>

                        </div>
                    </div>
                    <div class="clear"></div>

                </div>
                <div id="ver-oferta-3" class="descargas-container" style="">

                    <div class="grid_6">
                        <h3> Mapa </h3>
                        <div class="mapwrapper">
                            <div class="viewport"> 
                                <div style="background: url(../img/home/mapaCFP2011.jpg) no-repeat; width: 486px; height: 688px;"> 
                                    <!--top level map content goes here--> 
                                </div> 
                                <div style="height: 1719px; width: 1215px;"> 
                                    <? echo $html->image('home/mapaCFP2011_1.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="height: 2456px; width: 1735px;"> 
                                    <? echo $html->image('home/mapaCFP2011_2.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="height: 3508px; width: 2479px;"> 
                                    <? echo $html->image('home/mapaCFP2011_3.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                            </div> 
                            <div class="map-control">
                                <a class="left" href="#left">Left</a>
                                <a class="right" href="#right">Right</a>
                                <a class="up" href="#up">Up</a>
                                <a class="down" href="#down">Down</a>
                                <a class="zoom" href="#zoom">Zoom</a>
                                <a class="back" href="#zoom_out">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="grid_4" style="margin-left:25px;">
                        <h3> Datos Generales </h3>
                        <ul>
                            <li>1.082 instituciones registradas en RFIETP</li>
                            <li>235.656 matriculados</li>
                            <li>93% de Gestión estatal</li>
                        </ul>
                        <br/>
                        <h3> Gráfico (Hac click sobre la imagen)</h3>
                        <div>
                            <p style="color:red"> Falta Gráfico </p>
                            <? echo $html->image('home/graficoFP.png', array('class' => 'docimg', 'style' => 'width:388px')); ?>
                        </div>
                        <br/>
                        <h3>Buscador</h3>
                        <div class="grid_4">
                            <div class="boxgris boxoferta">
                                <h4><?php echo $html->link('Formación Profesional', array('controller' => 'titulos', 'action' => 'search', FP_ID)); ?></h4>
                                <?php
                                echo $html->link('más información', array('controller' => 'titulos', 'action' => 'search', FP_ID), array('class' => 'mas_info_azul'));
                                ?>

                                <ul style="margin-left: 0px; padding-left: 17px;">
                                    <li>Requisitos de ingreso y duración variables</li>
                                    <li>Certificaciones: <br />Certificados de Formación Profesional, Certificados de Formación Continua, Certificados de Capacitación Laboral.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>