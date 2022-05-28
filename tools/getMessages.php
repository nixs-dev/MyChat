<?php

require_once dirname(__FILE__) . "/../controllers/database.php";
global $conn;

$main = $_GET["main"];
$user = $_GET["user"];

$qry = $conn->prepare("SELECT * FROM mensagens WHERE ((idRemetente = :main and idDestinatario = :user) or (idRemetente = :user and idDestinatario = :main))");
$qry->bindParam(":main", $main);
$qry->bindParam(":user", $user);
$qry->execute();

$items = array();

while ($row = $qry->fetch()) {
    $items[] = ["id" => $row["ID"], "content" => $row["Conteudo"], "sentby" => $row["idRemetente"]];
}

echo json_encode($items);
