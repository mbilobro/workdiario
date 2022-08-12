<?php

define('DB_HOST', (getenv('DB_HOST')  ?: '127.0.0.1'));
define('DB_USER', (getenv('DB_USER') ?: 'root'));
define('DB_PASS', (getenv('DB_PASS') ?: ''));
define('DB_NAME', (getenv('DB_NAME') ?: 'workidiario'));

$dataSiteKey = '6LeePU8hAAAAALq8sM4JM0uMnEpV0qt-K8xDlQRi';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}

$mysqli->set_charset('utf8mb4');
