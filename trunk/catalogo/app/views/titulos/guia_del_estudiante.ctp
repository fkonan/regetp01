<?php echo $javascript->link('jquery/jquery.tmpl.min', false); ?>
<?php echo $javascript->link('jquery/jquery.history', false); ?>
<?php echo $javascript->link('jquery.loadmask.min', false); ?>
<?php echo $html->css(array('jquery.loadmask', 'catalogo.guia_del_estudiante')); ?>

<!-- 
Inicializacion de url global para el manejo de los callbacks 
y funciones javascript de esta pagina 
-->
<script type="text/javascript">
    var urlDomain = "<?php echo $html->url('/')?>";
</script>

<!-- 
Templates de jQuery para los resultados de busqueda
-->
<script id="tituloTemplate" type="text/x-jquery-tmpl">
    <li titulo-id="${Titulo.id}">
        <input type="checkbox" name="data[Plan][titulo_id][]" value="${Titulo.id}" >
        <b>${Titulo.name}</b> (${Oferta.name})       
    </li>
</script>


<script id="institTemplate" type="text/x-jquery-tmpl">
    <li>
        <b>${Instit.cue}${Instit.anexo}</b> ${Instit.nombre_completo}
    </li>
</script>

<script id="paginatorTemplate" type="text/x-jquery-tmpl">
    <div class="paginator">
        <p class="count"><b>${cant}</b> ${texto}</p>
        <p class="numbers">{{html numbers}}</p>
    </div>   
</script>



<div id="filtro" class="grid_12">
    <h2>Filtros</h2>
    <?php echo $form->create('Titulo', array(
            'action' => 'guia_del_estudiante',
            'name'=>'TituloSearchForm',
            'id' =>'TituloSearchForm',
            )) 
     ?>
    <div class="grid_5 alpha" style="border-right: 1px solid black">
    <?php echo $form->input('Titulo.que', array(
                'label'=> '¿Qué?',
                )) ?>
    <?php echo $form->input('Titulo.tituloName') ?>
    <?php echo $form->input('Titulo.oferta_id') ?>
    <?php echo $form->input('Titulo.sector_id', array('options'=>$sectores, 'multiple'=>true, 'style'=>'height:100px')) ?>
    </div>
    
    <div class="grid_5 omega">
    <?php echo $form->input('Titulo.donde', array(
            'label'=> '¿Dónde?',
            )) ?>
    <?php echo $form->input('Instit.jurisdiccion_id', array('options'=>$jurisdicciones, 'label'=> 'Jurisdicción')) ?>
    </div>
    <div class="grid_12 push_11">
        <?php echo $form->end('Buscar') ?>
    </div>
    
</div>


<?php echo $form->create('Instit', array(
            'controller'=>'instits',
            'action'=>'search.json',
            'id'=>'InstitSearchForm', 'name'=>'InstitSearchForm' ));
?>
<div id="resultados" class="grid_12">
    <div id="li_titulos" class="grid_6 alpha">
        <h2>¿Qué Estudiar?</h2>
            <div class="paginatorContainer"></div>
        <ul class="seleccionados"></ul>
        <ul class="results"></ul>
    </div>
    <?php echo $form->end(); ?>

    <div id="li_instits" class="grid_6 omega">
        <h2>¿Dónde Estudiar?</h2>
        <div class="paginatorContainer"></div>
        <ul class="results"></ul>
    </div>
</div>

<?php echo $javascript->link('views/titulos/guia_del_estudiante_tail'); ?>

