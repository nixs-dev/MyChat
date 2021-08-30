<?php

Error_reporting(0);

include_once dirname(__FILE__) . "/../databaseConnector.php";
include_once dirname(__FILE__) . "/../Models/User.php";
include_once dirname(__FILE__) . "/../Controllers/UserControl.php";

$ctrl = new UserControl();

$user = [$_FILES['background'], $_FILES['image'], $_POST['id'], $_POST['name']];

$userObj = $ctrl->findById($user[2]);

if (isset($user[0])) {
    $user[0] = file_get_contents($user[0]["tmp_name"]);
} else {
    $user[0] = "null";
}

if (isset($user[1])) {
    $user[1] = file_get_contents($user[1]["tmp_name"]);
} else {
    $user[1] = "null";
}

for ($i = 0; $i <= count($user) - 1; $i++) {
    if ($user[$i] != "null") {
        $userObj[$i] = $user[$i];
    }
}

$qry = $conn->prepare("UPDATE usuarios SET Fundo = :fnd, Imagem = :img, ID = :id, Nick = :name WHERE ID = :id");
$qry->bindParam(":fnd", $userObj[0]);
$qry->bindParam(":img", $userObj[1]);
$qry->bindParam(":id", $userObj[2]);
$qry->bindParam(":name", $userObj[3]);


$qry->execute();
