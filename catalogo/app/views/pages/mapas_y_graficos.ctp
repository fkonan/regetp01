
<?php
echo $javascript->link(array(
    'jquery.mousewheel.min',
    'mapbox.min',
    'jquery.blockUI',
    'jquery.maphilight.min'
));
echo $html->css('catalogo.estaticas');
?>
<script type="text/javascript">
    function changeMap(element, id1, id2) {
        jQuery("#"+id1).toggle();
        jQuery("#"+id2).toggle();
        
        if (jQuery(element).html().toLowerCase() == 'navegar mapa') {
            jQuery(element).html('Volver a mapa clickeable');
        }
        else {
            jQuery(element).html('Navegar mapa');
        }
    }

    function viewJurisdiccion(oferta_id, jurisdiccion_id, titulo) {
        var dialog = jQuery('<div id="create_dialog"></div>')
        .html('... cargando información <span class="ajax-loader"></span>')
        .dialog({
            width: 350,
            //position: 'top',
            zIndex: 3999,
            title: titulo,
            draggable: false,
            modal: true,
            resizable: false,
            beforeclose: function(event, ui) {
                jQuery(".ui-dialog").remove();
                jQuery("#create_dialog").remove();
            }
        });

        jQuery.ajax({
            url: '<?php echo $html->url('/instits/getDatosJurisdiccionParaMapa')?>/'+oferta_id+'/'+jurisdiccion_id,
            cache: false,
            success: function(data) {
                dialog.html(data);
            }
        });

        return false;
    }
    
    function viewGrafico(srcGrafico, titulo, width) {
        var dialog = jQuery('<div id="create_dialog"></div>')
        .html('<img src="'+srcGrafico+'" />')
        .dialog({
            width: width,
            //position: 'top',
            zIndex: 3999,
            title: titulo,
            draggable: false,
            modal: true,
            resizable: false,
            beforeclose: function(event, ui) {
                jQuery(".ui-dialog").remove();
                jQuery("#create_dialog").remove();
            }
        });

        return false;
    }
    
    jQuery(document).ready(function(){
        jQuery('.js-tabs-ofertas').tabs({
            fx: { 
            opacity: 'toggle' 
            }
        });
        
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
        
        jQuery('.mapa').maphilight({
            fade: false,
            fillColor: '045FB4',
            fillOpacity: 0.2,
            stroke: false
        });

        //jQuery("#LinkNavegarMapaSup").click(changeMap('mapaSupNavegador', 'mapaSup'));
         
    })
