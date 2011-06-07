<div class="seccion grid_4 alpha">
    <h3>T�tulos</h3>
    <div class="borde_derecho">
        <div>
        <?php echo $form->input('Titulo.oferta_id',
                array('empty' => 'Seleccione...',
                      'div'=>false,
                      'label' => 'Oferta<br />',
                      'class' => 'autosubmit'));
        ?>
        </div>
        <div>
        <?php echo $form->input('Titulo.sector_id',
                array('options'=>$sectores,
                      'div'=>false,
                      'label' => 'Sector<br />',
                      'empty' => 'Seleccione...',
                      'multiple'=>false,
                      'class' => 'autosubmit'
                    )
                )
        ?>
        </div>
        <div>
        <?php echo $form->input('Titulo.tituloName',
                                array(
                                'div'=>false,
                                'label' => 'Nombre del T�tulo<br />',
                                'class' => 'autosubmit'
                                    )
                                )
        ?>
        </div>
        <p class="msj-vacio">No hay filtros disponibles...</p>
    </div>
</div>
<div class="seccion grid_4">
    <h3>Ubicaci�n</h3>
    <div class="borde_derecho">
        <div>
        <?php echo $form->input('Instit.jurisdiccion_id',
                array('options'=>$jurisdicciones,
                    'div'=>false,
                    'label' => 'Jurisdicci�n<br />',
                    'empty' => 'Seleccione...',
                    'class' => 'autosubmit mandatory'
                    )
                )
        ?>
        </div>
        <div>
        <?php echo $form->input('Instit.departamento_id',
                array('type'=>'select',
                      'div'=>false,
                      'label' => 'Departamento<br />',
                      'empty' => 'Seleccione...',
                      'class' => 'autosubmit'
                    )
                ) ?>
        </div>
        <div>
        <?php echo $form->input('Instit.localidad_id',
                array('type'=>'select',
                      'div'=>false,
                      'label' => 'Localidad<br />',
                      'empty' => 'Seleccione...',
                       'class' => 'autosubmit'
                    )
                ) ?>
        </div>
        <p class="msj-vacio">No hay filtros disponibles...</p>
    </div>
</div>
<div class="seccion grid_3 omega">
    <h3>Instituci�n</h3>
    <div class="borde_derecho">
    <?php echo $form->input('Instit.gestion_id',
            array('options'=>$gestiones,
                'div'=>false,
                'label' => '�mbito de Gesti�n<br />',
                'empty' => 'Seleccione...',
                'class' => 'autosubmit'
                )
            )
    ?>
    </div>
    <div>
    <?php echo $form->input('Instit.nombre',
            array(
                'div'=>false,
                'label' => 'Nombre de la Instituci�n<br />',
                'class' => 'autosubmit'
                )
            )
    ?>
    </div>
    <p class="msj-vacio">No hay filtros disponibles...</p>
</div>
