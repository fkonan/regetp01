
<?php
echo $javascript->link(array(
    'jquery.mousewheel.min',
    'mapbox.min',
    'jquery.blockUI',
    'jquery.maphilight.min', 
    'https://www.google.com/jsapi'
));
echo $html->css('catalogo.estaticas');
?>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
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
    
    function crear_cuadro(id, raw_data){
    	var data = new google.visualization.DataTable();
	    data.addColumn('string', 'Sector');
        data.addColumn('number', 'Cantidad');
	    data.addRows(raw_data);
	    data.sort({column: 1, desc: true});

		$("#"+id).click(function(){popupCuadro(raw_data)});	    
	    var chart = new google.visualization.BarChart(document.getElementById(id));
		chart.draw(data, {width: 307, 
						  height: 600, 
						  title: 'Alumnos matriculados por sector socioproductivo (***)',
						  legend:'none', 
						  chartArea: {left:100,top:60,width:"90%",height:"85%"}, 
						  colors:["#0082CA"],
						  });

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
        
		data_sup = [["Administración", 46101 ],
					["Salud", 32913 ],
					["Informática", 22716 ],
					["Seguridad, Ambiente e Higiene", 1115 ],
					["Agropecuario", 11133 ],
					["Industria Gráfica y Multimedial", 11049 ],
					["Turismo", 10884 ],
					["Gastronomía y Hotelería", 9000 ],
					["Actividades Artísticas Técnicas", 4432 ],
					["Electrónica", 4163 ],
					["Industria de la Alimentación", 3227 ],
					["Textil e Indumentaria", 2259 ],
					["Electromecánica", 1785 ],
					["Industria de Procesos", 1714 ],
					["Construcción", 1298 ],
					["Minería e Hidrocarburos", 1089 ],
					["Automotriz", 880 ],
					["Energía", 386 ],
					["Energia Eléctrica", 253 ],
					["Madera y Mueble", 204 ],
					["Mecánica Metalmecánica y Metalurgia", 167 ],
					["Naval", 121 ],
					["Estética Profesional", 51]];
		
		data_sec = [["Electromecánica", 72378 ],
					["Agropecuario", 40897 ],
					["Construcción", 32458 ],
					["Informática", 27001 ],
					["Administración", 26253 ],
					["Electrónica", 22105 ],
					["Industria de Procesos", 20623 ],
					["Automotriz", 8043 ],
					["Mecánica, Metalmecánica y Metalurgia", 665 ],
					["Industria de la Alimentación", 6153 ],
					["Energia Eléctrica", 4781 ],
					["Industria Gráfica y Multimedial", 4313 ],
					["Aeronáutica", 3058 ],
					["Turismo", 2951 ],
					["Seguridad, Ambiente e Higiene", 2273 ],
					["Minería e Hidrocarburos", 203 ],
					["Actividades Artísticas Técnicas", 992 ],
					["Salud", 689 ],
					["Naval", 550 ],
					["Textil e Indumentaria", 327 ],
					["Madera y Mueble", 314 ],
					["Gastronomía y Hotelería", 227 ],
					["Energía", 206 ]];
					
		data_fp = [["Informática", 94269 ],
					["Textil e Indumentaria", 57633 ],
					["Gastronomía y Hotelería", 55001 ],
					["Construcción", 47042 ],
					["Administración", 31460 ],
					["Energia Eléctrica", 29748 ],
					["Estética Profesional", 28966 ],
					["Automotriz", 22440 ],
					["Agropecuario", 22215 ],
					["Mecánica, Metalmecánica y Metalurgia", 2821 ],
					["Madera y Mueble", 19032 ],
					["Industria Gráfica y Multimedial", 18521 ],
					["Actividades Artísticas Técnicas", 15639 ],
					["Electrónica", 13288 ],
					["Industria de la Alimentación", 11933 ],
					["Idioma", 10057 ],
					["Electromecánica", 6224 ],
					["Seguridad, Ambiente e Higiene", 113 ],
					["Cuero y Calzado", 3855 ],
					["Turismo", 3707 ],
					["Salud", 3243 ],
					["Industria de Procesos", 2755 ],
					["Aeronáutica", 141 ],
					["Minería e Hidrocarburos", 91 ],
					["Energía", 76 ]];
					
		crear_cuadro('grafico_sup', data_sup);
		crear_cuadro('grafico_sec', data_sec);
		crear_cuadro('grafico_fp', data_fp);
    })
