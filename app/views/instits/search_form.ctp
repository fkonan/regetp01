
<?
echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.loadmask.min',
    'views/instits/search_form',
        ));

echo $html->css(array('jquery.loadmask'));
?>

<h1><? __('Búsqueda de Instituciones')?></h1>


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
            'empty'=>'TODAS',
            'after' => '<br><cite style="color:#757575">Filtro opcional. Si no selecciona una Jurisdicción se realizará una búsqueda en todo el Registro.</cite>'
            ));

    echo $form->input('busqueda_libre', array(
            'id'=>'InstitCue',
            'style'=>'border:1px solid #BBBBBB; width: 99%; font-size: 22px; height: 29px; color: rgb(117, 117, 117);',
            'label'=> 'CUE ó Nombre de la Institución',
            'title'=> 'Ingrese CUE ó Nombre de la institución en forma completa ó parcial. Ej: 600118, 5000216 ó Manuel Belgrano.',
            ));
    ?>
    
    <div id="boxAyuda" style="display:block;clear:both">
        <div id="boxAyuda" class="menu_head help_head">
            <p style="float:left;margin-right:10px;font-style: italic">Ayuda</p>
            <?php echo $html->image('help.png', array('alt' => 'Ayuda','style'=>'float:left;display:inline'))?>
        </div>
        <ul class="menu_body help_body">
                <br/>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">Puede
                buscar por CUE</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">
                (con &oacute; sin n&uacute;mero de anexo) &oacute; por parte del CUE.
                </SPAN></FONT></FONT>
                </P>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">Ej</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">emplos:
                </SPAN></FONT></FONT>
                </P>
                <TABLE BORDER=1 BORDERCOLOR="#BFBFBF" CELLPADDING=7 CELLSPACING=0>
                        <COL >
                        <COL >
                        <TR VALIGN=TOP>
                                <TD >
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Si
                                        ingresa</B></FONT></FONT></P>
                                </TD>
                                <TD >
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Busca
                                        por</B></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>282</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">P</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">arte
                                        del CUE</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>3000282</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">CUE
                                        completo sin considerar n&uacute;mero de anexo</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>300028200</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>CUE
                                        con n&uacute;mero de anexo</FONT></FONT></P>
                                </TD>
                        </TR>
                </TABLE>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">Tambi&eacute;n
                puede buscar por tipo de establecimiento, n&uacute;mero y nombre
                propio de la instituci&oacute;n</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">.
                El buscador ignora may&uacute;sculas / min&uacute;sculas y letras
                acentuadas para mejorar los resultados.</SPAN></FONT></FONT></P>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">Ej</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">emplos:</SPAN></FONT></FONT></P>
                <TABLE BORDER=1 BORDERCOLOR="#BFBFBF" CELLPADDING=7 CELLSPACING=0>
                        <COL >
                        <COL >
                        <TR VALIGN=TOP>
                                <TD >
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Si
                                        ingresa</B></FONT></FONT></P>
                                </TD>
                                <TD >
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Busca
                                        por</B></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>escuela
                                        t&eacute;cnica</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">T</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">ipo
                                        de instituci&oacute;n</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>E.E.T.</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">T</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">ipo
                                        de instituci&oacute;n en formato abreviado</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>EET</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">T</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">ipo
                                        de instituci&oacute;n en formato abreviado sin puntos</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>tecnica
                                        18</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">T</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">ipo
                                        y n&uacute;mero de instituci&oacute;n</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>savio</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">P</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">arte
                                        del nombre de la instituci&oacute;n</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>T&eacute;cnica
                                        Savio</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">T</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">ipo
                                        de instituci&oacute;n y parte del nombre</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                        <TR VALIGN=TOP>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>escuela
                                        tecnica general savio</FONT></FONT></P>
                                </TD>
                                <TD>
                                        <P LANG="es-ES" CLASS="western"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">T</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">ipo
                                        de instituci&oacute;n y parte del nombre</SPAN></FONT></FONT></P>
                                </TD>
                        </TR>
                </TABLE>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">Puede
                utilizar las combinaciones que prefiera.</SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">
                Pruebe comenzando con criterios m&iacute;nimos y vaya refinando la
                b&uacute;squeda si obtiene demasiados resultados.</SPAN></FONT></FONT></P>
                <P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">Si
                necesita definir </SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">m&aacute;s
                criterios (departamento, localidad, tipo de oferta del
                establecimiento, etc.) realice una </SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES"><U>b&uacute;squeda
                avanzada</U></SPAN></FONT></FONT><FONT FACE="Arial, sans-serif"><FONT SIZE=2><SPAN LANG="es-ES">.</SPAN></FONT></FONT></P>
                
        </ul>
    </div>
    
    <?
    echo $html->link('realizar una búsqueda avanzada...','advanced_search_form',array(
        'class'=>'link_right small',
        'style'=>'margin-bottom: -18px; padding:0px; margin-right: 4px;'
    ));
    echo $form->end('Buscar');
    ?>
    
    <!-- Aca se muestran los resultados de la busqueda-->
    <div id='consoleResultWrapper'  style="margin-top: 20px;">
        <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;"></div>
    </div>
    
</div>
