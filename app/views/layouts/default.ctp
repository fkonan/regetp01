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
		<?php __('Sistema Gesti�n de Registro - ');
			  echo Configure::read('regetpVersion')." - "; ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');
		echo $html->css('regetp');
		echo $html->css('printer','stylesheet', array('media'=>'print'));
		echo $javascript->link('prototype');
		echo $scripts_for_layout;
	?>
	
</head>
<body>
	<div id="container">
		<div id="header" <?= ($_SERVER['HTTP_HOST']=='localhost')?'style="background-color:white; background-image: url('.$html->url('/img/linux-volando-localhost.gif',true).')"':''?>>
			<h1><?php echo $html->link(__('Registro Federal de Instituciones de ETP - RFIETP', true), '/pages/home'); ?></h1>	
		</div>
		<div id="content">
			<div id="menu">	
							
				<h1>Instituciones</h1>
				<ul>
					<li><?php echo $html->link(__('Buscador', true), '/instits/search_form'); ?></li>
				</ul>			
				
					
				<?  echo $this->renderElement('boxLogin'); ?>
				<?  echo $this->renderElement('boxInformacion'); ?>
				<?  echo $this->renderElement('boxAdmin'); ?>	
				<?  echo $this->renderElement('boxEditores'); ?>
				
				
				<h1><?= __('Soporte T�cnico')?></h1>
				<ul>
					<li><?= $html->link('Contacto','/pages/contacto'); ?></li>
				</ul>				
			</div>
			<div id="cuerpo">
				<?  echo $this->renderElement('rutaUrl', array("ruta" => $rutaUrl_for_layout)); ?>
				<?php $session->flash(); ?>
				<? $session->flash('auth');?>
				<?php echo $content_for_layout; ?>
			</div>
		</div>
		<div id="footer">
			<?php echo $html->link(
					$html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0")),
					'http://www.cakephp.org/',
					array('target'=>'_blank'), null, false
				);
			?>
		</div>
	</div>
	<?php echo $cakeDebug; ?>
</body>
</html>