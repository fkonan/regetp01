<div id="boxInstituciones">
<h1 id="boxInstituciones" class="menu_head">Instituciones</h1>

<ul class="menu_body">
	<li><?php echo $html->link(__('Buscador', true), '/instits/old_search_form'); ?></li>
        <?php
            $group_alias = $session->read('User.group_alias');
            if ($group_alias == strtolower(Configure::read('grupo_desarrolladores')) ||
            $group_alias == strtolower(Configure::read('grupo_administradores'))) {
        ?>
        <li>
            <?php
                echo $html->image('labs.png', array('style' => 'float:right;display:inline; margin-bottom:3px; padding-right:10px;width:20px'));
                echo $html->link(__('Buscador Beta', true), '/instits/search_form');
            ?>
        </li>
        <?php
                }
            ?>
	<li><?php echo $html->link(__('Histórico de CUE', true), '/historialCues/search_form'); ?></li>
	<!--br />
	<li><?php //echo $html->link(__('Cuadro de información', true), '/jurisdicciones/planofertajuris'); ?></li -->
</ul>
</div>