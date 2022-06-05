<?php
session_start();

include_once dirname(__FILE__) . "/../controllers/database.php";

global $conn;

$main = $_SESSION["id"];
$user = $_POST['user'];
$message = $_POST["msg_text"];
$blob = $_FILES["msg_blob"];
$blob = !empty($blob["tmp_name"]) ? file_get_contents($blob["tmp_name"]) : NULL;

$qry = $conn->prepare("INSERT INTO mensagens (idRemetente, idDestinatario, Conteudo_texto, Conteudo_blob) VALUES(:main, :user, :msg, :blob)");
$qry->bindParam(":main", $main);
$qry->bindParam(":user", $user);
$qry->bindParam(":msg", $message);
$qry->bindValue(":blob", $blob, PDO::PARAM_LOB);

$qry->execute();