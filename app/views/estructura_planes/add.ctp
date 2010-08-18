<?php echo $javascript->link('jsonlib.js'); ?>
<?php echo $javascript->link('jquery.blockUI.js'); ?>
<script type="text/javascript">
var etapas = new Array();

function EtapaAdd() {
    var i = etapas.length;
    // guarda la etapa
    //etapas[i] = new Array('etapa_id','edad_teorica','nro_anio','anio_escolaridad');
    etapas[i] = { etapa_id: jQuery("#etapa_id").val(),
                  etapa_nombre: escape(jQuery('#etapa_id :selected').text()),
                  edad_teorica: jQuery("#edad_teorica").val(),
                  nro_anio: jQuery("#nro_anio").val(),
                  anio_escolaridad: jQuery("#anio_escolaridad").val() };

    // agrega al arbol de etapas
    jQuery("#etapas-tree").append("<li>"+unescape(etapas[i]['etapa_nombre'])+" "+etapas[i]['nro_anio']+"</li>");

    // resetea el form
    jQuery("#edad_teorica").val('');
    jQuery("#nro_anio").val('');
    jQuery("#anio_escolaridad").val('');

    // traba etapa
    //jQuery('#bloqueable').block({ message: null });
}

function sortfcn(a,b){
     if(parseInt(a[0])<parseInt(b[0])){
        return -1;
     }
     else if(parseInt(a[0])>parseInt(b[0])){
        return 1;
     }
     else{
        return 0;
     }
}

function EtapaAddObject(etapa) {
    var i = etapas.length;
    // guarda la etapa
    //etapas[i] = new Array('etapa_id','edad_teorica','nro_anio','anio_escolaridad');
    etapas[i] = { etapa_id: etapa.etapa_id,
                  etapa_nombre: unescape(etapa.etapa_nombre),
                  edad_teorica: etapa.edad_teorica,
                  nro_anio: etapa.nro_anio,
                  anio_escolaridad: etapa.anio_escolaridad };

    // agrega al arbol de etapas
    jQuery("#etapas-tree").append("<li>"+etapas[i]['etapa_nombre']+" "+etapas[i]['nro_anio']+"</li>");
}

function EtapasASubmit() {
    // pasa vector etapas para submitear
    jQuery("#etapas").val(array2dToJson(etapas, 'object'));

    return true;
}
</script>
<div class="estructuraplanes form">
<?php echo $form->create('EstructuraPlan', array('onsubmit'=>'return EtapasASubmit();'));?>
	<fieldset>
 		<legend><?php __('Crear EstructuraPlan');?></legend>
	<?php
		echo $form->input('name');
        ?>
        <div id="bloqueable">
        <?php
                echo $form->input('etapa_id', array('id'=>'etapa_id'));
	?>
        </div>
                <br>
        <b>Agregar años</b>
        <br>
        <div id="etapa_1">
        <?php
            echo $form->input('edad_teorica', array('id'=>'edad_teorica', 'label'=>'Edad teórica', 'maxlength'=>2, 'size'=>2, 'style'=>'width: 18px;', 'div' => false));
            echo $form->input('nro_anio', array('id'=>'nro_anio', 'label'=>'Año', 'maxlength'=>2, 'size'=>2, 'style'=>'width: 18px;', 'div' => false));
            echo $form->input('anio_escolaridad', array('id'=>'anio_escolaridad', 'label'=>'Año escolaridad', 'maxlength'=>2, 'size'=>2, 'style'=>'width: 18px;', 'div' => false));

            echo $form->button('Agregar año', array('id'=>'add', 'onclick'=>'Javascript: EtapaAdd();'));
	?>
        </div>
	</fieldset>
    <ul id="etapas-tree">
    </ul>
<br />
<br />
<?php
echo $form->input('etapas', array('id'=>'etapas', 'type'=>'hidden'));
echo $form->end('Guardar');
?>
</div>
<br />
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List estructuras de planes', true), array('action'=>'index'));?></li>
	</ul>
</div>
<script type="text/javascript">
<?php
if (strlen($this->data['EstructuraPlan']['etapas']) > 3) {
        ?>
            var jsonStr = '<?=$this->data['EstructuraPlan']['etapas']?>';
            var json_data_object = eval("(" + jsonStr + ")");
            for (var i = 0; i < json_data_object.length; i++) {
                EtapaAddObject(json_data_object[i]);
            }
        <?php
}
?>
</script>