</script>
<div class="grid_12">
    <h1>La Educación Técnico Profesional en cifras</h1>

    <div class="boxblanca">       
        <div>
            <div class="js-tabs-ofertas tabs" style="height:824px;">
                <ul id="ofertas-tabs" class="horizontal-shadetabs">
                    <li>
                        <a id="htab-2" href="#ver-oferta-sec">Nivel Secundario</a>
                    </li>
                    <li>
                        <a id="htab-1" href="#ver-oferta-sup">Nivel Superior</a>
                    </li>
                    <li>
                        <a id="htab-3" href="#ver-oferta-fp">Formación Profesional</a>
                    </li>
                </ul>

                <div id="ver-oferta-sup" class="descargas-container" style="">
                    <div style="width: 57%; float: left;">
                        <h3>Institutos Técnicos de Educación Superior</h3>
                        <a onclick="changeMap(this, 'mapaSupNavegador', 'mapaSup')" href="#">Navegar mapa</a>
                        <div id="mapaSup">
                            <? echo $html->image('home/mapaSup2011.jpg', array('usemap' => '#mapSup', 'class'=>'mapa')); ?> 
                            <map id="mapSup" name="mapSup">
                                <area shape="poly" coords="120,59,134,71,135,57,141,53,143,63,155,77,177,72,176,55,164,53,154,39,158,26,147,26,139,20,127,29,118,39" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','38','Jujuy')" alt="Jujuy" title="Jujuy"   />
                                <area shape="poly" coords="156,27,157,35,167,53,178,52,178,71,172,74,163,75,152,70,144,65,143,56,137,57,136,67,121,60,96,73,97,86,130,89,129,101,135,112,148,108,172,110,173,98,187,98,209,73,209,34,202,27,185,25,175,39,168,29" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','66','Salta')" alt="Salta" title="Salta"   />
                                <area shape="poly" coords="212,69,213,36,232,59,254,68,299,96,280,128,253,100,245,90,232,80" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','34','Formosa')" alt="Formosa" title="Formosa"   />
                                <area shape="poly" coords="213,70,190,98,221,98,221,147,269,149,278,127,256,106,246,92" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','22','Chaco')" alt="Chaco" title="Chaco"   />
                                <area shape="poly" coords="220,98,220,145,212,194,204,192,197,183,184,177,165,174,158,143,161,134,167,126,174,101" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','86','Santiago del Estero')" alt="Santiago del Estero" title="Santiago del Estero"   />
                                <area shape="poly" coords="169,110,160,112,155,107,147,108,142,114,146,122,141,132,154,147,162,134" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','90','Tucumán')" alt="Tucumán" title="Tucumán"   />
                                <area shape="poly" coords="99,89,132,90,127,103,135,114,138,110,146,116,139,133,153,149,163,173,154,188,145,170,137,161,133,152,113,151,88,139,92,129,102,126,96,116,99,107,94,96,97,88" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','10','Catamarca')" alt="Catamarca" title="Catamarca"   />
                                <area shape="poly" coords="324,139,329,159,367,137,369,121,365,107,362,105,353,109,349,124" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','54','Misiones')" alt="Misiones" title="Misiones"   />
                                <area shape="poly" coords="276,133,307,141,318,140,327,157,286,200,275,195,269,192,253,197,255,184,264,161,265,151,272,145" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','18','Corrientes')" alt="Corrientes" title="Corrientes"   />
                                <area shape="poly" coords="220,147,270,149,267,154,259,173,254,185,254,197,244,217,235,226,232,239,233,257,215,275,193,273,214,247,208,224,210,214,215,203,211,197" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','82','Santa Fe')" alt="Santa Fe" title="Santa Fe"   />
                                <area shape="poly" coords="255,198,267,194,278,192,284,206,283,221,277,231,279,250,272,254,270,272,242,255,232,242,233,233,241,222" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','30','Entre Ríos')" alt="Entre Ríos" title="Entre Ríos"   />
                                <area shape="poly" coords="210,194,203,191,198,184,183,178,177,177,160,177,161,184,153,188,152,198,147,205,147,222,157,226,162,235,160,250,159,287,186,288,188,275,195,274,210,250,208,225,209,214,214,205" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','14','Córdoba')" alt="Córdoba" title="Córdoba"   />
                                <area shape="poly" coords="152,187,146,204,146,224,134,225,123,212,123,199,115,197,115,192,102,179,89,178,90,164,88,160,83,155,77,155,87,142,98,141,108,148,119,149,133,150,135,159,144,168" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','46','La Rioja')" alt="La Rioja" title="La Rioja"   />
                                <area shape="poly" coords="71,236,61,219,61,207,69,193,72,174,76,156,87,159,89,178,99,181,113,192,122,204,123,215,129,224,118,222,116,228,103,228,94,234,90,226,82,229" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','70','San Juan')" alt="San Juan" title="San Juan"   />
                                <area shape="poly" coords="157,307,156,252,162,235,156,235,154,227,148,225,132,226,117,224,121,234,124,245,124,256,133,266,131,275,134,286,132,308" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','74','San Luis')" alt="San Luis" title="San Luis"   />
                                <area shape="poly" coords="189,277,184,400,193,411,200,404,197,394,205,381,203,369,220,371,261,363,280,355,295,328,297,323,289,320,285,313,286,309,293,302,285,295,277,281,268,275,238,256,236,261,230,262,216,275" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','6','Buenos Aires')" alt="Buenos Aires" title="Buenos Aires"   />
                                <area shape="poly" coords="406,199,391,204,374,237,374,255,398,284,419,265,432,266,454,251,454,242,445,226,439,219,433,219,421,208" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','2','CABA')" alt="CABA" title="CABA"   />
                                <area shape="poly" coords="186,289,158,289,158,309,106,309,106,338,114,341,114,351,123,353,135,359,160,365,170,366,184,378" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','42','La Pampa')" alt="La Pampa" title="La Pampa"   />
                                <area shape="poly" coords="71,238,81,233,88,227,95,237,101,230,117,231,119,244,127,261,128,272,133,288,129,308,106,307,105,338,90,330,81,329,67,312,72,307,68,296,70,281,78,272,78,251,73,254" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','50','Mendoza')" alt="Mendoza" title="Mendoza"   />
                                <area shape="poly" coords="70,316,79,329,92,333,106,339,105,365,92,379,78,388,78,399,60,407,52,413,52,397,50,392,59,378,56,370,61,369,64,363,58,342,60,331,59,319,70,308" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','58','Neuquén')" alt="Neuquén" title="Neuquén"   />
                                <area shape="poly" coords="184,377,182,403,194,412,181,414,173,413,164,405,153,404,154,413,159,419,156,428,57,432,52,414,64,411,64,402,78,398,82,389,106,366,105,340,115,343,114,350,133,362,154,365,166,366" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','62','Río Negro')" alt="Río Negro" title="Río Negro"   />
                                <area shape="poly" coords="59,433,157,430,167,434,176,429,181,438,177,448,170,446,156,454,154,464,154,479,147,484,150,492,137,491,128,496,121,509,64,514,57,508,64,499,61,493,54,489,66,487,68,480,59,480,57,471,52,462,58,453,47,446,53,444,48,434,56,436" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','26')" alt="Chubut" title="Chubut"   />
                                <area shape="poly" coords="63,515,121,512,120,520,129,526,143,533,146,551,133,557,121,573,119,589,104,601,105,618,113,642,91,635,66,636,60,622,62,611,58,607,51,611,44,602,42,580,51,578,50,571,57,562,51,551,59,537,57,531,62,528,60,517" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','78','Santa Cruz')" alt="Santa Cruz" title="Santa Cruz"   />
                                <area shape="poly" coords="110,648,110,691,129,691,139,695,153,685,140,683,133,677,125,672,118,661" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','94','Tierra del Fuego')" alt="Tierra del Fuego" title="Tierra del Fuego"   />
                            </map>
                        </div> 
                        <div id="mapaSupNavegador" class="mapwrapper" style="display: none;">
                            <div class="viewport"> 
                                <div> 
                                    <!--top level map content goes here--> 
                                    <? echo $html->image('home/mapaSup2011.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                </div> 
                                <div style="width: 1152px; height: 1683px;"> 
                                    <? echo $html->image('home/mapaSup2011_1.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="width: 1644px; height: 2400px;"> 
                                    <? echo $html->image('home/mapaSup2011_2.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="width: 2348px; height: 3438px;"> 
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
                    <div style="margin-left:25px; width: 35%; float: left;">
                        <h3> Datos generales </h3>
                        <ul>
                            <li>820 instituciones registradas en RFIETP</li>
                            <li>176.817 matriculados</li>
                            <li>57% de Gestión estatal</li>
                        </ul>
                        <br/>
                        <h3>Gráfico de instituciones por sector</h3>
                        <div>
                            <? echo $html->image('home/graficoNivelSuperior.png', array('class' => 'grafico_barras docimg', 'onclick' => 'viewGrafico(this.src, "Nivel Superior", 670)', 'style' => 'width:307px; cursor:pointer;')); ?>
                        </div>
                        <br/>
                        <h3>Buscador</h3>
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
                    <div class="clear"></div>

                </div>
                <div id="ver-oferta-sec" class="descargas-container" style="">
                    <div style="width: 57%; float: left;">
                        <h3>Escuelas Secundarias de Formación Técnica Profesional</h3>
                        <a onclick="changeMap(this, 'mapaSecNavegador', 'mapaSec')" href="#">Navegar mapa</a>
                        <div id="mapaSec">
                            <? echo $html->image('home/mapaSec2011.jpg', array('usemap' => '#mapSec', 'class'=>'mapa')); ?> 
                            <map id="mapSec" name="mapSec">
                                <area shape="poly" coords="120,59,134,71,135,57,141,53,143,63,155,77,177,72,176,55,164,53,154,39,158,26,147,26,139,20,127,29,118,39" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','38','Jujuy')" alt="Jujuy" title="Jujuy"   />
                                <area shape="poly" coords="156,27,157,35,167,53,178,52,178,71,172,74,163,75,152,70,144,65,143,56,137,57,136,67,121,60,96,73,97,86,130,89,129,101,135,112,148,108,172,110,173,98,187,98,209,73,209,34,202,27,185,25,175,39,168,29" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','66','Salta')" alt="Salta" title="Salta"   />
                                <area shape="poly" coords="212,69,213,36,232,59,254,68,299,96,280,128,253,100,245,90,232,80" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','34','Formosa')" alt="Formosa" title="Formosa"   />
                                <area shape="poly" coords="213,70,190,98,221,98,221,147,269,149,278,127,256,106,246,92" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','22','Chaco')" alt="Chaco" title="Chaco"   />
                                <area shape="poly" coords="220,98,220,145,212,194,204,192,197,183,184,177,165,174,158,143,161,134,167,126,174,101" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','86','Santiago del Estero')" alt="Santiago del Estero" title="Santiago del Estero"   />
                                <area shape="poly" coords="169,110,160,112,155,107,147,108,142,114,146,122,141,132,154,147,162,134" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','90','Tucumán')" alt="Tucumán" title="Tucumán"   />
                                <area shape="poly" coords="99,89,132,90,127,103,135,114,138,110,146,116,139,133,153,149,163,173,154,188,145,170,137,161,133,152,113,151,88,139,92,129,102,126,96,116,99,107,94,96,97,88" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','10','Catamarca')" alt="Catamarca" title="Catamarca"   />
                                <area shape="poly" coords="324,139,329,159,367,137,369,121,365,107,362,105,353,109,349,124" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','54','Misiones')" alt="Misiones" title="Misiones"   />
                                <area shape="poly" coords="276,133,307,141,318,140,327,157,286,200,275,195,269,192,253,197,255,184,264,161,265,151,272,145" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','18','Corrientes')" alt="Corrientes" title="Corrientes"   />
                                <area shape="poly" coords="220,147,270,149,267,154,259,173,254,185,254,197,244,217,235,226,232,239,233,257,215,275,193,273,214,247,208,224,210,214,215,203,211,197" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','82','Santa Fe')" alt="Santa Fe" title="Santa Fe"   />
                                <area shape="poly" coords="255,198,267,194,278,192,284,206,283,221,277,231,279,250,272,254,270,272,242,255,232,242,233,233,241,222" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','30','Entre Ríos')" alt="Entre Ríos" title="Entre Ríos"   />
                                <area shape="poly" coords="210,194,203,191,198,184,183,178,177,177,160,177,161,184,153,188,152,198,147,205,147,222,157,226,162,235,160,250,159,287,186,288,188,275,195,274,210,250,208,225,209,214,214,205" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','14','Córdoba')" alt="Córdoba" title="Córdoba"   />
                                <area shape="poly" coords="152,187,146,204,146,224,134,225,123,212,123,199,115,197,115,192,102,179,89,178,90,164,88,160,83,155,77,155,87,142,98,141,108,148,119,149,133,150,135,159,144,168" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','46','La Rioja')" alt="La Rioja" title="La Rioja"   />
                                <area shape="poly" coords="71,236,61,219,61,207,69,193,72,174,76,156,87,159,89,178,99,181,113,192,122,204,123,215,129,224,118,222,116,228,103,228,94,234,90,226,82,229" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','70','San Juan')" alt="San Juan" title="San Juan"   />
                                <area shape="poly" coords="157,307,156,252,162,235,156,235,154,227,148,225,132,226,117,224,121,234,124,245,124,256,133,266,131,275,134,286,132,308" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','74','San Luis')" alt="San Luis" title="San Luis"   />
                                <area shape="poly" coords="189,277,184,400,193,411,200,404,197,394,205,381,203,369,220,371,261,363,280,355,295,328,297,323,289,320,285,313,286,309,293,302,285,295,277,281,268,275,238,256,236,261,230,262,216,275" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','6','Buenos Aires')" alt="Buenos Aires" title="Buenos Aires"   />
                                <area shape="poly" coords="406,199,391,204,374,237,374,255,398,284,419,265,432,266,454,251,454,242,445,226,439,219,433,219,421,208" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','2','CABA')" alt="CABA" title="CABA"   />
                                <area shape="poly" coords="186,289,158,289,158,309,106,309,106,338,114,341,114,351,123,353,135,359,160,365,170,366,184,378" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','42','La Pampa')" alt="La Pampa" title="La Pampa"   />
                                <area shape="poly" coords="71,238,81,233,88,227,95,237,101,230,117,231,119,244,127,261,128,272,133,288,129,308,106,307,105,338,90,330,81,329,67,312,72,307,68,296,70,281,78,272,78,251,73,254" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','50','Mendoza')" alt="Mendoza" title="Mendoza"   />
                                <area shape="poly" coords="70,316,79,329,92,333,106,339,105,365,92,379,78,388,78,399,60,407,52,413,52,397,50,392,59,378,56,370,61,369,64,363,58,342,60,331,59,319,70,308" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','58','Neuquén')" alt="Neuquén" title="Neuquén"   />
                                <area shape="poly" coords="184,377,182,403,194,412,181,414,173,413,164,405,153,404,154,413,159,419,156,428,57,432,52,414,64,411,64,402,78,398,82,389,106,366,105,340,115,343,114,350,133,362,154,365,166,366" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','62','Río Negro')" alt="Río Negro" title="Río Negro"   />
                                <area shape="poly" coords="59,433,157,430,167,434,176,429,181,438,177,448,170,446,156,454,154,464,154,479,147,484,150,492,137,491,128,496,121,509,64,514,57,508,64,499,61,493,54,489,66,487,68,480,59,480,57,471,52,462,58,453,47,446,53,444,48,434,56,436" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','26','Chubut')" alt="Chubut" title="Chubut"   />
                                <area shape="poly" coords="63,515,121,512,120,520,129,526,143,533,146,551,133,557,121,573,119,589,104,601,105,618,113,642,91,635,66,636,60,622,62,611,58,607,51,611,44,602,42,580,51,578,50,571,57,562,51,551,59,537,57,531,62,528,60,517" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','78','Santa Cruz')" alt="Santa Cruz" title="Santa Cruz"   />
                                <area shape="poly" coords="110,648,110,691,129,691,139,695,153,685,140,683,133,677,125,672,118,661" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','94','Tierra del Fuego')" alt="Tierra del Fuego" title="Tierra del Fuego"   />
                            </map>
                        </div> 
                        <div id="mapaSecNavegador" class="mapwrapper" style="display: none;">
                            <div class="viewport"> 
                                <div> 
                                    <!--top level map content goes here--> 
                                    <? echo $html->image('home/mapaSec2011.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                </div> 
                                <div style="width: 1155px; height: 1662px;"> 
                                    <? echo $html->image('home/mapaSec2011_1.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="width: 1640px; height: 2368px;"> 
                                    <? echo $html->image('home/mapaSec2011_2.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="width: 2354px; height: 3388px;"> 
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
                    <div style="margin-left:25px; width: 35%; float: left;">
                        <h3> Datos generales </h3>
                        <ul>
                            <li>1.578 instituciones registradas en RFIETP</li>
                            <li>610.899 matriculados</li>
                            <li>87% de Gestión estatal</li>
                        </ul>
                        <br/>
                        <h3>Gráfico de instituciones por sector</h3>
                        <div>
                            <? echo $html->image('home/graficoNivelSecundario.png', array('class' => 'ver_grafico_barras docimg', 'onclick' => 'viewGrafico(this.src, "Nivel Secundario", 670)', 'style' => 'width:307px; cursor:pointer;')); ?>
                        </div>
                        <br/>
                        <h3>Buscador</h3>
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
                    <div class="clear"></div>

                </div>
                <div id="ver-oferta-fp" class="descargas-container" style="">

                    <div style="width: 57%; float: left;">
                        <h3>Centros de Formación Técnica Profesional</h3>
                        <a onclick="changeMap(this, 'mapaCFPNavegador', 'mapaCFP')" href="#">Navegar mapa</a>
                        <div id="mapaCFP">
                            <? echo $html->image('home/mapaCFP2011.jpg', array('usemap' => '#mapCFP', 'class'=>'mapa')); ?> 
                            <map id="mapCFP" name="mapCFP">
                                <area shape="poly" coords="120,59,134,71,135,57,141,53,143,63,155,77,177,72,176,55,164,53,154,39,158,26,147,26,139,20,127,29,118,39" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','38','Jujuy')" alt="Jujuy" title="Jujuy"   />
                                <area shape="poly" coords="156,27,157,35,167,53,178,52,178,71,172,74,163,75,152,70,144,65,143,56,137,57,136,67,121,60,96,73,97,86,130,89,129,101,135,112,148,108,172,110,173,98,187,98,209,73,209,34,202,27,185,25,175,39,168,29" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','66','Salta')" alt="Salta" title="Salta"   />
                                <area shape="poly" coords="212,69,213,36,232,59,254,68,299,96,280,128,253,100,245,90,232,80" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','34','Formosa')" alt="Formosa" title="Formosa"   />
                                <area shape="poly" coords="213,70,190,98,221,98,221,147,269,149,278,127,256,106,246,92" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','22','Chaco')" alt="Chaco" title="Chaco"   />
                                <area shape="poly" coords="220,98,220,145,212,194,204,192,197,183,184,177,165,174,158,143,161,134,167,126,174,101" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','86','Santiago del Estero')" alt="Santiago del Estero" title="Santiago del Estero"   />
                                <area shape="poly" coords="169,110,160,112,155,107,147,108,142,114,146,122,141,132,154,147,162,134" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','90','Tucumán')" alt="Tucumán" title="Tucumán"   />
                                <area shape="poly" coords="99,89,132,90,127,103,135,114,138,110,146,116,139,133,153,149,163,173,154,188,145,170,137,161,133,152,113,151,88,139,92,129,102,126,96,116,99,107,94,96,97,88" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','10','Catamarca')" alt="Catamarca" title="Catamarca"   />
                                <area shape="poly" coords="324,139,329,159,367,137,369,121,365,107,362,105,353,109,349,124" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','54','Misiones')" alt="Misiones" title="Misiones"   />
                                <area shape="poly" coords="276,133,307,141,318,140,327,157,286,200,275,195,269,192,253,197,255,184,264,161,265,151,272,145" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','18','Corrientes')" alt="Corrientes" title="Corrientes"   />
                                <area shape="poly" coords="220,147,270,149,267,154,259,173,254,185,254,197,244,217,235,226,232,239,233,257,215,275,193,273,214,247,208,224,210,214,215,203,211,197" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','82','Santa Fe')" alt="Santa Fe" title="Santa Fe"   />
                                <area shape="poly" coords="255,198,267,194,278,192,284,206,283,221,277,231,279,250,272,254,270,272,242,255,232,242,233,233,241,222" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','30','Entre Ríos')" alt="Entre Ríos" title="Entre Ríos"   />
                                <area shape="poly" coords="210,194,203,191,198,184,183,178,177,177,160,177,161,184,153,188,152,198,147,205,147,222,157,226,162,235,160,250,159,287,186,288,188,275,195,274,210,250,208,225,209,214,214,205" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','14','Córdoba')" alt="Córdoba" title="Córdoba"   />
                                <area shape="poly" coords="152,187,146,204,146,224,134,225,123,212,123,199,115,197,115,192,102,179,89,178,90,164,88,160,83,155,77,155,87,142,98,141,108,148,119,149,133,150,135,159,144,168" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','46','La Rioja')" alt="La Rioja" title="La Rioja"   />
                                <area shape="poly" coords="71,236,61,219,61,207,69,193,72,174,76,156,87,159,89,178,99,181,113,192,122,204,123,215,129,224,118,222,116,228,103,228,94,234,90,226,82,229" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','70','San Juan')" alt="San Juan" title="San Juan"   />
                                <area shape="poly" coords="157,307,156,252,162,235,156,235,154,227,148,225,132,226,117,224,121,234,124,245,124,256,133,266,131,275,134,286,132,308" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','74','San Luis')" alt="San Luis" title="San Luis"   />
                                <area shape="poly" coords="189,277,184,400,193,411,200,404,197,394,205,381,203,369,220,371,261,363,280,355,295,328,297,323,289,320,285,313,286,309,293,302,285,295,277,281,268,275,238,256,236,261,230,262,216,275" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','6','Buenos Aires')" alt="Buenos Aires" title="Buenos Aires"   />
                                <area shape="poly" coords="406,199,391,204,374,237,374,255,398,284,419,265,432,266,454,251,454,242,445,226,439,219,433,219,421,208" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','2','CABA')" alt="CABA" title="CABA"   />
                                <area shape="poly" coords="186,289,158,289,158,309,106,309,106,338,114,341,114,351,123,353,135,359,160,365,170,366,184,378" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','42','La Pampa')" alt="La Pampa" title="La Pampa"   />
                                <area shape="poly" coords="71,238,81,233,88,227,95,237,101,230,117,231,119,244,127,261,128,272,133,288,129,308,106,307,105,338,90,330,81,329,67,312,72,307,68,296,70,281,78,272,78,251,73,254" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','50','Mendoza')" alt="Mendoza" title="Mendoza"   />
                                <area shape="poly" coords="70,316,79,329,92,333,106,339,105,365,92,379,78,388,78,399,60,407,52,413,52,397,50,392,59,378,56,370,61,369,64,363,58,342,60,331,59,319,70,308" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','58','Neuquén')" alt="Neuquén" title="Neuquén"   />
                                <area shape="poly" coords="184,377,182,403,194,412,181,414,173,413,164,405,153,404,154,413,159,419,156,428,57,432,52,414,64,411,64,402,78,398,82,389,106,366,105,340,115,343,114,350,133,362,154,365,166,366" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','62','Río Negro')" alt="Río Negro" title="Río Negro"   />
                                <area shape="poly" coords="59,433,157,430,167,434,176,429,181,438,177,448,170,446,156,454,154,464,154,479,147,484,150,492,137,491,128,496,121,509,64,514,57,508,64,499,61,493,54,489,66,487,68,480,59,480,57,471,52,462,58,453,47,446,53,444,48,434,56,436" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','26')" alt="Chubut" title="Chubut"   />
                                <area shape="poly" coords="63,515,121,512,120,520,129,526,143,533,146,551,133,557,121,573,119,589,104,601,105,618,113,642,91,635,66,636,60,622,62,611,58,607,51,611,44,602,42,580,51,578,50,571,57,562,51,551,59,537,57,531,62,528,60,517" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','78','Santa Cruz')" alt="Santa Cruz" title="Santa Cruz"   />
                                <area shape="poly" coords="110,648,110,691,129,691,139,695,153,685,140,683,133,677,125,672,118,661" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','94','Tierra del Fuego')" alt="Tierra del Fuego" title="Tierra del Fuego"   />
                            </map>
                        </div> 
                        <div id="mapaCFPNavegador" class="mapwrapper" style="display: none;">
                            <div class="viewport"> 
                                <div> 
                                    <!--top level map content goes here--> 
                                    <? echo $html->image('home/mapaCFP2011.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                </div> 
                                <div style="width: 1152px; height: 1680px;"> 
                                    <? echo $html->image('home/mapaCFP2011_1.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="width: 1644px; height: 2400px;"> 
                                    <? echo $html->image('home/mapaCFP2011_2.jpg', array('class' => 'docimg', 'style' => '')); ?> 
                                    <div class="mapcontent"> 
                                        <!--map content goes here--> 
                                    </div> 
                                </div> 
                                <div style="width: 2326px; height: 3420px;"> 
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
                    <div style="margin-left:25px; width: 35%; float: left;">
                        <h3> Datos generales </h3>
                        <ul>
                            <li>1.082 instituciones registradas en RFIETP</li>
                            <li>235.656 matriculados</li>
                            <li>93% de Gestión estatal</li>
                        </ul>
                        <br/>
                        <h3>Gráfico de instituciones por sector</h3>
                        <div>
                            <p style="color:red"> Falta Gráfico </p>
                            <? echo $html->image('home/graficoFP.png', array('class' => 'docimg', 'style' => 'width:307px')); ?>
                        </div>
                        <br/>
                        <h3>Buscador</h3>
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
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>