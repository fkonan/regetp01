<script type="text/javascript">
/**
     * Trae los titulos en JSON, usando ajax
     */
    function getTitulos() {
        var params = buscadorEstudiantes.serialize();
        var postvar = $.post( 
                urlDomain + 'titulos/ajax_search_estudiantes_results.json',
                params,
               // __meterTitulosEnTemplate,
                'json'
            );
                
        postvar.error(function(e, t) {
            console.info('Llegó con error el json de titulos: ' + t);
            console.debug(e);
        });

        return true;
    }
</script>
 <?php
        echo $form->create('Titulo', array(
            'onsubmit' => 'return (getTitulos());',
            'action' => '',
            'name'=>'buscadorEstudiantes',
            'id' =>'buscadorEstudiantes',
            )
        );

        ?>
        <div id="li_titulos" class="grid_6 alpha">
            <?php
            echo $form->input(
            'que',
            array(
                'label'=> '¿Que?',
                'id' => 'que',
                'div' => false,
                ));

            ?>
        </div>
        <div id="li_instits" class="grid_6 omega">
            <?php
            echo $form->input(
            'como',
            array(
                'label'=> '¿Donde?',
                'id' => 'donde',
                'div' => false,
                ));
            ?>
        </div>

        <?php echo $form->end('Buscar');
    ?>