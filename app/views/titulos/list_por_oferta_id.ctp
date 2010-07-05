<?

echo "<option value='0'>Seleccione</option>";

foreach ($titulos as $id=>$valor) {
    $valor = utf8_encode($valor);
    echo "<option value='$id'>$valor</option>";
}




