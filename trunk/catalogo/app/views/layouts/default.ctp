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
        echo $html->css('catalogo','stylesheet', array('media'=>'screen'));
        echo $html->css('printer','stylesheet', array('media'=>'print'));
        echo $html->css('adapt/mobile.min','stylesheet', array('media'=>'mobile'));
        echo $html->css('adapt/master');

        echo $javascript->link(array(
        'jquery-1.5.2.min',
        'adapt.min.js',
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
        <div id="container" class="container_12 clearfix">
            <div id="header" class="grid_12">
                <h1>
                    <?php echo $html->link(__('Catálogo Nacional de Títulos y Certificados', true), '/pages/home', array('class'=>'mainlink')); ?>
                </h1>
            </div>

            <div id="content" class="grid_7">

                <div id="menu">
                </div>

                <div id="cuerpo">
                    <div id="cuerpo_top">
                        <div id="cuerpo_top_left">
                            <? //  echo $this->renderElement('rutaUrl', array("ruta" => $rutaUrl_for_layout)); ?>
                        </div>
                    </div>
                    <div id="main-content">
                        <?php $session->flash(); ?>
                        <?php $session->flash('auth'); ?>
                        <?php echo $content_for_layout; ?>
                    </div>
                </div>

            </div> <!-- FIN div #content -->

            <div id="footer" class="grid_12">
                <?php echo $html->image('ministerioeduc_logo.png', array(
                                    'style'=>'vertical-align:middle;margin-left:5px; float:left;',
                                    'alt'=> __("Ministerio de Educación de la Nación", true),
                                    'border'=>"0",
                                    )
                      );
                ?>
                <p style="float:left;color:#003d5c;font-size:8pt;padding-left:110px; padding-top:10px; vertical-align: middle;font-weight: bold" >Instituto Nacional de Educación Tecnológica</p>
                <?php echo $html->link(
                            $html->image('logoinet1.gif', array(
                                    'style'=>'vertical-align:middle;width:70px;margin-right:10px',
                                    'alt'=> __("Inet", true),
                                    'border'=>"0"
                                    )),
                            'http://www.inet.edu.ar',
                            array(
                                'target'=>'_blank'),
                            null,
                            false
                    );
                ?>
            </div>

       </div> <!-- FIN div #container -->

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