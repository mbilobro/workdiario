<?php

include('../protect.php');

require_once '../connection.php';

function formataData ($data){
    $ano = substr($data, 0, 4);
    $mes = substr($data, 5, 2);
    $dia = substr($data, 8, 2);
    $hora = substr($data, 11);

    $data = $dia."/".$mes."/".$ano . " ". $hora;

    return $data;
}

$diaHoje = date('Y-m-d');

$queryRegas = "SELECT * FROM regas INNER JOIN sensor ON (regas.idSensor = sensor.idSensor) WHERE regas.idSensor = 1 && regas.dataRega like '{$diaHoje}%';";
$pesquisaRegas = mysqli_query($mysqli, $queryRegas);
$resultadoRegas = mysqli_fetch_all($pesquisaRegas);

$anoAtual = date('Y');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Workidiario - Admin</title>
        <link rel="icon" size="16x16" href="../imagens/workdiario.png" type="image/x-icon">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link href="css/styles.css" rel="stylesheet" />

    </head>
    <body class="sb-nav-fixed">
        <?php
            include('./components/navbar.php');
        ?>

        <div id="layoutSidenav">

            <?php
                include('./components/sidebar.php');
            ?>

            <div id="layoutSidenav_content">
                <main class="main-layout">
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Regas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Regas</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                - Nesta seção estão disponibilizadas as regas do dia de hoje em uma tabela.
                            </div>
                        </div>

                        <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Regas</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                                    Regas
                                </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple" class="datatable">
                                            <thead>
                                                <tr>
                                                    <th>ID Rega</th>
                                                    <th>Data/Hora</th>
                                                    <th>Nome sensor</th>
                                                    <th>ID sensor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($resultadoRegas as $respostaRega) {
                                                ?>
                                                <tr>
                                                    <td> <?php echo $respostaRega[0]?> </td>
                                                    <td> <?php echo formataData($respostaRega[1])?> </td>
                                                    <td> <?php echo $respostaRega[4]?> </td>
                                                    <td> <?php echo $respostaRega[2]?> </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> 
                    </div>
                    </div>
                </main>

                <?php
                    include('./components/footer.php');
                ?>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="js/regas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>


        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </body>
</html>
