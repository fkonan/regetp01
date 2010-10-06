<?php
$result = array();

foreach ($categorias as $categoria) {
   array_push($result, array(
                "categoria" => utf8_encode($categoria['Query']['categoria'])
            ));
}

 echo json_encode($result);
