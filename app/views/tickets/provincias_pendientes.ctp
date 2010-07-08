<div style="background-color: #ccddeb">
    <?php
    foreach($prov_pend as $id=>$name) {
        ?><li>
        <? echo $html->link(utf8_encode($name), array('controller'=>'Tickets', 'action'=>'index', $id), array('onclick'=>'Javascript: location.href="/Tickets/index/'.$id.'"')); ?>
    </li>
        <?php
    }

    if(count($prov_pend) < 1) {
        ?><li>
        <? echo $html->link("No hay pendientes","/pages/home/") ?>
    </li>
            <?php
    }
    ?>
</div>