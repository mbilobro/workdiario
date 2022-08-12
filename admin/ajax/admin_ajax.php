<?php
session_start();

require_once '../../connection.php';

include('../../protect.php');

$case = $_GET['case'];
$usuario = $_SESSION['id'];

date_default_timezone_set('America/Bahia');

switch ($case) {

    case 'buscarInformacoes':
        $diaAtual = date('Y-m-d');

        $resultado = array(
                    'leituras' => [],
                    'totalLeiturasUmidade' => 0,
                    'regas' => [],
                    'totalRegas' => 0,
        );

        // Buscar informações a respeito das leituras de umidade para o dia atual
        $queryLeiturasUmidade = "SELECT * FROM umidade WHERE dataUmidade like '{$diaAtual}%' && idSensor = 1";

        $pesquisaLeituras = mysqli_query($mysqli, $queryLeiturasUmidade);
        $resultado['leituras'] = mysqli_fetch_all($pesquisaLeituras);

        $resultado['totalLeiturasUmidade'] = count($resultado['leituras']);


        // Buscar informações a respeito das regas para o dia atual
        $queryRegas = "SELECT * FROM regas WHERE dataRega like '{$diaAtual}%' && idSensor = 1";

        $pesquisaRegas = mysqli_query($mysqli, $queryRegas);
        $resultado['regas'] = mysqli_fetch_all($pesquisaRegas);

        $resultado['totalRegas'] = count($resultado['regas']);

        echo json_encode($resultado);
    break;

    case 'buscarPorFiltro':
        $filtroStatus = $_POST['filtroStatus'];
        $data = $_POST['data'];
        $contador = count($data);

        $demandas = array();

        if ($contador == 2 && $filtroStatus == "Leituras de umidade") {
            $queryUmidades = "SELECT * FROM umidade 
                                INNER JOIN sensor ON (umidade.idSensor = sensor.idSensor)
                                WHERE umidade.idSensor = 1
                                && cast(umidade.dataUmidade as DATE) BETWEEN '{$data[0]}' AND '{$data[1]}';";

            $pesquisaUmidades = mysqli_query($mysqli, $queryUmidades);
            $resultadoUmidades = mysqli_fetch_all($pesquisaUmidades);

            echo json_encode($resultadoUmidades);

        } else if ($contador == 2 && $filtroStatus == "Regas") {
            $queryRegas = "SELECT * FROM regas 
                            INNER JOIN sensor ON (regas.idSensor = sensor.idSensor)
                            WHERE regas.idSensor = 1
                            && cast(regas.dataRega as DATE) BETWEEN '{$data[0]}' AND '{$data[1]}';";

            $pesquisaRegas = mysqli_query($mysqli, $queryRegas);
            $resultadoRegas = mysqli_fetch_all($pesquisaRegas);

            echo json_encode($resultadoRegas);

        } else if ($contador == 1 && $filtroStatus == "Leituras de umidade"){

            $queryUmidades = "SELECT * FROM umidade 
                                INNER JOIN sensor ON (umidade.idSensor = sensor.idSensor)
                                WHERE umidade.idSensor = 1
                                && umidade.dataUmidade like '{$data[0]}%';";

            $pesquisaUmidades = mysqli_query($mysqli, $queryUmidades);
            $resultadoUmidades = mysqli_fetch_all($pesquisaUmidades);

            echo json_encode($resultadoUmidades);

        } else if ($contador == 1 && $filtroStatus == "Regas"){
            $queryRegas = "SELECT * FROM regas 
                            INNER JOIN sensor ON (regas.idSensor = sensor.idSensor)
                            WHERE regas.idSensor = 1
                            && regas.dataRega like '{$data[0]}%';";

            $pesquisaRegas = mysqli_query($mysqli, $queryRegas);
            $resultadoRegas = mysqli_fetch_all($pesquisaRegas);

            echo json_encode($resultadoRegas);
        }

    break;

    case 'buscarNomeSensor':
        $querySensor = "SELECT * FROM sensor WHERE idSensor = 1;";

        $pesquisaSensor = mysqli_query($mysqli, $querySensor);
        $resultadoSensor = mysqli_fetch_object($pesquisaSensor);

        echo json_encode($resultadoSensor);

        break;

    case 'alterarInfoSensor':
        $nomeSensor = $_POST['nomeSensor'];

        $querySensor = "UPDATE sensor SET nomeSensor = '{$nomeSensor}' where idSensor = 1;";

        $realizaQuery = mysqli_query($mysqli, $querySensor);

        echo json_encode($realizaQuery);
        break;
}