<?
if ($session->check('Auth.User')) {
    if(	$session->read('Auth.User.role') == 'desarrollo') {
        ?>

<div id="boxDesarrollo">
    <h1 id="boxDesarrollo" class="menu_head">Desarrollo</h1>
    <ul class="menu_body">
        <li><? echo $html->link("Fondos","/fondos/index") ?></li>
        <li><? echo $html->link("Migrador Fondo","/fondo_temporales/checked_instits") ?></li>
    </ul>

</div>


        <?	}
} ?>