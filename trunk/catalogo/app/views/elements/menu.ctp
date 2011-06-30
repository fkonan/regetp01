<ul id="menu" class="nav push_2 sf-menu grid_8">
        <li class="<?php echo ($this->here == $this->base.'/pages/home')?'current':''?> "><?php echo $html->link('Inicio', '/pages/home', array('class'=>'menu-item')); ?></li>


        <?php 
        $activo = false;
        if ($this->action == 'search' || $this->action == 'guiaDelEstudiante'){
            $activo = true;
        }
        ?>
        <li class="<?php echo ($activo)?'current':''?>">
            <a class='menu-item' href="#">Buscadores</a>
            <ul>
                <li>
                    <?php echo $html->link('Guía del Estudiante', array(
                                    'controller' => 'titulos',
                                    'action' => 'guiaDelEstudiante'
                    )) 
                        ?>
                </li>
                <li>
                    <?php echo $html->link('Títulos', array(
                                    'controller' => 'titulos',
                                    'action' => 'search'
                    )) 
                        ?>
                </li>
                <li>
                    <?php echo $html->link('Instituciones', array(
                                    'controller' => 'instits',
                                    'action' => 'search'
                    )) 
                        ?>
                </li>
                
            </ul>
        </li>

        <li class="<?php echo (strstr($this->here,$this->base.'/pages') && ($this->here != $this->base.'/pages/home'))?'current':''?> ">
            <?php echo $html->link('Documentación', array('controller'=>'pages', 'action'=>'introduccion'), array('class'=>'menu-item')); ?>
        </li>
        <li class="<?php echo (strstr($this->here,$this->base.'/correos/contacto'))?'current':''?>">
            <?php echo $html->link('Contacto', array(
                                                'controller' => 'correos',
                                                'action'    => 'contacto'),
                                                array('class'=>'menu-item'))?>
        </li>
</ul>


<script type="text/javascript">
    // menu hover dropdown
    $( function() {
            $("ul.nav").superfish();
            $("ul.nav").find('ul').bgIframe();
    } );
    
</script>