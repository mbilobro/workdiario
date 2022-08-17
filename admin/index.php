<?php

include('../protect.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$diaHoje = date('d/m/Y');

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Página principal da dashboard do Sistema Workdiario" />
        <meta name="author" content="" />
        <title>Workdiario - Admin</title>
        <link rel="icon" size="16x16" href="../imagens/workdiario.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row justify-content-center">
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" id="cardAguardando">
                                    <div class="card-number" id="card-number-readings"></div>
                                    <div class="card-body">Leituras de umidade</div>

                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="leituras_umidade.php">Ver todas</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" id="cardExpirado">
                                <div class="card-number" id="card-number-watering"></div>
                                    <div class="card-body">Regas</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="regas.php">Ver todas</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 d-flex justify-content-center">
                            <div class="card mb-4">
                                <div class="card-header" id="last-reading">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Leitura mais recente do dia de hoje - <?= $diaHoje ?>
                                </div>
                                <div class="card-body">
                                    <div id="divLeituraAtual" class="mensagemVazio"></div>
                                    <div class="umidadeAtualizada"></div>
                                </div>
                            </div>
                        </div>

                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-line me-1"></i>
                                        Leituras durante o dia de hoje - <?= $diaHoje ?>
                                    </div>
                                    <div class="card-body">
                                        <div id="divLeituras" class="mensagemVazio"></div>
                                        <canvas id="leiturasHoje" width="100%" height="40" aria-label="Gráfico que mostra as leituras do dia de hoje"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Regas durante o dia de hoje - <?= $diaHoje ?>
                                    </div>
                                    <div class="card-body">
                                        <div id="divRegas" class="mensagemVazio"></div>
                                        <canvas id="regasHoje" width="100%" height="40" aria-label="Gráfico que mostra a última leitura"></canvas>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    </body>
</html>
