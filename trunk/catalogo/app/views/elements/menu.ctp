<ul class="nav grid_8 alpha prefix_1 sf-menu">
        <li class="<?php echo ($this->here == $this->base.'/pages/home')?'current':''?> "><?php echo $html->link('Inicio', '/pages/home', array('class'=>'menu-item')); ?></li>


        <?php 
        $activo = false;
        if ($this->action == 'search' || $this->action == 'search_form' || $this->action == 'guiaDelEstudiante'){
            $activo = true;
        }
        ?>
        <li class="<?php echo ($activo)?'current':''?>">
            <a class='menu-item' href="">Buscadores</a>
            <ul>
                <li>
                    <?php echo $html->link('Guía del Estudiante', array(
                                    'controller' => 'titulos',
                                    'action' => 'guiaDelEstudiante'
                    )) 
                        ?>
                </li>
                <li>
                    <?php echo $html->link('Instituciones', array(
                                    'controller' => 'instits',
                                    'action' => 'search_form'
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