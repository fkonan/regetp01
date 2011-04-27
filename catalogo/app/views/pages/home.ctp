<div>
        
    <?php 
    
    $img = $html->image('home/titulos.png', array('width'=>'100%'));
    echo $html->link(
            $img, 
            array(
                'controller'=>'instits', 
                'action'=>'search',
            ), 
            array(
                'class' => 'grid_4 alpha',
                'escape' => false,
                'id' => 'titulo_btn',
            )
            );
    
    $img = $html->image('home/instituciones.png', array('width'=>'100%'));
    echo $html->link(
            $img, 
            array(
                'controller'=>'titulos', 
                'action'=>'search'
            ), 
            array(
                'class' => 'grid_4',
                'escape' => false,
                'id' => 'instit_btn',
            ));
    
    $img = $html->image('home/guisestudiante.png', array('width'=>'100%'));
    echo $html->link(
            $img, 
            array(
                'controller'=>'titulos', 
                'action'=>'search'
            ),
            array(
                'class' => 'grid_4 omega',
                'escape' => false, 
                'id' => 'guiaestudiante_btn',
            ));
?>

</div>

<div class="clear"></div>