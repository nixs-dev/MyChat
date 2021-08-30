<?php

require_once dirname(__FILE__) . "/../databaseConnector.php";
require_once dirname(__FILE__) . "/../Models/User.php";

global $conn;

$qry = $conn->query("SELECT * FROM usuarios");
$items = array();

while ($row = $qry->fetch()) {
    $items[] = new User($row["Fundo"], $row["Imagem"], $row["ID"], $row["Nick"], $row["Status"]);
}

echo json_encode($items);