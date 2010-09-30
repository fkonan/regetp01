
<?
echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.loadmask.min',
    'views/instits/search_form',
        ));

echo $html->css(array('jquery.loadmask'));
?>

<h1><? __('Búsqueda de Instituciones')?></h1>

<?php
echo $html->link('realizar una búsqueda avanzada...','advanced_search_form',array(
    'class'=>'link_right small',
    'style'=>'margin-bottom: -18px; padding:0px; margin-right: 4px;'
    ));
?>


<div>
    <?php
    echo $form->create('Instit', array(
        'action' => 'ajax_search',
        'name'=>'InstitSearchForm'
        )
    );
    
    echo $form->input('cue', array(
            'style'=>'border:1px solid #BBBBBB; width: 99%; font-size: 22px; height: 29px; color: rgb(117, 117, 117);',
            'label'=> 'CUE ó Nombre de la Institución',
            'title'=> 'Ingrese CUE ó Nombre de la institución en forma completa ó parcial. Ej: 600118, 5000216 ó Manuel Belgrano.',
            ));      
    echo $form->end();
    ?>

    <!-- Aca se muestran los resultados de la busqueda-->
    <div id='consoleResultWrapper'  style="margin-top: 20px;">
        <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;"></div>
    </div>
    
</div>
