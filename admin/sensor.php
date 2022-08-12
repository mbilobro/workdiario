<?php

include('../connection.php');

include('../protect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workdiario - Admin</title>
    <link rel="icon" size="16x16" href="../imagens/workdiario.png" type="image/x-icon">
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="sb-nav-fixed">

<?php
            include('./components/navbar.php');
        ?>

        <div id="layoutSidenav">

            <?php
                include('./components/sidebar.php');
            ?>

            <div id="layoutSidenav_content" style="background-color: #ab9680;">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Informações do sensor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Informações do sensor</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Nesta seção você poderá alterar as infomações a respeito do sensor.
                            </div>
                        </div>
                        <form id="infoSensor">
                            <div class="mb-3 col-lg-6">
                                <label for="nomeSensor" class="form-label">Nome do sensor</label>
                                <input type="text" class="form-control" id="nomeSensor" name="nomeSensor" aria-describedby="usuarioHelp" autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-success" style="margin-top: 20px; margin-bottom: 10px;">Salvar alterações</button>
                        </form>
                    </div>
                </main>

                <?php
                    include('./components/footer.php');
                ?>

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="js/sensor.js"></script>
</body>
</html>