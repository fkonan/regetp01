<div class="seccion grid_4 alpha">
    <h4>Títulos</h4>
    <div>
    <?php echo $form->input('Titulo.oferta_id',
            array('empty' => 'Seleccione...',
                  'div'=>false,
                  'label' => 'Oferta<br />',
                  'class' => 'autosubmit ui-widget ui-state-default ui-corner-all'));
    ?>
    </div>
    <div>
    <?php echo $form->input('Titulo.sector_id', 
            array('options'=>$sectores,
                  'div'=>false,
                  'label' => 'Sector<br />',
                  'empty' => 'Seleccione...',
                  'multiple'=>false,
                  'class' => 'autosubmit ui-widget ui-state-default ui-corner-all'
                )
            )
    ?>
    </div>
    <div>
    <?php echo $form->input('Titulo.tituloName',
                            array(
                            'div'=>false,
                            'label' => 'Nombre del Título<br />',
                            'class' => 'autosubmit ui-widget ui-state-default ui-corner-all'
                                )
                            )
    ?>
    </div>
    <p class="msj-vacio">No hay filtros disponibles...</p>
</div>
<div class="seccion grid_4">
    <h4>Ubicación</h4>
    <?php echo $form->input('Instit.jurisdiccion_id', 
            array('options'=>$jurisdicciones,
                'div'=>false,
                'label' => 'Jurisdicción<br />',
                'empty' => 'Seleccione...',
                'class' => 'autosubmit ui-widget ui-state-default ui-corner-all'
                )
            )
    ?>
    <?php echo $form->input('Instit.departamento_id',
            array('type'=>'select',
                  'div'=>false,
                  'label' => 'Departamento<br />',
                  'empty' => 'Seleccione...',
                   'class' => 'autosubmit ui-widget ui-state-default ui-corner-all'
                )
            ) ?>
    <?php echo $form->input('Instit.localidad_id',
            array('type'=>'select',
                  'div'=>false,
                  'label' => 'Localidad<br />',
                  'empty' => 'Seleccione...',
                   'class' => 'autosubmit ui-widget ui-state-default ui-corner-all'
                )
            ) ?>
    <p class="msj-vacio">No hay filtros disponibles...</p>
</div>
<div class="seccion grid_3 omega">
    <h4>Institución</h4>
    <div>
    <?php echo $form->input('Instit.gestion_id',
            array('options'=>$gestiones,
                'div'=>false,
                'label' => 'Ámbito de Gestión<br />',
                'empty' => 'Seleccione...',
                'class' => 'autosubmit ui-widget ui-state-default ui-corner-all'
                )
            )
    ?>
    </div>
    <div>
    <?php echo $form->input('Instit.nombre',
            array(
                'div'=>false,
                'label' => 'Nombre de la Institución<br />',
                'class' => 'autosubmit ui-widget ui-state-default ui-corner-all'
                )
            )
    ?>
    </div>
    <p class="msj-vacio">No hay filtros disponibles...</p>
</div>