<?php
/* SVN FILE: $Id: default.ctp 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Sistema Gestión de Registro - ');
			  echo Configure::read('regetpVersion')." - "; ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');
		echo $html->css('regetp','stylesheet', array('media'=>'screen'));
		//echo $html->css('printer');
		echo $html->css('printer','stylesheet', array('media'=>'print'));

                //echo $javascript->link('prototype');

		echo $javascript->link('jquery-1.4.2.min.js');
                echo $javascript->link('jquery.form.js');
                echo $javascript->link('jquery.tools.min.js');
                
		echo $scripts_for_layout;
	?>
        <script type="text/javascript">
        jQuery.noConflict();
        jQuery(document).ready(function () {
            jQuery("ul.menu_body li:even").addClass("alt");
            jQuery('#boxInstituciones .menu_body').show();
            <?php
            $showMenu = !($session->check('Auth.User') && ($session->read('Auth.User.role') != 'invitado'));
            if($showMenu){?>
                jQuery('.menu_body').show();
            <?php
            }
            ?>
            jQuery('.menu_head, .menu_head_open').click(function () {
                if(jQuery(this).hasClass('menu_head')){
                    jQuery(this).removeClass('menu_head').addClass('menu_head_open');
                    
                    // guarda en cookie para recordar
                    Set_Cookie( 'opened_tag', this.id, '', '/', '', '' );
                }else if(jQuery(this).hasClass('menu_head_open')){
                    jQuery(this).removeClass('menu_head_open').addClass('menu_head');

                    // si existe en cookie borra
                    if ( Get_Cookie( 'opened_tag' ) == this.id ) {
                        Delete_Cookie('opened_tag', '/', '');
                    }
                }
                jQuery('#' + this.id + ' ul.menu_body').slideToggle('medium');
            });
        });


        function openMenues() {
            var arrayOfDivs = document.getElementsByTagName('div');
            var howMany = arrayOfDivs.length;

            for (var i=0; i < howMany; i++) {
                var thisDiv = arrayOfDivs[i];
                var styleClassName = thisDiv.className.value;
                
                if (Get_Cookie( 'opened_tag' ) != null && Get_Cookie( 'opened_tag' ).toString() == thisDiv.id) {
                    //document.getElementById(thisDiv.id).className.value = 'menu_head_open';
                    jQuery('#' + thisDiv.id + ' h1').removeClass('menu_head').addClass('menu_head_open');
                    jQuery('#' + thisDiv.id + ' ul.menu_body').slideToggle('medium');
                }
            }
        }

        function borrarCookies() {
            // si existe en cookie borra
            if ( Get_Cookie( 'opened_tag' )) {
                Delete_Cookie('opened_tag', '/', '');
            }
        }


        function Set_Cookie( name, value, expires, path, domain, secure )
        {
            // set time, it's in milliseconds
            var today = new Date();
            today.setTime( today.getTime() );

            /*
            if the expires variable is set, make the correct
            expires time, the current script below will set
            it for x number of days, to make it for hours,
            delete * 24, for minutes, delete * 60 * 24
            */
            if ( expires )
            {
            expires = expires * 1000 * 60 * 60 * 24;
            }
            var expires_date = new Date( today.getTime() + (expires) );

            document.cookie = name + "=" +escape( value ) +
            ( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
            ( ( path ) ? ";path=" + path : "" ) +
            ( ( domain ) ? ";domain=" + domain : "" ) +
            ( ( secure ) ? ";secure" : "" );
        }

        function Get_Cookie( name ) {

            var start = document.cookie.indexOf( name + "=" );
            var len = start + name.length + 1;
            if ( ( !start ) &&
            ( name != document.cookie.substring( 0, name.length ) ) )
            {
            return null;
            }
            if ( start == -1 ) return null;
            var end = document.cookie.indexOf( ";", len );
            if ( end == -1 ) end = document.cookie.length;
            return unescape( document.cookie.substring( len, end ) );
        }

        // this deletes the cookie when called
        function Delete_Cookie( name, path, domain ) {
            if ( Get_Cookie( name ) ) document.cookie = name + "=" +
            ( ( path ) ? ";path=" + path : "") +
            ( ( domain ) ? ";domain=" + domain : "" ) +
            ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
        }

        </script>
	
