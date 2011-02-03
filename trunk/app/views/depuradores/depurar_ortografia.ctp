<?php
echo $javascript->link(array('activespell/cpaint/cpaint2.inc.compressed.js', 'activespell/js/spell_checker'));
echo $html->css(array('spell_checker.css'));
?>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page% de %pages% (%count% sugerencias en total)', true)
));
?>
</p>
<div class="ortografia form">
<?php echo $form->create('Plan');?>
    <table cellpadding="0" cellspacing="0" style="font-size:9pt;">
        <tr>
                <th><?php echo $paginator->sort('name');?></th>
        </tr>
    <?php
        foreach ($tipoinstits as $tipoinstit) {
            ?>
        <tr>
            <td>
            <?php
            echo $form->input('tipoinstit_name_'.$tipoinstit['Tipoinstit']['id'],
                    array(  'value' => $tipoinstit['Tipoinstit']['name'],
                            'label' => false,
                            'title' => 'spellcheck_icons',
                            'style' => 'width: 85%; clear: none;',
                            'accesskey' => $html->url('/js/activespell/').'spell_checker.php'
                    ));
            ?>
            </td>
        </tr>
            <?php
        }

        echo $form->end(null);
    ?>
    </table>
</div>
<div>
<?php
echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));
echo $paginator->numbers(array('modulus'=>13));
echo $paginator->next(__('Siguiente', true).' >>', array('style'=>'float:right;'), null, array('class'=>'disabled'));
?>
</div>