

<div class="instits form">
<h1>Depurador de Estructuras</h1>
<h2>Vamos que faltan sòlo <?php echo $cantFaltan?></h2>


<?php 
	echo $form->create('Depurador',array('url'=>'/depuradorPlanes/listado',
					'id'=>'estructura_plan'));

        echo $form->input('jurisdiccion_id', array(
            'empty'=>'Seleccione',
            'default'=>$jurisdiccion_id,
            'div'=>false));
      	
	echo $form->end('Buscar');
?> 


<h2>Instituciones a depurar</h2>


<?php foreach ($institsMal as $i):?>
<p>
    <?php        
        echo $html->link($i['Instit']['cue']*100+$i['Instit']['anexo']. " ::: ".$i['Instit']['nombre'], '/instits/view/'.$i['Instit']['id']);
    ?>

    <span>
        <?php
        echo $html->link('DEPURAR', '/depuradorPlanes/index/'.$i['Instit']['id']);
        ?>
    </span>
</p>
    

<?php endforeach;?>

        
</div>



