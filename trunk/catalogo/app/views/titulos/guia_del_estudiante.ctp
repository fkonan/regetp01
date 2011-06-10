<?php
echo $javascript->link('jquery/jquery.tmpl.min', false);
echo $javascript->link('jquery/jquery.history', false);
echo $javascript->link('jquery.loadmask.min', false);
echo $html->css(array('jquery.loadmask', 'catalogo.guia_del_estudiante'), $inline = false);
?>
<script id="tituloTemplate" type="text/x-jquery-tmpl">
    <li titulo-id="${Titulo.id}">
        <input type="radio" class="styled_checkbox" name="data[Plan][titulo_id]" value="${Titulo.id}" id="check_${Titulo.id}" />
        <label for="check_${Titulo.id}" class="titulo_label">
        <span class="items-nombre">
            <strong>${Titulo.name}</strong>
        </span>
        <br />
        <span class="items-oferta">
                ${Oferta.name}
        </span>
        </label>
        <div class="clear"></div>
    </li>
</script>

<script id="institTemplate" type="text/x-jquery-tmpl">
    <li>
        <div class="items-nombre">
            <a href="<?php echo $this->base?>/instits/view/${Instit.id}">
            ${Instit.cue}${Instit.anexo} - ${Instit.nombre_completo}</a>
        </div>
        <div class="items-domicilio">
            ${Localidad.name}, ${Departamento.name}, ${Jurisdiccion.name}
        </div>
    </li>
</script>
<?php  //$paginator->options(array('update' => 'consoleResult', 'url' => $this->passedArgs,'indicator'=> 'ajax_indicator')); ?>
<script id="paginatorTemplate" type="text/x-jquery-tmpl">
    <div class="list-header">
        <div class="sorter">
           ${desde}-${hasta} de <b>${cant}</b> ${texto}
        </div>
        <div class="paging">
            <span class="numbers">{{html numbers}}</span>
        </div>
        <div class="clear"></div>
    </div>
</script>

<div class="grid_12">
    <h1>Guía del Estudiante</h1>
    <p>La Guía del Estudiante ayudará a que puedas encontrarar donde estudiar y obtener un título o certificación según tus gustos e intereses. </p>

    <div class="boxblanca">
        <?php echo $html->image('1-icon.png', array('class' => 'step'));?>
        <h3>Seleccioná criterios de búsqueda</h3>
        <div id="filtro" class="boxblanca">
            <?php echo $form->create('Titulo', array(
            'action' => 'guia_del_estudiante', 'name'=>'TituloSearchForm',
            'id' =>'TituloSearchForm', ));
            ?>
            <div id="filtrosContainer">
                <?php echo $this->element('filtros');?>
            </div>
            <?php echo $form->end();?>
            <div class="clear"></div>
        </div>
        <div class="boxblanca filtros-aplicados">
            <h3>Criterios aplicados</h3>
            <?php echo $form->create('Titulo', array(
            'action' => 'guia_del_estudiante', 'name'=>'FiltrosAplicadosForm',
            'id' =>'FiltrosAplicadosForm' ));
            ?>
            <p id="sin_filtros">No hay fitros aplicados</p>

            <?php echo $form->end();?>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="clear" style="height:20px;"></div>

<div id="resultados" class="grid_12">
    <div class="grid_6 alpha">
        <div id="li_titulos" class="boxblanca">
            <?php echo $form->create('Instit', array(
            'controller'=>'instits', 'action'=>'search.json',
            'id'=>'InstitSearchForm', 'name'=>'InstitSearchForm' ));
            ?>
            <?php echo $html->image('2-icon.png', array('class' => 'step'));?>
            <h3>Seleccioná el titulo de interés</h3>
            <div class="paginatorContainer"></div>
            <ul class="seleccionados"></ul>
            <ul id="items" class="results">
                Sin Resultados
            </ul>
            <?php echo $form->end(); ?>
        </div>
    </div>

    <div class="grid_6 omega">
        <div id="li_instits" class="boxblanca">
            <?php echo $html->image('3-icon.png', array('class' => 'step'));?>
            <h3>¿Dónde estudiar?</h3>
            <div class="paginatorContainer"></div>
            <ul id="items" class="results">
                Sin Resultados
            </ul>
        </div>
    </div>
</div>

<?php echo $javascript->link('views/titulos/guia_del_estudiante_tail'); ?>

