<?php

include('../protect.php');

require_once '../connection.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Workdiario - Admin</title>
        <link rel="icon" size="16x16" href="../imagens/workdiario.png" type="image/x-icon">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link href="css/styles.css" rel="stylesheet"/>

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
                        <h1 class="mt-4">Histórico</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Histórico</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-body">
                                - Nesta seção poderão ser visualizadas as infomações a respeito das regas e das leituras de umidade de dias anteriores de acordo com os filtros selecionados.
                            </div>
                        </div>
                        <div class="filter">
                            <div class="row">
                                <div class="col-xl-3 col-md-3 col-sm-3">
                                    <select name="status" id="selectStatus" class="form-control form-select bg-soft" aria-label="Select para escolher o status que deseja buscar no sistema">
                                        <option selected disabled>Selecione um status</option>
                                        <option value="Leituras de umidade">Leituras de umidade</option>
                                        <option value="Regas">Regas</option>
                                    </select>
                                </div>

                                <div class="col-xl-3 col-md-3 col-sm-3">
                                    <select disabled name="status" id="selectFiltroData" class="form-control form-select bg-soft-disabled" aria-label="Select para escolher o status que deseja buscar no sistema">
                                        <option selected disabled>Selecione um filtro de data</option>
                                        <option value="Dia">Filtrar por dia</option>
                                        <option value="periodoDias">Filtrar por período de dias</option>
                                        <option value="Mes">Filtrar por mês</option>
                                        <option value="Ano">Filtrar por ano</option>
                                    </select>
                                </div>

                                <!-- Filtro por dia -->
                                <div id="filtroDia" class="col-xl-3 col-md-3 col-sm-3" style="display: none;">
                                    <input class="form-control bg-soft" type="date" id="dataFiltro">
                                </div>

                                <!-- Filtro período de dias -->
                                <div id="filtroPorPeriodoInicial" class="col-xl-3 col-md-3 col-sm-3" style="display: none;">
                                    <input class="form-control bg-soft" type="date" id="dataFiltroInicial">
                                </div>

                                <div id="filtroPorPeriodoFinal" class="col-xl-3 col-md-3 col-sm-3" style="display: none;">
                                    <input class="form-control bg-soft" type="date" id="dataFiltroFinal">
                                </div>

                                <!-- Filtro por mês -->
                                <div id="filtroMes" class="col-xl-3 col-md-3 col-sm-3" style="display: none;">
                                    <select id="mes" name="linha" class="form-control form-select bg-soft">
                                        <option selected disabled>Selecione um mês</option>
                                        <option value="01">Janeiro</option>
                                        <option value="02">Fevereiro</option>
                                        <option value="03">Março</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Maio</option>
                                        <option value="06">Junho</option>
                                        <option value="07">Julho</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                                    </select>
                                </div>

                                <div id="filtroMesAno" class="col-xl-3 col-md-3 col-sm-3" style="display: none;">
                                    <input type="number" maxlength="4" size="4" class="form-control bg-soft" id="mesAno">
                                </div>
                            

                                <!-- Filtro por ano -->
                                <div id="filtroAno" class="col-xl-3 col-md-3 col-sm-3 " style="display: none;">
                                    <input type="number" maxlength="4" size="4" class="form-control bg-soft" id="ano">
                                </div>

                            </div>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-soft slide" onclick="buscarRegistros()">Buscar registros</button>
                        </div>

                        </div>

                        <div class="card-body" id="tableDemandas">
                                        
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
        <script src="js/historico.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    </body>
</html>