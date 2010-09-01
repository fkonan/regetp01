<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->charset(); ?>
        <title>
            <?php __('Depurador de Planes');
            echo Configure::read('regetpVersion')." - "; ?>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $html->meta('icon');
        echo $html->css('regetp','stylesheet', array('media'=>'screen'));
        ?>
    </head>
<body>

    <div id="col_izq"></div>
    <div id="col_der"></div>

</body>
</html>
