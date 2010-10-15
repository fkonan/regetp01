<div id="tabs-1">
        <h2>Sec. Tec. (Ajax)</h2>
        Info:
        <ul>
            <li>Instit: <?php echo $instit_id?></li>
            <li>Oferta: <?php echo $oferta_id?></li>
            <li>Ciclo: <?php echo $ciclo?></li>
        </ul>
        Planes:
        <ul>
        <?php
        foreach($planes as $plan){
        ?>
            <li><?php echo $plan['Plan']['nombre']?> - <?php echo $plan['EstructuraPlan']['Etapa']['name']?></li>
        <?
        }
        ?>
        </ul>
</div>