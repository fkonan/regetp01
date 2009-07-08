

<h1>Información Jurisdiccional</h1>


<div><!-- contenido de los datos de jurisdiccion -->

<?php 

  	echo $form->create('Jurisdicion');
  
  	echo $form->input('jurisdiccion_id',array('options'=>$jurisdicciones, 'empty'=>'Todas'));

  	echo $form->button('Informes por jurisdicción');
  	echo $form->button('Agregar fondo Jurisdiccional');
  	echo $form->button('Lineas de Accion');
  	echo $form->end();

?>

</div>
