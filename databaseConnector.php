<?php

$usuario = 'root';
$senha = 'santodeus123';
$banco = 'mychat';

try {
    $conn = new PDO('mysql:host=localhost;dbname=' . $banco, $usuario, $senha);
} catch (Exception $ex) {
    echo 'Erro na conexão com o banco: ' . $ex->getMessage();
    die;
}
