<?php
session_start();

require_once './connection.php';

$case = $_GET['case'];

date_default_timezone_set('America/Bahia');

switch ($case) {

    case 'criarUsuario':

        $nomeUsuario = $_POST['nome'];
        $senhaUsuario = $_POST['senha'];
        $confirmacaoSenha = $_POST['confirmacaoSenha'];
        $usuario = $_POST['usuario'];

        if (!$nomeUsuario){
            echo json_encode('error');
        } else if (!$senhaUsuario){
            echo json_encode('error');
        } else if (!$confirmacaoSenha) {
            echo json_encode('error');
        } else if (!$usuario){
            echo json_encode('error');
        } else if ($senhaUsuario != $confirmacaoSenha){
            echo json_encode('error');
        } else {
            // Encriptar a senha do usuário
            $senhaUsuario = password_hash($senhaUsuario, PASSWORD_DEFAULT);

            // Deixar todas as letras do nome do usuário maiúsculas
            $nomeUsuario = mb_strtoupper ($nomeUsuario,"utf-8");

            $queryUsuario = "INSERT INTO usuario (loginUsuario, senhaUsuario, nomeUsuario) VALUES ('$usuario', '$senhaUsuario', '$nomeUsuario');";

            $sql_query = $mysqli->query($queryUsuario) or die("Falha na execução do código SQL: " . $mysqli->error);
            
            if($sql_query === TRUE) {
                echo json_encode('success');
            } else {
                echo json_encode('error');
            }
        }
    break;
}