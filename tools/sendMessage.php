<?php

include_once dirname(__FILE__) . "/../controllers/database.php";

global $conn;

$main = $_GET['main'];
$user = $_GET['user'];
$message = $_GET["msg"];

$qry = $conn->query("SELECT MAX(ID) FROM mensagens");
$id = $qry->fetch()[0] + 1;


$qry = $conn->prepare("INSERT INTO mensagens VALUES(:id, :main, :user, :msg, :blob)");
$qry->bindParam(":id", $id);
$qry->bindParam(":main", $main);
$qry->bindParam(":user", $user);
$qry->bindParam(":msg", $message);
$qry->bindValue(":blob", NULL, PDO::PARAM_LOB);

$qry->execute();
