<?
if ($session->check('Auth.User')) {
    if(	$session->read('Auth.User.role') == 'desarrollo') {
        ?>

<div id="boxDesarrollo">
    <h1>Desarrollo</h1>
    <ul>
        <li><? echo $html->link("Migrador Fondo","/fondo_temporales/checked_instits") ?></li>
    </ul>

</div>


        <?	}
} ?>