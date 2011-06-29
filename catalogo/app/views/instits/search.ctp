<?
echo $javascript->link(array(
'jquery.loadmask.min',
'jquery.autocomplete'
), false);

echo $html->css(array(  'jquery.loadmask',
                        'smoothness/jquery-ui-1.8.6.custom',
                        'catalogo.advanced_search',
                        'catalogo.instits',
                        'jquery.autocomplete.css'
                        ), $inline=false);
?>

<script type="text/javascript" language="javascript">
        init__SearchFormJs("<?echo $html->url(array('controller'=>'localidades','action'=>'ajax_search_localidades'));?>");
</script>

<div class="grid_12 instits search_form">

    <h1><? __('Búsqueda de Instituciones')?></h1>
    
    <div class="boxblanca inputs_largos">
        <h3>Seleccione criterios de búsqueda</h3>
        <?php
        echo $form->create('Instit', array(
        'action' => 'search_results',
        'name'=>'InstitSearchForm',
        'id' =>'InstitSearchForm',
        )
        );
        echo $form->hidden('form_name',array('value'=>'buscador rapido'));
        ?>
        <div class="instit_search">
            <div class="box_centrada">
                <?php
                echo $form->input('jurisdiccion_id',
                                  array('label'=>'Jurisdicción',
                                        'empty' => array('0'=>'Todas'),
                                        'id'=>'jurisdiccion_id'));
                echo $form->input('jur_dep_loc',
                                  array('label'=>'Departamento/Localidad',
                                        'div' => array('id' => 'search-ubicacion'),
                                        'title'=>'Ingrese al menos 3 letras para que comience la busqueda de Departamentos y Localidades.'));
                echo $form->input('direccion',array('label'=>'Domicilio',));

                echo $form->input(  'busqueda_libre', array(
                                    'id' => 'InstitCue',
                                    'label' => 'CUE o Nombre de la Institución',
                                    ));

                $name = $val = '';
                if (!empty($this->data['Instit']['localidad_id'])) {
                    $name = "data[Instit][localidad_id]"; $val =
                    $this->data['Instit']['localidad_id'];
                } elseif (!empty($this->data['Instit']['departamento_id'])) {
                    $name = "data[Instit][departamento_id]"; $val =
                    $this->data['Instit']['departamento_id'];
                }
                ?>
                <input id="hiddenLocDepId" name="<?php echo $name?>" type="hidden" value="<?php echo $val?>" />
            </div>
            <?php
            echo "<div style='clear:both; width: 100%'>";
                echo $form->button('Buscar', array(
                'type' => 'submit',
                'style' => 'width: 130px; clear: both;margin-right:20px;float:right;margin-bottom:10px',
                'class' => '',
                ));
                echo "</div>";
            ?>
            <div class="clear"></div>
        </div>
        
        <?php
            echo $form->end();
        ?>
        <div class="clear"></div>
    </div>

    <!-- Aca se muestran los resultados de la busqueda-->
    <div class="clear"></div>
    <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px; margin-top:15px;">
    </div>

</div>
<script type="text/javascript">
jQuery(document).ready(function() {
    <?php
    if ($bySession) {
    ?>
        jQuery("#InstitSearchForm").submit();
    <?php
    }
    ?>
});
</script>