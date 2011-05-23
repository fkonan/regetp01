<div class="grid_6 alpha">
    <h4>Títulos</h4>
    <?php echo $form->input('Titulo.tituloName') ?>
    <?php echo $form->input('Titulo.oferta_id', array('empty' => 'Todas')); ?>
    <?php echo $form->input('Titulo.sector_id', array('options'=>$sectores, 'multiple'=>true)) ?>
</div>
<div class="grid_6 omega">
    <h4>Ubicación</h4>
    <?php echo $form->input('Instit.jurisdiccion_id', array('options'=>$jurisdicciones, 'empty' => 'Todas')) ?>
    <?php echo $form->input('Instit.departamento_id', array('type'=>'select')) ?>
    <?php echo $form->input('Instit.localidad_id', array('type'=>'select')) ?>
</div>