</head>
    <body>
	<cake:nocache>	
	<? if ($_SERVER['HTTP_HOST']=='localhost'){?>
		<div style="background-color: red; height: 20px; text-align: center">MODO LOCALHOST</div>
	<? }?>
	</cake:nocache>
	
	<div id="container">	
		<?php $headerClass = (Configure::read('es_dia_patrio'))?"patrio":"";?>
		<div id="header" class="<?php echo $headerClass; ?>" >
			<h1>

				<?php echo $html->link(__('Registro Federal de Instituciones de Educación Técnico Profesional (RFIETP)', true), '/pages/home', array('class'=>'mainlink')); ?>
			</h1>
                    <?php
                    if ($session->check('Auth.User')) {
                    ?>
                    <div id="header_right">
                        <?php echo $html->link('<img src="'.$html->url("/img/editprofile.png").'" border="0" align="absmiddle" />','/users/self_user_edit/'.$session->read('Auth.User.id'), array('class'=>'userlinks'), false, false); ?> <?php echo $html->link('Mis datos','/users/self_user_edit/'.$session->read('Auth.User.id'), array('class'=>'userlinks'), false, false); ?> ·
                        <?php echo $html->link('<img src="'.$html->url("/img/changepassword.gif").'" border="0" align="absmiddle" />','/users/cambiar_password/'.$session->read('Auth.User.id'), array('class'=>'userlinks'), false, false); ?> <?php echo $html->link('Cambiar contraseña','/users/cambiar_password/'.$session->read('Auth.User.id'), array('class'=>'userlinks'), false, false); ?> ·
                        <?php echo $html->link('<img src="'.$html->url("/img/exit.gif").'" border="0" align="absmiddle" />','/users/logout', array('class'=>'userlinks'), false, false); ?> <?php echo $html->link('Salir','/users/logout', array('class'=>'userlinks', 'onclick'=>'javascript: borrarCookies();'), false, false); ?>
                    </div>
                    <? } ?>
		</div>
		<div id="content">
			<div id="menu">	
				
				<cake:nocache>	
				<?  echo $this->renderElement('boxSaludo'); ?>
                                </cake:nocache>
				<?  echo $this->renderElement('boxDesarrollo'); ?>
				<?  echo $this->renderElement('boxInstituciones'); ?>
                                <?  echo $this->renderElement('boxJurisdicciones'); ?>
				<?  echo $this->renderElement('boxCuadros'); ?>
				<?  echo $this->renderElement('boxInformacion'); ?>	
				<?  echo $this->renderElement('boxDepurador'); ?>
   
				<cake:nocache>					
				<?  echo $this->renderElement('boxTickets'); ?>
				</cake:nocache>
				
				<?  echo $this->renderElement('boxAdmin'); ?>	
				<?  echo $this->renderElement('boxLogin'); ?>
				
				
				<h1><?= __('Soporte Técnico')?></h1>
				<ul>
					<li><?= $html->link('Contacto','/pages/contacto'); ?></li>
				</ul>	
				           
			</div>
                    
                    <script type="text/javascript">openMenues();</script>
			
			
			<div id="cuerpo">
                            <div id="cuerpo_top">
                                <div id="cuerpo_top_left">
                                    <?  echo $this->renderElement('rutaUrl', array("ruta" => $rutaUrl_for_layout)); ?>
                                </div>
                                <!--<div id="cuerpo_top_right">
                                    <?php echo $html->link('<img src="editprofile.png" /> Mis datos','/users/self_user_edit/'.$session->read('Auth.User.id'), array('class'=>'userlinks')); ?> ·
                                    <?php echo $html->link('Cambiar contraseña','/users/cambiar_password/'.$session->read('Auth.User.id'), array('class'=>'userlinks')); ?> ·
                                    <?php echo $html->link('Salir','/users/logout', array('class'=>'userlinks')); ?>
                                </div>-->
                            </div>
                            <div>
				<?php $session->flash(); ?>
				<?php $session->flash('auth'); ?>
				<?php echo $content_for_layout; ?>
                            </div>
			</div>
		</div>
		
		
	</div>
        <div id="footer">
                <p style="float:left;color:#003d5c;font-size:8pt;padding-left:250px; padding-top:10px; vertical-align: middle;font-weight: bold" >Instituto Nacional de Educación Tecnológica</p>
                <?php echo $html->link(
                                $html->image('logoinet1.gif', array('style'=>'vertical-align:middle;width:70px;margin-right:10px','alt'=> __("Inet", true), 'border'=>"0")),
                                'http://www.cakephp.org/',
                                array('target'=>'_blank'), null, false
                        );
                ?>
        </div>
        <?php echo $html->link(
                        $html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0", 'style'=>'float:right;margin-right:130px')),
                        'http://www.cakephp.org/',
                        array('target'=>'_blank'), null, false
                );
        ?>
	<?php echo $cakeDebug; ?>
</body>
</html>