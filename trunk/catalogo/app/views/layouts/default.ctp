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
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'></link>
        <title>
            <?php __('Catálogo Nacional de Títulos y Certificados');
            echo Configure::read('version')." - "; ?>
            <?php echo $title_for_layout; ?>
        </title>
        <script type="text/javascript">
        // Edit to suit your needs.
        var ADAPT_CONFIG = {
          // Where is your CSS?
          path: "<?php echo $html->url('/css/adapt/'); ?>",

          // false = Only run once, when page first loads.
          // true = Change on window resize and page tilt.
          dynamic: true,

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
        echo $html->css('adapt/mobile.min','stylesheet', array('media'=>'mobile'));
        echo $html->css('adapt/master');
        echo $html->css('jquery.tooltip','stylesheet');
        echo $html->css('catalogo','stylesheet', array('media'=>'screen'));
        echo $html->css('printer','stylesheet', array('media'=>'print'));

        echo $javascript->link(array(
        'jquery-1.5.2.min',
        'adapt.min.js',
        'jquery.form',
        'jquery.tools.min',
        ));

        $jsPoner = 'views'.DS.Inflector::underscore($this->name).DS.$this->action;
        $jsView = WWW_ROOT.'js'.DS.$jsPoner;
        if (file_exists($jsView.'.js')) {
             echo $javascript->link($jsPoner);
        }


        echo $scripts_for_layout;

        ?>
        <!--[if IE 7]>
        <style type="text/css">
            .horizontal-shadetabs a {
                display: block;
                height: 28px;
            }
        </style>
        <![endif]-->

        <!--[if IE 6]>
        <?php echo $html->css('ie6fix');?>
        <![endif]--> 
    </head>


    <body>
        
        <div id="header">
            <div id="header_images">
                <?php
                    //echo $html->image('header_ministerio.png', array('id'=>'header_ministerio'));
                    echo $html->image('header_inet.png', array('id'=>'header_inet'));
                ?>
            </div>
            <h1>
                <?php echo $html->link(__('Catálogo Nacional de Títulos y Certificados', true), '/pages/home', array('class'=>'mainlink')); ?>
            </h1>
            <ul id="menu">
                <li><a href="">menu1</a></li>
                <li><a href="">menu1</a></li>
                <li><a href="">menu1</a></li>
                <li><a href="">menu1</a></li>
                <li><a href="">menu1</a></li>
            </ul>
        </div>
        <div id="container" class ="container_12 clearfix">
            <div id="content" class="grid_12">
                <div id="cuerpo_top">
                        <div id="cuerpo_top_left">
                            <? //  echo $this->renderElement('rutaUrl', array("ruta" => $rutaUrl_for_layout)); ?>
                        </div>
                </div>
                
                <div id="cuerpo">
                        <?php $session->flash(); ?>
                        <?php $session->flash('auth'); ?>
                        <?php echo $content_for_layout; ?>
                </div>

            </div> <!-- FIN div #content -->
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

        <?php echo $html->link(
                $html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0", 'style'=>'float:right;margin-right:130px')),
                'http://www.cakephp.org/',
                array(
                    'target'=>'_blank',
                    'id'=>'logo-cake-php'),
                null,
                false
        ); ?>

        <?php echo $cakeDebug; ?>
    </body>

</html>
