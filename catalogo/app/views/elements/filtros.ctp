<div class="seccion grid_3 alpha">
    <h4>Títulos</h4>
    <div>
        <div id="ofertas_section" style="padding:2px 0 2px 0;">
            <label for="data[Titulo][oferta_id]">Nivel<br></label>
            <?php
            echo
            $form->radio('Titulo.oferta_id',$ofertas,
                        array('empty' => 'Seleccione...',
                            'legend' => false,
                            'class' => 'autosubmit ofertas_radio',
                            'value'=> false)
                        );
            ?>
        </div>
        <div style="padding:2px 0 2px 0;">
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
        <div style="padding:2px 0 2px 0;">
            <?php echo $form->input('Titulo.tituloName',
            array(
            'div'=>false,
            'label' => 'Nombre del Título<br />',
            'after' => '<a class="add_filter">+</a>'
            )
            )
            ?>
        </div>
        <p class="msj-vacio">No hay filtros disponibles...</p>
    </div>
</div>
<div class="seccion grid_4 alpha omega">
    <div class="seccion">
        <h4>Ubicación</h4>
        <div>
            <div style="padding:2px 0 2px 0;">
                <?php echo $form->input('Instit.jurisdiccion_id',
                array('options'=>$jurisdicciones,
                'div'=>false,
                'label' => 'Jurisdicción<br />',
                'empty' => 'Seleccione...',
                'class' => 'autosubmit mandatory'
                )
                )
                ?>
            </div>
            <div style="padding:2px 0 2px 0;">
                <?php echo $form->input('Instit.departamento_id',
                array('type'=>'select',
                'div'=>false,
                'label' => 'Departamento<br />',
                'empty' => 'Seleccione...',
                'class' => 'autosubmit'
                )
                ) ?>
            </div>
            <div style="padding:2px 0 2px 0;">
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
    <div class="seccion">
        <h4>Institución</h4>
        <div>
            <div style="padding:2px 0 2px 0;">
                <?php echo $form->input('Instit.gestion_id',
                array('options'=>$gestiones,
                'div'=>false,
                'label' => 'Ámbito de Gestión<br />',
                'empty' => 'Seleccione...',
                'class' => 'autosubmit'
                )
                )
                ?>
            </div>
            <div style="padding:2px 0 2px 0;">
                <?php echo $form->input('Instit.nombre',
                array(
                'div'=>false,
                'label' => 'Nombre de la Institución<br />',
                'after' => '<a class="add_filter">+</a>'
                )
                )
                ?>
            </div>
            <p class="msj-vacio">No hay filtros disponibles...</p>
        </div>
    </div>
</div>
