<?php


session_start();

if ((isset($_SESSION['id']) == true) and (isset($_SESSION['username']) == true)) {

    $data = ["background" => $_SESSION["background"], "image" => $_SESSION["image"], "id" => $_SESSION["id"], "username" => $_SESSION["username"]];

    echo json_encode($data);
} else {
    echo "error";
}
