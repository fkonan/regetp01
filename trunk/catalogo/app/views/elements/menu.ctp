
<ul id="menu" class="nav sf-menu">
        <li class="<?php echo ($this->here == $this->base.'/pages/home')?'current':''?> "><?php echo $html->link('Inicio', '/pages/home', array('class'=>'menu-item')); ?></li>


        <?php 
        $activo = false;
        if ($this->action == 'search' || $this->action == 'guiaDelEstudiante'){
            $activo = true;
        }
        ?>
        <li class="<?php echo ($activo)?'current':''?>">
            <?php echo $html->link('Buscadores', array('controller'=>'pages', 'action'=>'buscadores'), array('class'=>'menu-item')); ?>
        </li>

        <li class="<?php echo ($this->here == $this->base.'/pages/doc_index')?'current':''?> ">
            <?php echo $html->link('Documentación', array('controller'=>'pages', 'action'=>'doc_index'), array('class'=>'menu-item')); ?>
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