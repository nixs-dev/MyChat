<?php

include_once dirname(__FILE__) . "/../controllers/database.php";

global $conn;

$currentDateTime = date('Y-m-d H:i:s');
$userId = $_POST["user"];

$qry = $conn->prepare("UPDATE usuarios SET UltimaVez = '" . $currentDateTime . "' WHERE ID = " . $userId . ";");
$qry->execute();