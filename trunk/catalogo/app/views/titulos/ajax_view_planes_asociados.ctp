<?php
    echo $paginator->counter(array(
    'format' => __('Instituciones %start%-%end% de <strong>%count%</strong>', true)
    ));

    $paginator->options(array(
        'url'     => $this->passedArgs,
        'update'  => 'tituloPlanes',
        'indicator' => 'spinner',
        ));

    $i = 0;
    if (!empty($planes)) {
    ?>
<table cellspacing="0" cellpadding="1">
        <thead>
        <th><?php echo $paginator->sort('Institución','Plan.instit_id');?></th>
        <th><?php echo $paginator->sort('Localidad','Instit.localidad_id');?></th>
        <th><?php echo $paginator->sort('Departamento','Instit.departamento_id');?></th>
        <th><?php echo $paginator->sort('Jurisdicción','Instit.jurisdiccion_id');?></th>
        </thead>
        <?php
        foreach ($planes as $plan) {
            $class = '';
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
        ?>
        <tr>
            <td style="text-align:left; vertical-align: middle;"><?php echo $html->link($plan['Instit']['nombre_completo'], array('controller'=>'Instits', 'action'=>'view', $plan['Instit']['id'])); ?></td>
            <td style="text-align:left; vertical-align: middle;"><?php echo $plan['Instit']['Localidad']['name']; ?></td>
            <td style="text-align:left; vertical-align: middle;"><?php echo $plan['Instit']['Departamento']['name']; ?></td>
            <td style="text-align:left; vertical-align: middle;"><?php echo $plan['Instit']['Jurisdiccion']['name']; ?></td>
        </tr>
        <tr><td colspan="4" style="border-bottom:1px solid #CCCCCC;"></td></tr>
        <?php
        }
        ?>
    </table>
    <?php
    }
    ?>
    <div class="paginator_prev_next_links">
            <?php
            if($paginator->numbers()){
                    echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled', 'tag' => 'span'));
                    echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
                    echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
            }
            ?>
    </div>

    <div id="spinner" style="display: none; text-align: center; margin-top:10px;">
    <?php
    echo $html->image('loadercircle16x16.gif')
    ?>
    </div>