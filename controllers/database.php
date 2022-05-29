<?php

$usuario = 'dev';
$senha = 'sandbox';
$banco = 'mychat';

try {
    $conn = new PDO('mysql:host=localhost;dbname=' . $banco. ";charset=utf8mb4", $usuario, $senha);
} catch (Exception $ex) {
    echo 'Erro na conexão com o banco: ' . $ex->getMessage();
    die;
}
