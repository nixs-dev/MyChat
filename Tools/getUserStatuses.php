<?php

require_once dirname(__FILE__) . "/../databaseConnector.php";
require_once dirname(__FILE__) . "/../Models/User.php";

global $conn;

$qry = $conn->query("SELECT * FROM usuarios");
$items = array();

while ($row = $qry->fetch()) {
    $lastDateTime = explode(" ", $row["UltimaVez"]);
    $currentDateTime = explode(" ", date('Y-m-d H:i:s'));
    $lastTime = explode(":", $lastDateTime[1]);
    $currentTime = explode(":", $currentDateTime[1]);

    if($lastTime[0] == $currentTime[0] && $lastTime[1] == $currentTime[1]) {
        $status = "Online";
    }
    else {
        $status = $lastDateTime[1];
    }

    $items[] = new User(base64_encode($row["Fundo"]), base64_encode($row["Imagem"]), $row["ID"], $row["Nick"], $status);
}




echo json_encode($items);