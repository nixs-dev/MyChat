<?php

include_once dirname(__FILE__) . "/databaseConnector.php";

global $conn;

$qry = $conn->prepare("SELECT * FROM usuarios WHERE ID = :id");
$qry->bindValue(":id", 1233);

$qry->execute();

$item = $qry->fetch();

echo "asss" . $item;
