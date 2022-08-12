<?php

    include('./connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMPG - Escuta</title>
    <link rel="icon" size="16x16" href="../imagens/escuta.png" type="image/x-icon">
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="sb-nav-fixed">

                    <form id="criarUsuario">

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nomeHelp" autocomplete="off" style="text-transform:uppercase">
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="usuarioHelp" autocomplete="off">
                            <div id="usuarioHelp" class="form-text">Nunca iremos compartilhar seu usuário com ninguém.</div>
                        </div>
                        <div class="col-auto">
                            <label for="senha" class="col-form-label">Senha</label>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                                <input type="password" id="senha" class="form-control" aria-describedby="senhaHelpInline">
                            </div>
                            <div class="col-auto">
                            <button id="olho" class="btn btn-default reveal" type="button"><i class="fas fa-eye"></i></button>
                                
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="confirmSenha" class="col-form-label">Confirme sua senha</label>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                                <input type="password" id="confirmSenha" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                            <button id="olhoConfirmacao" class="btn btn-default reveal" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-top: 20px;">Criar usuário</button>
                        </form>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="js/newUser.js"></script>
</body>
</html>