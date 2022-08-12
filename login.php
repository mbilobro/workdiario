<?php
    session_start();
    include('connection.php');
    require_once "recaptchalib.php";

    
if(isset($_POST['usuario']) || isset($_POST['senha'])) {

    if(strlen($_POST['usuario']) == 0 || strlen($_POST['senha']) == 0) {
        $_SESSION['nao_autenticado'] = true;
        header('Location: index.php');
        exit(); 
    } else {

        $secret = ""

        $response = null;
        $reCaptcha = new ReCaptcha($secret);

        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
        }

        if ($response != null) {


        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuario WHERE loginusuario = '$usuario'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $usuario = $sql_query->fetch_assoc();

        if(password_verify($senha, $usuario['senhaUsuario'])){

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['idUsuario'];
            $_SESSION['nome'] = $usuario['nomeUsuario'];
            $_SESSION['usuarioLogado'] = $usuario;


            header("Location: admin/index.php");
            
        } else {
            $_SESSION['nao_autenticado'] = true;
            header("Location: index.php");
            exit();
           

        }
    } else {
        echo $response;
        $_SESSION['captchaInvalido'] = true;
        header('Location: index.php');
        exit();

    }
}

}
?>