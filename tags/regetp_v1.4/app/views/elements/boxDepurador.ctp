<?
if ($session->check('Auth.User')) {
    if(	$session->read('Auth.User.role') == 'admin' ||
            $session->read('Auth.User.role') == 'desarrollo' ||
            $session->read('Auth.User.role') == 'editor') {
        ?>

<div id="boxDepurador">
    <h1>Depurador</h1>
    <ul>
        <li><? echo $html->link("Depurar Sectores","/depuradores/sectores_por_sectores") ?></li>
        <li><? echo $html->link("Depurar Orientaciones","/depuradores/depurar_orientacion") ?></li>
        <li><? echo $html->link("Depurar Títulos de Referencia","/depuradores/depurar_titulos") ?></li>
        
        <li><? echo $html->link("Depurar Tipo Instits","/depuradores/clases_y_etp") ?></li>
        
        <li><? echo $html->link("Listado de similares","/depuradores/depurar_similares") ?></li>
    </ul>

</div>


        <?	}
} ?>