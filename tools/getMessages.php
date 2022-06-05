<?php
session_start();

require_once dirname(__FILE__) . "/../controllers/database.php";
global $conn;

$main = $_SESSION["id"];
$user = $_GET["user"];

$qry = $conn->prepare("SELECT * FROM mensagens WHERE ((idRemetente = :main and idDestinatario = :user) or (idRemetente = :user and idDestinatario = :main))");
$qry->bindParam(":main", $main);
$qry->bindParam(":user", $user);
$qry->execute();

$items = array();

while ($row = $qry->fetch()) {
    $items[] = ["id" => $row["ID"], "text_content" => $row["Conteudo_texto"], "blob_content" => utf8_encode($row["Conteudo_blob"]), "sentby" => $row["idRemetente"]];
}

echo json_encode($items);
