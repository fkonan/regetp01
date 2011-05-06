<?php echo $javascript->link('jquery/jquery.tmpl.min', false); ?>
<?php echo $javascript->link('jquery/jquery.history', false); ?>



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
    <li><a href="instits/search" titulo="${Titulo.id}"><b>${Titulo.name}</b> (${Oferta.name})</a></li>
</script>

<script id="institTemplate" type="text/x-jquery-tmpl">
    <li><b>${Instit.nombre_completo}</b> (---)</li>
</script>



<div id="filtro" class="grid_12">
    <?php echo $form->create('Titulo', array(
            'action' => 'guia_del_estudiante',
            'name'=>'TituloSearchForm',
            'id' =>'TituloSearchForm',
            )) ?>
    
    <?php echo $form->input('Titulo.tituloName') ?>
    <?php echo $form->input('Titulo.oferta_id') ?>
    
    <?php echo $form->end('Buscar') ?>
    
</div>

<div id="li_titulos" class="grid_6 alpha">
    <h2>¿Qué Estudiar?</h2>
    <p style="display: none"><b></b> Títulos o Certificados encontrados</p>
    <ul>
        
    </ul>
</div>


<div id="li_instits" class="grid_6 omega">
    <h2>¿Dónde Estudiar?</h2>
    <ul>
        
    </ul>
</div>


<?php echo $javascript->link('views/titulos/guia_del_estudiante_tail'); ?>

