
<?
echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.loadmask.min',
    'views/instits/search_form',
        ));

echo $html->css(array('jquery.loadmask'));
?>

<h1><? __('Búsqueda de Instituciones')?></h1>


<div>
    <?php
    echo $form->create('Instit', array(
        'action' => 'search',
        'name'=>'InstitSearchForm',
        'id' =>'InstitSearchForm',
        )
    );

    echo $form->hidden('form_name',array('value'=>'buscador rapido'));

    echo $form->input('jurisdiccion_id',array(
            'label'=>'Jurisdicción',
            'empty'=>'TODAS',
            'after' => '<br><cite>Filtro opcional. Si no selecciona una Jurisdicción se realizará una búsqueda en todo el Registro.</cite>'
            ));
    
    echo $form->input('busqueda_libre', array(
            'style'=>'border:1px solid #BBBBBB; width: 99%; font-size: 22px; height: 29px; color: rgb(117, 117, 117);',
            'label'=> 'CUE ó Nombre de la Institución',
            'title'=> 'Ingrese CUE ó Nombre de la institución en forma completa ó parcial. Ej: 600118, 5000216 ó Manuel Belgrano.',
            ));



    echo $html->link('realizar una búsqueda avanzada...','advanced_search_form',array(
        'class'=>'link_right small',
        'style'=>'margin-bottom: -18px; padding:0px; margin-right: 4px;'
    ));



    echo $form->end('Buscar');
    
    ?>

    <!-- Aca se muestran los resultados de la busqueda-->
    <div id='consoleResultWrapper'  style="margin-top: 20px;">
        <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;"></div>
    </div>
    
</div>