</script>
<div class="grid_12">
    <h1>La Educación Técnico Profesional en cifras</h1>

    <div class="boxblanca">    
        <p>
            A continuación se presenta información estadística de la Educación Técnico
Profesional. Las fuentes de información son: 1) el Relevamiento Anual llevado
a cabo por la Dirección Nacional de Información y Evaluación de la Calidad
Educativa (DINIECE) del Ministerio de Educación de la Nación, y 2) la información
presentada por las instituciones educativas a la base de datos del Registro Federal de
Instituciones de Educación Técnica Profesional (RFIETP).
        </p>
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
                                <area shape="poly" coords="406,199,391,204,374,237,374,255,398,284,419,265,432,266,454,251,454,242,445,226,439,219,433,219,421,208" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SUP_TEC_ID?>','2','Ciudad Autónoma de Buenos Aires')" alt="Ciudad Autónoma de Buenos Aires" title="Ciudad Autónoma de Buenos Aires"   />
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
                            <li>820 instituciones ingresadas al RFIETP (*)</li>
                            <li>57% de las instituciones son de gestión estatal (*)</li>
                            <li>176.817 alumnos matriculados (**)</li>
                        </ul>
                        <br/>
                        <div>
                            <? //echo $html->image('home/graficoNivelSuperior.png', array('class' => 'grafico_barras docimg', 'onclick' => 'viewGrafico(this.src, "Nivel Superior", 670)', 'style' => 'width:307px; cursor:pointer;')); ?>
                            <div id="grafico_sup" ></div>
                        </div>
                        <br/>
                    </div>
                    <div class="clear"></div>

                </div>
                <div id="ver-oferta-sec" class="descargas-container" style="">
                    <div style="width: 57%; float: left;">
                        <h3>Escuelas Secundarias de Educación Técnica Profesional</h3>
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
                                <area shape="poly" coords="406,199,391,204,374,237,374,255,398,284,419,265,432,266,454,251,454,242,445,226,439,219,433,219,421,208" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo SEC_TEC_ID?>','2','Ciudad Autónoma de Buenos Aires')" alt="Ciudad Autónoma de Buenos Aires" title="Ciudad Autónoma de Buenos Aires"   />
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
                            <li>1.578 instituciones ingresadas al RFIETP (*)</li>
                            <li>87% de las instituciones son de gestión estatal (*)</li>
                            <li>610.899 alumnos matriculados (**)</li>
                        </ul>
                        <br/>
                        <div>
                            <? //echo $html->image('home/graficoNivelSecundario.png', array('class' => 'ver_grafico_barras docimg', 'onclick' => 'viewGrafico(this.src, "Nivel Secundario", 670)', 'style' => 'width:307px; cursor:pointer;')); ?>
                            <div id="grafico_sec"></div>
                        </div>
                        <br/>
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
                                <area shape="poly" coords="120,60,123,47,120,40,123,33,130,28,137,27,138,20,146,24,158,27,153,36,159,47,165,57,175,56,176,68,168,76,154,75,152,75,148,66,145,64,144,55,138,54,135,62,134,70" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','38','Jujuy')" alt="Jujuy" title="Jujuy"   />
                                <area shape="poly" coords="159,27,155,36,165,54,176,54,178,70,168,76,150,75,147,67,144,67,142,57,137,57,135,69,121,61,101,73,93,82,100,90,114,91,134,91,130,101,122,100,122,106,132,109,136,115,139,106,145,113,147,108,168,110,173,101,182,98,189,97,211,75,211,35,203,27,203,25,183,26,174,39,170,29" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','66','Salta')" alt="Salta" title="Salta"   />
                                <area shape="poly" coords="213,37,211,67,229,78,247,92,261,111,280,125,300,98,286,87,258,70,254,67,237,61,233,53" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','34','Formosa')" alt="Formosa" title="Formosa"   />
                                <area shape="poly" coords="211,69,190,99,222,99,222,132,220,147,272,150,275,137,280,129,281,128,268,112,259,110,258,107,250,94,232,81" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','22','Chaco')" alt="Chaco" title="Chaco"   />
                                <area shape="poly" coords="222,99,175,100,169,111,168,124,161,133,160,144,158,155,164,170,164,179,178,178,191,181,201,187,202,195,212,195,214,187,220,148,221,132" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','86','Santiago del Estero')" alt="Santiago del Estero" title="Santiago del Estero"   />
                                <area shape="poly" coords="146,113,149,108,157,108,164,111,171,112,167,122,163,129,161,135,157,146,149,142,143,134,141,129,145,122" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','90','Tucumán')" alt="Tucumán" title="Tucumán"   />
                                <area shape="poly" coords="97,89,130,91,135,97,127,100,130,111,138,109,144,119,141,134,147,141,156,144,158,158,163,170,162,180,152,190,147,172,135,160,134,153,119,150,112,152,108,148,103,147,97,141,87,141,90,126,100,127,95,116,96,111,100,109,94,96,96,94" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','10','Catamarca')" alt="Catamarca" title="Catamarca"   />
                                <area shape="poly" coords="353,107,364,107,368,116,369,131,348,147,330,157,324,140,340,132,350,126" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','54','Misiones')" alt="Misiones" title="Misiones"   />
                                <area shape="poly" coords="322,143,328,158,308,178,285,202,280,198,272,194,262,195,254,198,258,190,255,178,263,171,268,160,267,155,275,144,277,134,290,136,303,143,314,142,323,139" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','18','Corrientes')" alt="Corrientes" title="Corrientes"   />
                                <area shape="poly" coords="270,151,221,148,211,195,216,205,208,223,209,234,216,246,196,277,215,278,231,262,239,263,241,259,233,244,235,235,237,223,246,219,253,199,257,191,254,184,257,177,267,165,266,158" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','82','Santa Fe')" alt="Santa Fe" title="Santa Fe"   />
                                <area shape="poly" coords="287,208,285,222,277,231,278,243,280,252,273,257,270,265,274,277,267,273,255,266,239,257,233,242,235,228,241,220,254,198,268,195,281,197" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','30','Entre Ríos')" alt="Entre Ríos" title="Entre Ríos"   />
                                <area shape="poly" coords="147,225,146,207,153,197,154,186,162,185,160,178,178,177,198,184,202,194,212,197,215,206,212,215,207,223,210,234,215,247,196,277,188,276,186,290,158,289,157,252,163,235,158,235,157,230" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','14','Córdoba')" alt="Córdoba" title="Córdoba"   />
                                <area shape="poly" coords="86,143,79,154,89,165,88,183,97,180,117,192,123,204,124,216,130,224,145,224,146,209,153,194,152,186,146,171,138,165,134,155,132,152,118,151,108,153,107,148,99,144,96,142" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','46','La Rioja')" alt="La Rioja" title="La Rioja"   />
                                <area shape="poly" coords="78,158,71,171,72,194,67,196,67,206,61,214,63,224,72,239,78,240,79,232,88,228,94,233,99,231,110,229,118,233,117,226,125,224,124,216,125,206,117,199,114,192,99,180,89,180,91,163,85,160,83,156" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','70','San Juan')" alt="San Juan" title="San Juan"   />
                                <area shape="poly" coords="156,310,130,310,134,293,132,282,129,279,131,265,122,256,121,244,120,235,116,232,117,225,126,226,135,227,147,226,156,228,156,235,161,235,161,245,158,253,158,268,158,287" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','74','San Luis')" alt="San Luis" title="San Luis"   />
                                <area shape="poly" coords="232,263,243,263,254,267,272,275,279,285,289,300,285,312,290,324,297,326,295,338,280,352,270,363,247,370,232,372,219,374,204,372,201,379,204,389,200,394,198,402,201,408,194,411,188,408,184,407,188,278,215,280" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','6','Buenos Aires')" alt="Buenos Aires" title="Buenos Aires"   />
                                <area shape="poly" coords="409,196,397,202,390,207,385,216,378,230,373,254,402,284,420,262,431,263,446,256,453,252,454,240,450,232,447,225,438,219,424,210" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','2','Ciudad Autónoma de Buenos Aires')" alt="Ciudad Autónoma de Buenos Aires" title="Ciudad Autónoma de Buenos Aires"   />
                                <area shape="poly" coords="186,290,158,290,157,310,105,310,106,341,114,342,114,348,118,355,127,358,135,366,149,368,164,367,178,372,185,379" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','42','La Pampa')" alt="La Pampa" title="La Pampa"   />
                                <area shape="poly" coords="72,244,81,241,80,233,87,229,95,233,106,229,117,234,122,244,123,257,130,268,128,277,134,284,136,296,133,309,107,310,105,312,106,340,98,338,89,333,80,331,78,324,73,318,67,316,72,307,65,294,72,286,75,276,76,263,75,255,71,253" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','50','Mendoza')" alt="Mendoza" title="Mendoza"   />
                                <area shape="poly" coords="67,316,59,323,57,340,60,354,65,367,55,374,54,388,52,396,51,409,52,419,62,415,62,409,70,403,78,400,80,391,89,384,102,372,106,364,106,342,95,338,88,334,81,335,79,328" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','58','Neuquén')" alt="Neuquén" title="Neuquén"   />
                                <area shape="poly" coords="52,416,53,430,158,432,159,422,154,411,159,404,169,409,180,416,193,411,188,407,183,405,185,377,172,371,163,368,149,366,133,365,132,359,122,357,117,355,112,350,117,345,107,344,107,366,100,375,92,385,78,389,80,400,71,404,60,410" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','62','Río Negro')" alt="Río Negro" title="Río Negro"   />
                                <area shape="poly" coords="56,436,155,433,165,438,176,434,179,442,177,448,171,448,169,444,162,442,159,447,166,453,157,457,152,467,152,480,147,488,148,496,136,494,128,501,123,508,121,513,63,515,59,509,66,501,63,497,54,498,55,491,66,491,69,482,61,483,57,483,56,476,58,469,54,466,58,456,48,455,51,445,47,438" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','26')" alt="Chubut" title="Chubut"   />
                                <area shape="poly" coords="63,516,119,515,120,520,126,527,134,536,145,536,147,544,145,555,132,563,124,573,120,581,118,595,109,600,103,605,101,617,104,630,114,646,97,640,80,637,67,638,61,628,62,615,60,610,53,615,48,614,44,607,44,594,42,583,48,584,48,580,55,573,54,568,58,563,53,557,55,551,60,542,59,532,63,527,57,520" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','78','Santa Cruz')" alt="Santa Cruz" title="Santa Cruz"   />
                                <area shape="poly" coords="110,653,112,696,129,696,141,698,151,696,152,692,153,690,141,689,134,683,124,676,118,665" style="cursor:pointer;"  onclick="viewJurisdiccion('<?php echo FP_ID?>','94','Tierra del Fuego')" alt="Tierra del Fuego" title="Tierra del Fuego"   />
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
                            <li>1.082 instituciones ingresadas al RFIETP (*)</li>
                            <li>93% de las instituciones son de gestión estatal (*)</li>
                            <li>235.656 alumnos matriculados (**)</li>
                        </ul>
                        <br/>
                        <div>
                            <? //echo $html->image('home/graficoFP.png', array('class' => 'docimg', 'style' => 'width:307px')); ?>
                            <div id="grafico_fp"></div>
                        </div>
                        <br/>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <p style="font-size: 9px;">
            (*) ME - INET. Unidad de Información - Área Registro Federal de Instituciones de
            Educación Técnico Profesional (RFIETP). Instituciones ingresadas a la base de datos
            del RFIETP a la fecha.
            <br />
            (**) ME - DINIECE. Área Gestión de la Información. Relevamiento Anual 2009.
            <br />
            (***) ME - INET. Unidad de Información - Área Registro Federal de Instituciones
            de Educación Técnico Profesional (RFIETP) Los datos corresponden a la última
            información presentada por los establecimientos al RFIETP. Información al 30/09/2011.
        </p>
    </div>
</div>