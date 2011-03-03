<?php
    $paginator->options(array(
        'url'     => $this->passedArgs,//array('controller'=>'titulos', 'action'=>'view', $titulo['Titulo']['id']),
        'update'  => 'tituloPlanes',
        'indicator' => 'spinner',
        ));

    $i = 0;
    if (!empty($planes)) {
    ?>
    <table>
        <th>Plan</th>
        <th>Institución</th>
        <th>Jurisdicción</th>
        <?php
        foreach ($planes as $plan) {
            $class = '';
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
        ?>
        <tr>
            <td style="text-align:left;"><?php echo $plan['Plan']['nombre']; ?></td>
            <td style="text-align:left;"><?php echo $html->link($plan['Instit']['nombre_completo'], array('controller'=>'Instits', 'action'=>'view', $plan['Instit']['id'])); ?></td>
            <td style="text-align:left;"><?php echo $plan['Instit']['Jurisdiccion']['name']; ?></td>
        </tr>
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
                    echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled'));
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