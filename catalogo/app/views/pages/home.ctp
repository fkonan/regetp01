<div>
        
    <?php 
    
    $img = $html->image('home/titulos.png', array('class'=>'grid_2 alpha'));
    $div = '<div style="color: blue" class="grid_2 omega">Aqui puede encontrar los titulos y certificados nacionales y blah blah bla</div>';
    echo $html->link(
            $img . $div, 
            array(
                'controller'=>'titulos',
                'action'=>'search',
            ), 
            array(
                'class' => 'grid_4 alpha',
                'escape' => false,
                'id' => 'titulo_btn',
            )
            );
    
    
    $img = $html->image('home/instituciones.png', array('class'=>'grid_2 alpha'));
    $div = '<div style="color: green" class="grid_2 omega">Aqui puede encontrar las instituciones ingresadas en el Registro Nacional de Educación Técnica Nacional.</div>';
    echo $html->link(
            $img . $div, 
            array(
                'controller'=>'instits',
                'action'=>'search_form'
            ), 
            array(
                'class' => 'grid_4',
                'escape' => false,
                'id' => 'instit_btn',
            ));
    
    $img = $html->image('home/guiaestudiante.png', array('class'=>'grid_2 alpha'));
    $div = '<div  style="color: #A49B35" class="grid_2 omega">Puede encontrar facilmente una institucion donde estudiar y blah blah blah.</div>';
    echo $html->link(
            $img . $div, 
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

<div style="text-align: justify">
    <h2 style="text-align: center">Lorem ipsum dolor sit amet</h2>
    <p class="prefix_2 grid_4">Curabitur in nisi justo, non bibendum diam. Pellentesque viverra tincidunt arcu, auctor volutpat tellus tincidunt sed. Aliquam ligula sem, porttitor vitae iaculis non, pretium eu diam. Vestibulum suscipit neque sed tellus ullamcorper id faucibus est rutrum. In lobortis, est et malesuada viverra, dui risus hendrerit arcu, ac congue mi quam sit amet justo. Duis eget risus eu felis dignissim pretium sit amet dignissim eros. Nullam et nisl eros, at dapibus magna. Integer posuere, nulla ut aliquam mollis, dui dolor auctor lectus, eget volutpat ante arcu a felis. Cras gravida, tortor in luctus laoreet, leo massa feugiat est, non dignissim odio diam eu elit. Cras nisi augue, viverra vitae accumsan vitae, aliquet vitae lacus. Ut ipsum mauris, aliquam quis pretium sit amet, tempus a quam. Phasellus turpis ligula, semper et tempus nec, luctus vel mi. Vivamus sed dui sit amet erat condimentum bibendum lacinia non turpis. Nulla porta eleifend vehicula. Ut volutpat neque non nisi faucibus sed sollicitudin augue tincidunt. Pellentesque posuere, diam vel faucibus lacinia, ligula diam gravida nunc, non aliquam tortor enim nec sem. Phasellus viverra mattis arcu, vitae ultrices arcu rutrum sit amet. Nam feugiat nibh feugiat nisi ullamcorper egestas.</p>
    <p class="grid_4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed tempus lacus. Duis tellus ante, vehicula eget rhoncus a, tincidunt in purus. Aenean euismod suscipit dui a accumsan. Suspendisse potenti. Donec eget libero nulla. Nunc a neque a purus aliquet rhoncus at sit amet lectus. Praesent urna velit, volutpat vitae mollis eget, viverra eu ligula. Morbi ultricies egestas pretium. Curabitur eget nulla augue, eget scelerisque dui. Suspendisse tincidunt tortor quis odio suscipit et convallis ante accumsan. Nunc dolor nisl, tristique id dapibus id, dapibus nec odio. Morbi laoreet, nibh vel suscipit varius, lacus metus mattis felis, id faucibus urna risus id elit.</p>
</div>

<div class="clear"></div>
