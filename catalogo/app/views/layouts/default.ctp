<?php

header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0"); // // HTTP/1.1
header("Pragma: no-cache");
header("Expires: Mon, 17 Dec 2007 00:00:00 GMT"); // Date in the past

/* @var $html HtmlHelper */
$html;
/* @var $javascript JavascriptHelper */
$javascript;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->charset(); ?>

        <title>
            <?php __('Catálogo Nacional de Títulos y Certificados');
            echo Configure::read('version')." - "; ?>
            <?php echo $title_for_layout; ?>
        </title>
        
        <script type="text/javascript">
            
        // URL global que apunta al path de mi sitio, sirve para hacer llamadas
        // ajax a controlador/action sin problema utilizando:
        // urlDomain+'controlador/action'
        var urlDomain = "<?php echo $this->base?>";
            
            
        // Edit to suit your needs.
        var ADAPT_CONFIG = {
          // Where is your CSS?
          path: "<?php echo $html->url('/css/adapt/'); ?>",

          // false = Only run once, when page first loads.
          // true = Change on window resize and page tilt.
          dynamic: false,

          // First range entry is the minimum.
          // Last range entry is the maximum.
          // Separate ranges by "to" keyword.
          range: [
            '760px            = mobile.min.css',
            '760px  to 980px  = 720.min.css',
            '980px  to 1280px = 960.min.css',
            '1280px to 1600px = 1200.min.css',
            '1600px to 1920px = 1560.min.css',
            '1920px           = fluid.min.css'
          ]
        };
        </script>
        <?php
        echo $html->meta('icon');
        
        //echo $html->css('adapt/mobile.min','stylesheet', array('media'=>'mobile'));
        //echo $html->css('adapt/master');
        echo $html->css('jquery.tooltip','stylesheet');
        echo $html->css('catalogo','stylesheet', array('media'=>'screen'));
        echo $html->css('catalogo.menu','stylesheet');
        echo $html->css('ui-redmond/jquery-ui-1.8.12.custom');
        echo $html->css('printer','stylesheet', array('media'=>'print'));

        echo $javascript->link(array(
        'jquery-1.5.2.min',
        'adapt.min.js',
        'jquery.form',
        'jquery.tools.min',
        'jquery-ui-1.8.12.custom.min',
        ));

        $jsPoner = 'views'.DS.Inflector::underscore($this->name).DS.$this->action;
        $jsView = WWW_ROOT.'js'.DS.$jsPoner;
        if (file_exists($jsView.'.js')) {
             echo $javascript->link($jsPoner);
        }

        echo $scripts_for_layout;

        ?>
    </head>
    <body>
        
    
        
    <div class="wrapper">
        <div id="header">
            <div id="header_title" class="container_12">
                
                <div class="grid_3">
                <?php
                    //echo $html->image('header_ministerio.png', array('id'=>'header_ministerio'));
                    echo $html->image('logoinettrans.png');
                ?>
                </div>
                
                <h1 class="grid_9">
                    <?php echo $html->link(__('Catálogo Nacional de Títulos y Certificados', true), '/pages/home'); ?>
                </h1>
                
                <div class="clear"></div>
                
                
                <ul id="nav" class="container_12">
                    <li class="grid_3 current"><?php echo $html->link('Inicio', '/pages/home'); ?></li>
                    <li class="grid_3"><a href="">Buscadores</a></li>
                    <li class="grid_3">
                        <?php echo $html->link('Biblioteca', array('controller'=>'bibliotecas', 'action'=>'index')); ?>
                        <ul>
                            <li><a href="#1">Marco de Referencias</a></li>
                            <li><a href="#2">Foros Sectoriales</a></li>
                            <li><a href="#2">Cara de Bragueta</a></li>
                            <li>
                                <a href="#2">Ocatarinetabelachitchix</a>
                                <ul>
                                    <li><a href="#">Màs Magia baby</a></li>
                                    <li><a href="#">Màs Magia baby</a></li>
                                </ul>
                            </li>

			</ul>

                    </li>
                    <li class="grid_3"><a href="">Contacto</a></li>
                </ul>
                
            </div>         
            
        </div>
        
        
       <div id="container" class ="container_12">
                        <?php $session->flash(); ?>
                        <?php $session->flash('auth'); ?>
           
                        <?php echo $content_for_layout; ?>           
       </div> <!-- FIN div #container -->
       
       <div id="logos">
        <?php
            echo $html->link($html->image('links/logo_encuentro.png'),'http://www.encuentro.gov.ar/',null, null, false);
            echo $html->link($html->image('links/logo_pakapaka.png'),'http://www.pakapaka.gov.ar/',null, null, false);
            echo $html->link($html->image('links/logo_educar.png'),'http://www.educ.ar/',null, null, false);
            echo $html->link($html->image('links/logo_inet.png'),'http://www.inet.edu.ar/',null, null, false);
            echo $html->link($html->image('links/logo_infd.png'),'http://www.me.gov.ar/infod/',null, null, false);
            echo $html->link($html->image('links/logo_bndm.png'),'http://www.bnm.me.gov.ar/',null, null, false);
            echo $html->link($html->image('links/logo_mercosur.png'),'http://www.sic.inep.gov.br/',null, null, false);
            echo $html->link($html->image('links/logo_bicentenario.png'),'http://www.bicentenario.argentina.ar/',null, null, false);
            echo $html->link($html->image('links/logo_argentina.png'),'http://www.argentina.ar/',null, null, false);
            echo $html->link($html->image('links/logo_argentinagovar.png'),'http://www.argentina.gov.ar/',null, null, false);
        ?>
       </div>

        <?php echo $cakeDebug; ?>
    </div>
    </body>

</html>
