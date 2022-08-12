<?php

require_once('../connection.php');

$umidade = $_GET['umidade'];
$rega = $_GET['rega'];
$sensor = 1;

$porcetagemUmidadeBruta = $umidade / 10.24;

$porcetagemUmidadeReal = number_format((100 - $porcetagemUmidadeBruta), 2);

$query = "INSERT INTO umidade (umidade, idSensor) VALUES ('{$porcetagemUmidadeReal}', '{$sensor}')";
$realizaQuery = mysqli_query($mysqli, $query);

if ($rega == 1) {
    $queryRega = "INSERT INTO regas (idSensor) VALUES ('{$sensor}')";
    $realizaQueryRega = mysqli_query($mysqli, $queryRega);
}

if ($realizaQuery == true && $realizaQueryRega == true) {
    echo "salvo_com_sucesso";
} else if ($realizaQuery == true){
    echo "salvo_com_sucesso";
} else {
    echo "erro_ao_salvar";
}

?>