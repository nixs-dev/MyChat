<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="styleLogin.css">
</head>

<body>
    <form id="frame" method="post">
        <h2 style="margin-bottom: 50px;">Login</h2>
        <div>
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div>
            <label class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div id="result" style="margin-bottom: 10px; color: red; -webkit-text-stroke: 0.5px black;">
        </div>
        <button type="submit" class="btn btn-info">Entrar</button>
        <a href="otherPages/SignUp.php" style="margin-top: 50px;"><label>Não tenho uma conta</label></a>
    </form>

</body>

<?php

session_start();

if ((isset($_SESSION['id']) == true) and (isset($_SESSION['username']) == true)) {
    header('location:chat.php');
}


include_once dirname(__FILE__) . "/Controllers/UserControl.php";
include_once dirname(__FILE__) . "/Models/User.php";

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

        header('location:chat.php');
    } else if (!$userOK) {
        echo "<script>document.getElementById('result').textContent = 'Usuário inexistente';</script>";
    } else if (!$passOK) {
        echo "<script>document.getElementById('result').textContent = 'Senha incorreta';</script>";
    }
}
?>

</html>