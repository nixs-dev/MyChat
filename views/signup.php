<?php
include_once dirname(__FILE__) . "/../controllers/user.php";
include_once dirname(__FILE__) . "/../models/user.php";

$controler = new UserControl();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["username"];
    $pass = $_POST["password"];
    $photo = $_FILES["photo"];
    $back = $_FILES["background"];

    $verify = $controler->findByName($name);

    if ($verify == "") {
        $backgroundData = !empty($back["tmp_name"]) ? file_get_contents($back["tmp_name"]) : NULL;
        $photoData = !empty($photo["tmp_name"]) ? file_get_contents($photo["tmp_name"]) : NULL;
        
        $user = new User($backgroundData, $photoData, NULL, $name, date('Y-m-d H:i:s'));

        if($controler->insert($user, $pass)) {
            header('location: /index.php');
        }
        else {
            echo "<script>document.getElementById('result').innerHTML += 'Erro ao realizar seu cadastro';</script>";
        }
    } else {
        echo "<script>document.getElementById('result').innerHTML += 'Nome já existente';</script>";
    }
}

?>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="/static/css/signup.css">
</head>
<body>
    <form id="frame" method="post" enctype="multipart/form-data">
        <h2>Cadastro</h2>
        <div class="inputs">
            <div>
                <label class="form-label">Plano de Fundo</label>
                <input type="file" accept="image/*" class="form-control" id="background" name="background">
            </div>
            <div>
                <label class="form-label">Foto de Perfil</label>
                <input type="file" accept="image/*" class="form-control" id="photo" name="photo">
            </div>
            <div>
                <label class="form-label">Nome de usuário</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div>
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div id="result" style="margin-bottom: 10px; color: red; -webkit-text-stroke: 0.5px black;">
            </div>
            <button type="submit" class="btn">Cadastrar</button>
        </div>
    </form>
</body>
</html>