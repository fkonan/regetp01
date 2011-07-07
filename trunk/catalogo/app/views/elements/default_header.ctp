

<div id="header">
    <div class="header_wrapper">
        <div id="header_title" class="container_12">

            <a href="<?php echo $html->url('/')?>"class="no-print grid_3">
                <?php echo $html->image('../css/img/logo.png', array(
                    'border'=> 0,
                    'class' => '',
                    'style' => 'float: left',
                    )); 
                ?>
            </a>


            <h1 class="grid_6">
                &nbsp;<?php echo $html->link(__('Catálogo Nacional de Títulos y Certificaciones de Educación Técnico Profesional', true), '/pages/home', array('class' => '')); ?>
            </h1>

        </div>
    </div>


    <div class="menu_wrapper no-print"  style="z-index: 1; ">
        <div class="container_12">
            <?php echo $this->element('menu');?>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="clear"></div>