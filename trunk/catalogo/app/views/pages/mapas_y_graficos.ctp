<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.js-tabs-ofertas').tabs();
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

                    <h3> Mapa </h3>
                    <div>
                        <? echo $html->image('home/mapaSupSep2010.jpg', array('class' => 'docimg', 'style' => '')); ?>
                    </div>
                    <h3> Gráfico </h3>
                    <div>
                        <? echo $html->image('home/graficoNivelSuperior.png', array('class' => 'docimg', 'style' => '')); ?>
                    </div>

                </div>
                <div id="ver-oferta-2" class="descargas-container" style="">

                    <h3> Mapa </h3>
                    <div>
                        <? echo $html->image('home/mapaSecSep2010.jpg', array('class' => 'docimg', 'style' => '')); ?>
                    </div>
                    <h3> Gráfico </h3>
                    <div>
                        <? echo $html->image('home/graficoNivelSecundario.png', array('class' => 'docimg', 'style' => '')); ?>
                    </div>

                </div>
                <div id="ver-oferta-3" class="descargas-container" style="">

                    <h3> Mapa </h3>
                    <div>
                        <? echo $html->image('home/mapaCFPSep2010.jpg', array('class' => 'docimg', 'style' => '')); ?>
                    </div>
                    <h3> Gráfico </h3>
                    <div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>