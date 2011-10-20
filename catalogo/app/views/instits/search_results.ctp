<?php
echo $html->css('catalogo.instits', false);
echo $html->css('catalogo.advanced_search', false);

$paginator->options(array(
    'url'     => $this->passedArgs,
    'update'  => 'search_results',
    'indicator' => 'spinner',
));
?>
    

<dl class="criterios_busq">
        <?
        foreach ($conditions as $key => $value) {
            ?><dt><?
            echo '- ' . $key . ': ';
            ?></dt><?
            ?><dd><?
            echo $value . "&nbsp";
            ?></dd><?
        }
        ?>
            </dl>


    <div class="list-header">
        <div class="paging">
            <?php echo $paginator->counter(array(
            'format' => __('Mostrando instituciones %start%-%end% de <strong>%count%</strong>', true))); ?>
        </div>
        <div class="clear"></div>
    </div>
    <? if (!empty($instits) > 0) { ?>
        <ul id="items" class="items">
        <?php foreach($instits as $plan) : 
        if (!empty($plan['Instit'])) {
            $año_actual = date("Y");
            $fecha_hasta = "$año_actual-07-21"; //hasta julio
            $fecha_desde = "$año_actual-01-01"; //desde enero
            $clase = '';
            if($plan['Instit']['activo']) {
            $clase .= ' escuela_activa';
            }else {
            $clase .= ' escuela_inactiva';
            }
            ?>
            <li>
                <a href="<?php echo $html->url(array(
                                        'controller' => 'instits',
                                        'action' => 'view',
                                        'id' => $plan['Instit']['id'],
                                        'slug' => slug($plan['Instit']['nombre_completo'])))
                        ?>" 
                        class="linkconatiner-more-info">

                    <span class="items-nombre">
                        <?= "".($plan['Instit']['cue']*100)+$plan['Instit']['anexo']." - ". $plan['Instit']['nombre_completo']; ?>

                        <br />
                        <span class="items-gestion"><?= $plan['Gestion']['name'] ?></span>
                        <span class="items-domicilio">
                        &nbsp;-
                        Domicilio:
                            <?php
                            echo joinNotNull(", ", array($plan['Instit']['direccion'],$plan['Instit']['lugar'],
                            $plan['Localidad']['name'],
                            $plan['Departamento']['name'] == $plan['Localidad']['name']?null:$plan['Departamento']['name'],
                            $plan['Jurisdiccion']['name']));
                            ?>
                        </span>
                    </span>                

                </a>
            </li>
        <? 
        } 
        endforeach
        ?>
    </ul>        
    
    <?php
    }
    else {
        ?>
    <div id="no_results">No hay resultados</div>
    <?php
    }
    
    if ($paginator->numbers()) {
    ?>
    <div style="text-align:center; display:block;margin: 10px 0 10px 0">
        <?php
        echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled', 'tag' => 'span'));
        echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
        echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
        ?>
        <div id="spinner" style="display:none; padding-left:10px;"><?php echo $html->image('ajax-loader.gif')?></div>
    </div>
    <?php  } ?>
<script type="text/javascript">
    $(".autosubmit").change(function() {
        $('#InstitsForm').submit();
    });
</script>