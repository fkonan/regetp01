<?php echo $javascript->link('jquery/jquery.tmpl.min', false); ?>
<?php echo $javascript->link('jquery/jquery.history', false); ?>
<?php echo $javascript->link('jquery.loadmask.min', false); ?>
<?php echo $javascript->link('jquery.multiselect.min', false); ?>
<?php echo $javascript->link('jquery.checkbox.min', false); ?>
<?php echo $html->css(array('jquery.loadmask', 
                            'catalogo.guia_del_estudiante',
                            'jquery.multiselect')); ?>

<!-- 
Inicializacion de url global para el manejo de los callbacks 
y funciones javascript de esta pagina 

<script type="text/javascript">
    $(document).ready(function() {
        var urlDomain = "<?php echo $html->url('/')?>";

        $("#TituloSectorId").multiselect({
              noneSelectedText: 'Seleccione sectores',
              selectedList: 4
           });
   });
</script>
-->
<!-- 
Templates de jQuery para los resultados de busqueda
-->
<script id="tituloTemplate" type="text/x-jquery-tmpl">
    <li titulo-id="${Titulo.id}">
        <input type="checkbox" class="styled_checkbox" name="data[Plan][titulo_id][]" value="${Titulo.id}" >
        <span class="titulo_label"><b>${Titulo.name}</b> (${Oferta.name})</span>
    </li>
</script>

<script id="institTemplate" type="text/x-jquery-tmpl">
    <li>
        <a href="<?php echo $this->base ?>/instits/view/${Instit.id}"><b>${Instit.cue}${Instit.anexo}</b> ${Instit.nombre_completo}</a>
    </li>
</script>

<script id="paginatorTemplate" type="text/x-jquery-tmpl">
    <div class="paginator">
        <p class="count"><b>${cant}</b> ${texto}</p>
        <p class="numbers">{{html numbers}}</p>
    </div>   
</script>


<br />
<div class="grid_12 boxgris">
     <?php echo $html->image('1-icon.png', array('class' => 'step'));?>
    <h2>Seleccione Criterios de Busqueda:</h2>
    <div id="filtro" class="boxblanca">
        <?php echo $form->create('Titulo', array(
                'action' => 'guia_del_estudiante',
                'name'=>'TituloSearchForm',
                'id' =>'TituloSearchForm',
                ));
        ?>
        <div  id="filtrosContainer">
            <?php echo $this->element('filtros');?>
        </div>
        <div class="grid_1 alpha omega prefix_10">
            <?php echo $form->end('Buscar');?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="boxblanca filtros-aplicados">
        <h3>Criterios Aplicados:</h3>
        <?php echo $form->create('Titulo', array(
            'action' => 'guia_del_estudiante',
            'name'=>'FiltrosAplicadosForm',
            'id' =>'FiltrosAplicadosForm'
            ));
        ?>
        <p id="sin_filtros">No hay fitros aplicados</p>

        <?php echo $form->end();?>
    </div>
</div>
<div class="clear"></div>
<br />

<?php echo $form->create('Instit', array(
            'controller'=>'instits',
            'action'=>'search.json',
            'id'=>'InstitSearchForm', 'name'=>'InstitSearchForm' ));
?>
<div id="resultados" class="grid_12">
    <div id="li_titulos" class="grid_6 alpha boxgris">
        <?php echo $html->image('2-icon.png', array('class' => 'step'));?>
        <h2>Seleccioná el titulo de interes</h2>
            <div class="paginatorContainer"></div>
        <ul class="seleccionados"></ul>
        <ul class="results">
            Sin Resultados
        </ul>
    </div>
    <?php echo $form->end(); ?>

    <div id="li_instits" class="grid_6 omega boxgris">
        <?php echo $html->image('3-icon.png', array('class' => 'step'));?>
        <h2>¿Dónde estudiar?</h2>
        <div class="paginatorContainer"></div>
        <ul class="results">
            Sin Resultados
        </ul>
    </div>
</div>

<?php echo $javascript->link('views/titulos/guia_del_estudiante_tail'); ?>

