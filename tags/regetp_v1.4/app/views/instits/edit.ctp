<div class="instits form">
    <h1>Editar Institución </h1>
    <?php echo $form->create('Instit');?>
    <?php
    echo $form->input('id');
    echo $form->input('depto',array('type'=>'hidden'));
    echo $form->input('localidad',array('type'=>'hidden'));


    /**
     *    ACTIVO
     */
    echo $form->input('activo',array('type'=> 'checkbox','label'=>'Institución ingresada al RFIETP'));


    /**
     *    CUE
     */
    echo $form->input('cue',array(	'maxlength'=>7,
    'label'=>array('text' => 'CUE','class'=>'input_label'),
    'class'=> 'input_text_peque'
    ));

    /**
     *    ANEXO
     */
    echo $form->input('anexo',array('maxlength'=>2,
    'label'=>array('class'=>'input_label'),
    'class'=> 'input_text_peque'
    ));


    /**
     *    ES ANEXO
     */
    echo $form->input('esanexo',array('type'=> 'checkbox','label'=>'Es Anexo'));


    /**
     *    GESTION
     */
    echo $form->input('gestion_id',array('label'=>'Ámbito de Gestión'));

    /**
     *    DEPENDENCIA
     */
    echo $form->input('dependencia_id',array('label'=>'Tipo de Dependencia'));

    /**
     *    NOMBRE DE LA DEPENDENCIA
     */
    echo $form->input('nombre_dep',array('label'=>'Nombre de la Dependencia'));


    /**
     *    Clase de Instituicion
     */

    echo $form->input('claseinstit_id',array(
    'label'=>'Tipo de Institución de ETP',
    'empty'=>'Seleccione una clase'
    ));

    /**
     *    Estado de la institucion respecto del programa ETP
     */
    echo $form->input('etp_estado_id',array(
    'label'=>'Relación con ETP',
    'empty'=>'Seleccione un estado',
    'default' => 2 //instit de ETP
    ));


     /**
     *    Orientacion
     */
    echo $form->input('orientacion_id',array(
    'label'=>'Orientación',
    'empty' => 'Seleccione Orientación',
    ));

    

    /**
     *   AJAX ::> JURISDICCION - Departamentop - Localidad - Tipo de Institucion
     */
    $meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
    echo $form->input('jurisdiccion_id', array('empty' => array('0'=>'Todas'),'id'=>'jurisdiccion_id','label'=>'Jurisdicción','after'=>$meter));

    // DEPARTAMENTO
    $meter = '<span class="ajax_update" id="ajax_indicator_dpto" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
    echo $form->input('departamento_id', array('options'=> $departamentos, 'empty' => 'Seleccione','type'=>'select','label'=>'Departamento','after'=> $meter.'<br /><cite>Seleccione primero una jurisdicción.</cite>'));
    echo $ajax->observeField('jurisdiccion_id',
    array(  	'url' => '/departamentos/ajax_select_departamento_form_por_jurisdiccion',
    'update'=>'InstitDepartamentoId',
    'loading'=>'$("ajax_indicator").show();$("InstitDepartamentoId").disable()',
    'complete'=>'$("ajax_indicator").hide();$("InstitDepartamentoId").enable()',
    'onChange'=>true
    ));
    //LOCALIDAD
    echo $form->input('localidad_id', array('options'=> $localidades,'empty' => 'Seleccione','type'=>'select','label'=>'Localidad','after'=> '<br /><cite>Seleccione primero un Departamento.</cite>'));
    echo $ajax->observeField('InstitDepartamentoId',
    array(  	'url' => '/localidades/ajax_select_localidades_form_por_departamento',
    'update'=>'InstitLocalidadId',
    'loading'=>'$("ajax_indicator_dpto").show();$("InstitLocalidadId").disable()',
    'complete'=>'$("ajax_indicator_dpto").hide();$("InstitLocalidadId").enable()',
    'onChange'=>true
    ));

    echo $form->input('lugar',array('label'=>'Lugar: Barrio/Pueblo/Comuna/'));

    // TIPO DE INSTITUCION
    //echo $form->input('tipoinstit_id', array('empty' => 'Todas','disabled'=>true,'type'=>'select','label'=>'Tipo De Institución','after'=> '<br /><cite>Para activar este campo, seleccione primero una jurisdicción</cite>'));
    echo $form->input('tipoinstit_id', array('empty' => 'Seleccione','type'=>'select','label'=>'Tipo de Establecimiento','after'=> '<br /><cite>Seleccione primero una jurisdicción, asi selecciona los tipos de institución posibles</cite>'));
    echo $ajax->observeField('jurisdiccion_id',
    array(  	'url' => '/tipoinstits/ajax_select_form_por_jurisdiccion',
    'update'=>'InstitTipoinstitId',
    'loading'=>'$("ajax_indicator").show();$("InstitTipoinstitId").disable()',
    'complete'=>'$("ajax_indicator").hide();$("InstitTipoinstitId").enable()',
    'onChange'=>true
    ));



    /**
     *    NOMBRE
     */
    echo $form->input('nombre');


    /**
     *    Nro Instit
     */
    echo $form->input('nroinstit',array('label'=>array(	'text'=>'Nº de Institución',
            'class'=>'input_label'),
    'class'=> 'input_text_peque'
    ));




    /**
     *    AÑO CREACION
     */
    echo $form->input('anio_creacion',array('label'=>array('text'=>'Año de Creación',
            'class'=>'input_label'),
    'class'=> 'input_text_peque'
    ));

    /**
     *    DIRECCION
     */
    echo $form->input('direccion',array('label'=>array(	'text'=> 'Domicilio',
            'class'=>'input_label'),
    'class' => 'input_text_peque'
    ));


    /**
     *    CODIGO POSTAL
     */
    echo $form->input('cp',array('label'=>array('text'=>'Código Postal', 'class'=>'input_label'),
    'class' => 'input_text_peque'
    ));

    /**
     *    TELEFONO
     */
    echo $form->input('telefono',array('label'=>array(	'text'=>'Teléfono',
            'class'=>'input_label'),
    'class' => 'input_text_peque'
    ));
    echo $form->input('telefono_alternativo',array('label'=>array(	'text'=>'Teléfono Alternativo',
            'class'=>'input_label'),
    'class' => 'input_text_peque'
    ));

    /**
     *    WEB Y MAIL
     */
    echo $form->input('mail',array('label'=>array('text'=> 'E-Mail',
            'class'=>'input_label'),
    'class' => 'input_text_peque'
    ));
    echo $form->input('mail_alternativo',array('label'=>array('text'=> 'E-Mail Alternativo',
            'class'=>'input_label'),
    'class' => 'input_text_peque'
    ));

    echo $form->input('web',array('label'=>array('class'=>'input_label'),
    'class' => 'input_text_peque'));




    /******************************************************************************
	* 
	* 
	*    DATOS DIRECTOR
	* 
	* 
     */
    ?><H2>Datos Director</H2><?
    echo $form->input('dir_nombre',array('label'=>array('text'=>'Nombre y Apellido',
            'class'=>'input_label'),
    'class'=>'input_text_peque'));
    echo $form->input('dir_tipodoc_id',array('label'=>'Tipo de Documento',
    'options'=>$this->requestAction('/Tipodocs/dame_tipodocs'),
    'empty'=>array('Seleccionar')));
    echo $form->input('dir_nrodoc',array('label'=>array('text'=> 'Nº de Documento',
            'class'=>'input_label'),
    'class'=>'input_text_peque'
    ));
    echo $form->input('dir_telefono',array(	'label'=>array(	'text'=> 'Teléfono',
            'class'=>'input_label'),
    'class'=>'input_text_peque'
    ));
    echo $form->input('dir_mail',array('label'=>array(	'text'=> 'E-Mail',
            'class'=>'input_label'),
    'class'=>'input_text_peque'
    ));

    /******************************************************************************
	* 
	* 
	*    DATOS VICE DIRECTOR
	* 
	* 
     */
    ?><H2>Datos Vice Director</H2><?
    echo $form->input('vice_nombre',array('label'=>array(	'text'=> 'Nombre y Apellido',
            'class'=>'input_label'),
    'class'=>'input_text_peque'
    ));
    echo $form->input('vice_tipodoc_id',array('label'=>'Tipo de Documento',
    'options'=>$this->requestAction('/Tipodocs/dame_tipodocs'),
    'empty'=>'Seleccionar'));
    echo $form->input('vice_nrodoc',array('label'=>array(	'text'=> 'Nº de Documento',
            'class'=>'input_label'),
    'class'=>'input_text_peque'
    ));





    /****************************************************************************
	 *    
	 * 
	 * 
	 * 				DATOS ADICIONALES
	 * 
	 * 
     */
    ?><H2>Datos Adicionales</H2><?
    /**
     *    INGRESO/ACTUALIZACION
     */
    echo $form->input('actualizacion',array('label'=>array(	'text'=> 'Ingreso/Actualización',
            'class'=>'input_label'),
    'class'=>'input_text_peque'
    ));

    /**
     *    OBSERVACION
     */
    echo $form->input('observacion');
    //agrego esto para que no se puedan imprimir mas de 100 caracteres en el textarea
    ?>


    <?
    /**
     *    CICLOS ALTA Y MODIFICACION
     */
    $ciclos = $this->requestAction('/Ciclos/dame_ciclos');
    echo $form->input('ciclo_alta', array("type" => "select",
    "options" => $ciclos,'label'=>'Alta',
    "selected" => $this->data['Instit']['ciclo_alta']
    ));

    ?>
    <?php echo $form->end('Guardar');?>
</div>

