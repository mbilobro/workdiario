<?php

require_once('../connection.php');

$umidade = 690;

$data = date('Y-m-d');

echo $data;

echo "<br>";

$porcetagemUmidadeBruta = $umidade / 10.24;

echo $porcetagemUmidadeBruta;

echo "<br>";

$porcetagemUmidadeReal = number_format((100 - $porcetagemUmidadeBruta), 2);

echo $porcetagemUmidadeReal;

?>