
<?
/* @var $form FormHelper */

/* @var $javascript JavascriptHelper */
$javascript;


echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.loadmask.min',
    'views/instits/search_form',
        ), false);

echo $html->css(array('jquery.loadmask', 'smoothness/jquery-ui-1.8.6.custom'));
?>

<h1><? __('Búsqueda de Instituciones')?></h1>
<br>
<div>
    <?php
    echo $form->create('Instit', array(
        'action' => 'search',
        'name'=>'InstitSearchForm',
        'id' =>'InstitSearchForm',
        )
    );

    echo $form->hidden('form_name',array('value'=>'buscador rapido'));

    echo $form->input('jurisdiccion_id',array(
            'label'=>'Jurisdicción',
            'empty'=>'Todas',
            'div' => array('style' => 'width:30%; float:left; clear: none;'),
            //'after' => '<cite>Filtro opcional. Si no selecciona una Jurisdicción se realizará una búsqueda en todo el Registro.</cite>'
            ));

    echo $form->input('busqueda_libre', array(
            'id'=>'InstitCue',
            'div' => array('style' => 'width:50%; float:left; clear: none'),
         //   'style'=>'border:1px solid #BBBBBB; width: 99%; font-size: 22px; height: 29px; color: rgb(117, 117, 117);',
            'label'=> 'Ingrese CUE, Tipo, Número o Nombre'
            ));
    
//    echo $html->link('Búsqueda avanzada','advanced_search_form',array(
//        'class'=>'link_right small',
//        'style'=>'margin-bottom: -18px; padding:0px; margin-right: 4px;'
//    ));
    
    echo $form->button('Buscar', array(
                'class' => 'boton-buscar',
                'style' => 'float: left; clear: none; margin-top: 20px; width: 10%',
                'onclick' => 'autoSubmit(true)',
         ));

    echo $form->end();
    ?>
    
    <?php
    
    $img =  $html->image('help.png', array(
        'alt' => 'Ayuda: ¿Cómo utilizar el buscador?',
        'id' => 'littleHelpers',
        'style'=>'float:left; margin: 20px 10px;',
        ));

    echo $html->link($img, 'javascript: abrirVentanaAyuda()', array(
        'escape'=>false,
        'title' => 'Ayuda: ¿Cómo utilizar el buscador?',
        ));
    ?>
    
    <div id="boxdeAyuda" style=" overflow: auto; font-size: 8pt !important;">
        <ul style="height: 300px;">
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm">
                    <SPAN LANG="es-ES">Puede buscar por CUE</SPAN>
                    <SPAN LANG="es-ES">(con &oacute; sin n&uacute;mero de anexo) &oacute; por parte del CUE.</SPAN>
                </P>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm">
                    <SPAN LANG="es-ES">Ejemplos: </SPAN>
                </P>
                <TABLE style="background-color: transparent;">
                        <COL >
                        <COL >
                        <TR VALIGN=TOP>
                                <TD >
                                        <B>Si ingresa</B>
                                </TD>
                                <TD >
                                        <B>Busca por</B>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        282
                                <TD>
                                        <SPAN LANG="es-ES">Parte del CUE</SPAN>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        3000282
                                </TD>
                                <TD>
                                        <SPAN LANG="es-ES">CUE completo sin considerar n&uacute;mero de anexo</SPAN>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        300028200
                                </TD>
                                <TD>
                                        CUE con n&uacute;mero de anexo
                                </TD>
                        </TR>
                </TABLE>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm">
                    <SPAN LANG="es-ES">
                        Tambi&eacute;n
                puede buscar por tipo de establecimiento, n&uacute;mero y nombre
                propio de la instituci&oacute;n.
                El buscador ignora may&uacute;sculas / min&uacute;sculas y letras
                acentuadas para mejorar los resultados.
                    </SPAN>
                </P>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm">
                    <SPAN LANG="es-ES">Ejemplos:</SPAN>
                </P>
                <TABLE style="background-color: transparent;">
                        <COL >
                        <COL >
                        <TR VALIGN=TOP>
                                <TD >
                                        <B>Si ingresa</B>
                                </TD>
                                <TD >
                                        <B>Busca por</B>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        escuela t&eacute;cnica
                                </TD>
                                <TD>
                                        <SPAN LANG="es-ES">Tipo de instituci&oacute;n</SPAN>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        E.E.T.
                                </TD>
                                <TD>
                                        <SPAN LANG="es-ES">Tipo de instituci&oacute;n en formato abreviado</SPAN>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        EET
                                </TD>
                                <TD>
                                        <SPAN LANG="es-ES">Tipo de instituci&oacute;n en formato abreviado sin puntos</SPAN>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        tecnica 18
                                </TD>
                                <TD>
                                        <SPAN LANG="es-ES">Tipo y n&uacute;mero de instituci&oacute;n</SPAN>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        savio
                                </TD>
                                <TD>
                                        <SPAN LANG="es-ES">Parte del nombre de la instituci&oacute;n</SPAN>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        T&eacute;cnica
                                        Savio
                                </TD>
                                <TD>
                                        <SPAN LANG="es-ES">Tipo de instituci&oacute;n y parte del nombre</SPAN>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        escuela tecnica general savio
                                </TD>
                                <TD>
                                        <SPAN LANG="es-ES">Tipo de instituci&oacute;n y parte del nombre</SPAN>
                                </TD>
                        </TR>
                </TABLE>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm">
                    <SPAN LANG="es-ES">Puede
                utilizar las combinaciones que prefiera.
                Pruebe comenzando con criterios m&iacute;nimos y vaya refinando la
                b&uacute;squeda si obtiene demasiados resultados.
                    </SPAN>
                </P>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm">
                    <SPAN LANG="es-ES">
                        Si necesita definir m&aacute;s criterios (departamento, localidad, tipo de oferta del
                establecimiento, etc.) realice una
                    </SPAN><SPAN LANG="es-ES">
                <?php
                            echo $html->link('Búsqueda avanzada','advanced_search_form',array(
                                             'div'=>false));
                ?>
                        </SPAN>.
                </P>
                
        </ul>
    </div>

    <div class="clear"></div>
    
    <!-- Aca se muestran los resultados de la busqueda-->
    <div id='consoleResultWrapper'  style="margin-top: 20px;">
        <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;"></div>
    </div>
    
</div>
