<?php
    session_start();

    include('connection.php');


    if(isset($_SESSION['usuarioLogado'])){
        header('Location: admin/index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workdiario - Irrigação Automática</title>
    <link rel="stylesheet" href="./css/bulma.min.css"/>
    <link rel="icon" size="16x16" href="imagens/workdiario.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/index.css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <noscript> <meta http-equiv="refresh" content="1; url=/erros/noscript.html"> </noscript>

</head>
<body>

<section class="login">
        <div class="div-logo-detra">
            <img  class="logo-detra" src="imagens/workdiario.png" alt="Logo WorkDiario">
        </div>
        <div class="hero-body">
            <div>
                <div>
                    <?php
                        if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <div class="notification is-danger">
                      <p>ERRO: Usuário ou senha inválidos.</p>
                    </div>
                    <?php
                        endif;
                        unset($_SESSION['nao_autenticado']);
                    ?>
                    <?php
                    if(isset($_SESSION['captchaInvalido'])):
                        ?>
                        <div class="notification is-danger">
                        <p>ERRO: Captcha Inválido</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['captchaInvalido']);
                    ?>
                    <div class="box">
                        <form action="login.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="usuario" name="text" class="input is-large" placeholder="Seu usuário" autofocus="">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="input is-large" id="senha" type="password" placeholder="Sua senha">
                                </div>
                                <div class="div-olho" >
                                    <span class="input-group-btn">
                                        <button id="olho" class="btn btn-default reveal" type="button"><i class="fas fa-eye-slash"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center">
                                <div class="g-recaptcha"  data-sitekey="<?php echo $dataSiteKey ?>"></div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>
</html>

