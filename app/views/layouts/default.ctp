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
		
		echo $javascript->link('prototype');
		echo $javascript->link('scriptaculous-js-1.8.3/src/scriptaculous');
		
		echo $javascript->link('mensaje.class');
		echo $javascript->link('ejecutar_en_head');
                //echo $javascript->link('form_regetp_ria');
		echo $scripts_for_layout;
	?>
	
</head>
<body>
	<cake:nocache>	
	<script type="text/javascript">		
		var mensajero = new Mensaje('mensajero');
	</script>
	
	<? if ($_SERVER['HTTP_HOST']=='localhost'){?>
		<div style="background-color: red; height: 20px; text-align: center">MODO LOCALHOST</div>
	<? }?>
	</cake:nocache>
	
	<div id="container">	
		<cake:nocache>	
		<!-- DIV del mensajero, aca se van a mostrar mensajes AJAX, JS, etc -->
		<div id="mensajero" style="display: none"></div>
		</cake:nocache>
	
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
                        <?php echo $html->link('<img src="'.$html->url("/img/exit.gif").'" border="0" align="absmiddle" />','/users/logout', array('class'=>'userlinks'), false, false); ?> <?php echo $html->link('Salir','/users/logout', array('class'=>'userlinks'), false, false); ?>
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
                            <br />
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