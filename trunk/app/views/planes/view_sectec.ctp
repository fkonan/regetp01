<div id="tabs-1">
        
        <?php
        foreach($planes as $plan){
        ?>
        <h1><?php echo $plan['EstructuraPlan']['Etapa']['name']?> - <?php echo $plan['Plan']['nombre']?></h1>
        
        

        <table border="2" cellpadding="2" cellspacing="0">
            <tr>
                <th>Año</th>
                <th>Matrícula</th>
                <th>Secciones</th>
                <th>Horas Taller</th>
            </tr>
            <?php
            foreach($plan['Anio'] as $anio){
            ?>
            <tr>
                <td><?php echo $anio['EstructuraPlanesAnio']['nro_anio']?></td>
                <td><?php echo $anio['matricula']?></td>
                <td><?php echo $anio['secciones']?></td>
                <td><?php echo $anio['hs_taller']?></td>
            </tr>
            <?php
            }?>
         </table>
        <?php
        }
        ?>
        
</div>