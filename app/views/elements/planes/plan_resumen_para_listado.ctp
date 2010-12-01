<?php

$class; // si es par o impar: coloca el altow
$ciclo; // si quiero ver TODOS me muestra el ciclo_lectivo de ultima actualizacion
$plan; // array del modelo Plan



if (!empty($plan['Plan'])) {
    $plan += $plan['Plan'];
}
?>

<div class="plan_item <?php echo $class?>">
    <div class="plan_title">
        <span class="plan_mas_info btn-ir">
        <?php
        echo $html->link("más info",array('controller'=> 'planes', 'action'=>'view', $plan['id']), array(
            'title'=>'Ver mas información del plan',
            'class'=>'',
            ));
        ?>
        </span>

        <?php
        echo $html->link($plan['nombre'],array(
            'action'=>'view', $plan['id']),array('class'=>'title')
                );
        ?>        
    </div>
    
    
    <div>
        <span class="plan_matricula_info">
            Matrícula: <?php echo empty($plan['matricula'])?"<span>0</span>":$plan['matricula']; ?>
        </span>
        <?php if(!empty($ciclo)) { ?>
        <span class="plan_anio">
                <?php 
                echo (!empty($ciclo)? "(".$ciclo.")":"") ;
                ?>
        </span>
        <?php
        }
        ?>
        <span class="plan_sector_info">
            Sector:
            <span class="plan_sector_name">
                <?php
                $sectores = "";
                $sectores_id = "";

                foreach($plan['Titulo']['Sector'] as $sector){
                    $sectores = $sectores . $sector['name'] . "/";
                    $sectores_id = $sectores_id . $sector['id'] . ",";
                }

                $sectores = substr($sectores, 0, strlen($sectores) - 1);
                $sectores_id = substr($sectores_id, 0, strlen($sectores_id) - 1);
                
                ?>
                <?php echo $sectores;?>
            </span>
        </span>
    </div>
    <input class="plan_sector" type="hidden" value="<?php echo $sectores_id;?>"/>
    <input class="plan_ciclo" type="hidden" value="<?php echo empty($plan['Anio'][0]['ciclo_id'])?0:$plan['Anio'][0]['ciclo_id'] ?>"/>
</div>
