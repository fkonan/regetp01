<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->charset(); ?>
        <title>
            <?php __('Depurador de Planes'); ?>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $html->meta('icon');
        echo $html->css('depurador_planes','stylesheet', array('media'=>'screen'));
        ?>
    </head>
<body>
    <h1>Depurador de Planes</h1>

    <div id="datos_instit">
        <div class="dato_instit"><label>Institución:</label> <?=$instit['Instit']['nombre_completo']?></div>
        <div class="dato_instit"><label>Jurisdicción:</label> <?=$instit['Jurisdiccion']['name']?></div>
    </div>

    <div id="cuerpo">

        <div id="col_izq">

            <div class="row_header"></div>

            <?php
            foreach ($instit['Plan'] as $plan) {
            ?>
            <div class="planes_izq">
                <?=$plan['nombre']?><br />
                <?php echo $form->input('estructura_id', array('options'=>$estructuras,'label'=>'')); ?>
                <!--<select><option>EGB3</option></select>-->
            </div>
            <?php } ?>
        </div>
        <!-- pantalla principal -->
        
        <div id="col_der">

            <div class="row_header">
                <?php
                for ($i=2006; $i <= date('Y'); $i++) {
                ?>
                <div class="ciclo"><?=$i?></div>
                <?php } ?>
            </div>

            <?php
            //debug($instit['Plan']);
            foreach ($instit['Plan'] as $plan) {
            ?>
            <div class="planes_der">
                <?php
                if (!empty($plan['Anio'])) {
                    for ($i=2006; $i <= date('Y'); $i++) {
                        $anios = null;
                        foreach($plan['Anio'] as $anio) {
                            if ($anio['ciclo_id'] == $i) {
                                $anios[] = $anio;
                            }
                        }
                        //debug($anios);
                ?>
                        <div class="col_ciclos">
                            <?php echo $this->element('graficadorPlan',array('anios'=>$anios,'depurado'=>true));?>
                        </div>
                <?php }
                } ?>
            </div>
            <?php } ?> 
            
        </div>
    </div>
</body>
</html>
