<script language=javascript>
        var arrChicos = new Array();
        var arrAdultos = new Array();
        var arrInstit = new Array();

        function showProvincia(ProvName, id) {

                if (id > -1) {
                        
                        jQuery("#divCuadro").html('<h1 style="background: #608DA9; padding: 1px 5px 1px 7px; margin: 0; color: #FFFFFF; font-size: 14px; border-bottom:1px solid #0099FF; ">' + ProvName + '</h1>');

                        jQuery("#divCuadro").css({ visibility: '' });
                } else {
                        jQuery("#divCuadro").css({ visibility: 'hidden' });
                }
        }
</script>
<div class="jurisdicciones index">
<h1><?php __('Jurisdicciones');?></h1>
<p><?php __('Haga click en la jurisdicción de la que desee obtener información');?></p>

<!--<table width="80%" cellpadding = "0" cellspacing = "0" summary=""
	style="border-style: solid; border-width: 1px; border-color: gray; font-size: 9pt;">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($jurisdicciones as $jurisdiccion):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $jurisdiccion['Jurisdiccion']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action'=>'view', $jurisdiccion['Jurisdiccion']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $jurisdiccion['Jurisdiccion']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
</table>
-->
<DIV id=divCuadro style="-moz-box-shadow:0 0 10px #000000; background-color:#608DA9;BORDER-RIGHT: 1px solid; PADDING-RIGHT: 0px; BORDER-TOP: 1px solid; PADDING-LEFT: 0px; FONT-SIZE: 12px; LEFT: 650px; VISIBILITY: hidden; PADDING-BOTTOM: 0px; BORDER-LEFT: 1px solid; WIDTH: 150px; PADDING-TOP: 0px; BORDER-BOTTOM: 1px solid; POSITION: absolute; TOP: 400px">
</DIV>
<?php echo $html->image("mapa.png",array('id'=>'mapa_argentina','style'=>'height:600px;width:431px;border:0px;margin-left:80px','usemap'=>'#m_mapa_argentina','name'=>'mapa_argentina','alt'=>''));?>

  <map id=m_mapa_argentina
