<?php
session_start();

include_once dirname(__FILE__) . "/controllers/user.php";
include_once dirname(__FILE__) . "/models/user.php";

if ((isset($_SESSION['id']) == true) and (isset($_SESSION['username']) == true)) {
    header('location:/views/chat.php');
}

$ctrl = new UserControl();

$userOK = false;
$passOK = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $userOK = $ctrl->checkUserName($username);
    $passOK = $ctrl->checkPassword($username, $password);

    if ($userOK && $passOK) {
        $user = $ctrl->findByName($username);

        $_SESSION["background"] = base64_encode($user[0]);
        $_SESSION["image"] = base64_encode($user[1]);
        $_SESSION["id"] = $user[2];
        $_SESSION["username"] = $user[3];

        header('location:/views/chat.php');
    } else if (!$userOK) {
        echo "<script>document.getElementById('result').textContent = 'Usuário inexistente';</script>";
    } else if (!$passOK) {
        echo "<script>document.getElementById('result').textContent = 'Senha incorreta';</script>";
   }
}
?>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="/static/css/login.css">
</head>
<body>
    <form id="frame" method="post">
        <h1 style="margin-bottom: 50px;">Login</h1>
        <div class="inputs">
            <div class="input">
                <input type="text" class="form-control" id="username" name="username" placeholder="Nome de usuário">
            </div>
            <div class="input">
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
            </div>

            <div id="result" style="margin-bottom: 10px; color: red; -webkit-text-stroke: 0.5px black;">
            </div>
            <button type="submit" class="btn">Entrar</button>
        </div>
        <a href="/views/signup.php" style="margin-top: 50px;">Não tenho uma conta</a>
   </form>
</body>
</html>