name=m_mapa_argentina>
    <area
  onMouseOver="javascript:showProvincia('Cdad. de Buenos Aires',3);"
  title="Ciudad Autónoma de Buenos Aires"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY
  alt="Ciudad Autónoma de Buenos Aires"
  coords=268,244,276,234,287,248,274,256,267,244
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 2)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Tierra del Fuego',24);"
  title="Tierra del Fuego" onMouseOut="javascript:showProvincia('',-1);" shape=POLY
  alt="Tierra del Fuego"
  coords=153,570,154,538,162,555,169,562,179,569,187,570,185,574,178,574,167,572
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 94)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Santa Cruz',21);" title="Santa Cruz"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="Santa Cruz"
  coords=158,431,112,431,113,440,110,444,112,450,104,460,109,469,105,473,105,479,100,481,97,487,98,502,102,509,111,506,114,521,118,527,152,529,144,508,150,495,158,489,156,482,178,458,179,446,168,445,161,438
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 78)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Chubut',5);" title=Chubut
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Chubut
  coords=112,431,109,424,115,418,111,412,115,405,107,402,105,387,107,383,101,372,100,366,105,364,185,364,192,368,203,364,202,375,192,369,187,373,195,379,184,391,180,410,169,413,160,422,157,431
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 26)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Rio Negro',17);" title="Rio Negro"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="Rio Negro"
  coords=105,363,102,350,111,350,111,345,122,339,126,330,141,315,149,313,147,306,146,290,151,291,152,298,159,300,168,308,189,310,212,316,212,342,214,345,202,344,190,338,187,362
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 62)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Neuquén',15);" title=Neuquén
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Neuquén
  coords=102,349,101,344,101,340,103,337,101,334,102,332,101,326,105,314,111,310,111,308,110,299,107,278,114,269,125,284,134,283,145,290,146,307,149,311,140,315,125,329,122,338,112,342,110,349
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 58)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Mendoza',13);" title=Mendoza
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Mendoza
  coords=145,289,132,282,126,283,115,268,114,253,121,235,120,223,123,221,117,217,118,213,116,208,123,207,124,201,129,200,135,204,140,200,145,201,147,204,154,203,158,209,157,220,164,231,163,237,170,247,165,263,145,264
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 50)) ?>">
    <area
  onMouseOver="javascript:showProvincia('La Pampa',11);" title="La Pampa"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="La Pampa"
  coords=146,288,145,264,187,265,188,247,212,247,211,315,195,309,169,308,159,299,152,297,152,290
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 42)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Pcia.de Buenos Aires(La Plata)',1);" title="Buenos Aires"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="Buenos Aires"
  coords=217,343,213,341,213,239,236,238,248,225,253,227,256,222,275,235,266,245,274,257,287,248,296,256,291,267,302,274,288,301,268,308,248,311,230,311,223,309,225,321,222,326,222,341
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 6)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Entre Ríos',8);" title="Entre Ríos"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="Entre Ríos"
  coords=280,236,268,228,257,220,249,207,250,195,266,180,267,174,281,172,291,176,290,189,286,201,285,216,281,218
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 30)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Misiones',14);" title=Misiones
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Misiones
  coords=322,127,328,129,333,122,338,121,345,115,348,101,358,100,360,110,357,117,357,123,340,131,329,139
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 54)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Corrientes',7);" title=Corrientes
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Corrientes
  coords=268,172,268,157,275,151,281,134,284,124,312,130,317,130,320,128,328,139,291,175,283,170
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 18)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Santa Fe',22);" title="Santa Fe"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="Santa Fe"
  coords=221,237,236,216,231,200,231,197,236,178,233,173,240,136,279,134,275,149,267,157,266,172,266,178,250,194,248,208,256,220,252,226,248,224,236,237
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 82)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Córdoba',6);" title=Córdoba
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Córdoba
  coords=179,194,179,180,184,168,190,162,191,159,194,157,220,163,226,171,231,173,235,178,230,194,230,200,235,214,219,237,213,238,212,247,188,246,191,203,187,201
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 14)) ?>">
    <area
  onMouseOver="javascript:showProvincia('San Luis',20);" title="San Luis"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="San Luis"
  coords=156,197,167,199,179,195,186,202,190,202,188,217,187,264,167,263,170,246,164,237,165,231,159,220,159,209,155,204
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 74)) ?>">
    <area
  onMouseOver="javascript:showProvincia('San Juan',19);" title="San Juan"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="San Juan"
  coords=122,140,130,149,129,159,139,161,157,179,157,190,164,197,155,196,155,203,148,203,145,200,140,200,135,204,129,199,123,201,123,207,117,207,115,200,115,197,110,188,114,184,114,176,120,171,118,165,116,155,119,154
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 70)) ?>">
    <area
  onMouseOver="javascript:showProvincia('La Rioja',12);" title="La Rioja"
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt="La Rioja"
  coords=123,139,130,128,137,128,147,137,162,135,170,146,180,154,183,167,178,180,178,194,166,198,158,189,158,179,139,160,130,159,131,149
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 46)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Santiago del Estero',23);"
  title="Santiago del Estero" onMouseOut="javascript:showProvincia('',-1);"
  shape=POLY alt="Santiago del Estero"
  coords=190,157,187,143,187,132,198,110,197,101,200,95,240,94,239,134,231,172,225,171,222,162,199,156
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 86)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Catamarca',2);" title=Catamarca
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Catamarca
  coords=137,85,163,88,160,95,166,105,171,105,171,110,176,112,170,119,179,134,186,133,185,143,190,162,184,166,179,152,170,145,166,136,158,135,147,136,138,127,130,127,132,119,141,116,136,105,140,102
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 10)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Tucumán',25);" title=Tucumán
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Tucumán
  coords=171,104,181,100,196,102,197,110,188,130,180,134,173,119,177,112,171,108
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 90)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Chaco',4);" title=Chaco
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Chaco
  coords=217,93,233,71,287,116,280,133,240,134,241,94
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 22)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Formosa',9);" title=Formosa
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Formosa
  coords=233,70,233,42,262,69,267,68,302,93,288,115,259,88
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 34)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Salta',18);" title=Salta
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Salta
  coords=138,84,139,81,136,77,154,66,155,63,166,70,169,56,178,72,196,76,203,71,203,56,193,55,186,42,189,35,201,46,207,32,224,33,231,42,232,72,215,92,200,93,195,101,185,99,178,99,167,104,162,95,165,87
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 66)) ?>">
    <area
  onMouseOver="javascript:showProvincia('Jujuy',10);" title=Jujuy
  onMouseOut="javascript:showProvincia('',-1);" shape=POLY alt=Jujuy
  coords=156,61,160,49,157,46,164,37,171,35,171,29,177,35,188,34,185,42,191,55,203,57,203,69,195,75,180,72,173,57,169,55,166,69
  href="<?php echo $html->url(array('controller'=>'jurisdicciones','action'=>'view', 38)) ?>">
  </map>
</div>