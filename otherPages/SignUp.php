<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="Sign.css">
</head>

<body>
    <form id="frame" method="post" enctype="multipart/form-data">
        <h2 style="margin-bottom: 50px;">Cadastro</h2>
        <div>
            <label class="form-label">Plano de Fundo</label>
            <input type="file" accept="image/*" class="form-control" id="background" name="background">
        </div>
        <div>
            <label class="form-label">Foto de Perfil</label>
            <input type="file" accept="image/*" class="form-control" id="photo" name="photo">
        </div>
        <div>
            <label class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id" disabled>
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
        <button type="submit" class="btn btn-info">Cadastrar</button>
    </form>
    <?php

    include_once dirname(__FILE__) . "/../Controllers/UserControl.php";
    include_once dirname(__FILE__) . "/../Models/User.php";

    $controler = new UserControl();

    while (true) {
        $id = rand(10000, 99999);

        $verify = $controler->findById($id);

        if ($verify == "") {
            echo "<script>document.getElementById('id').value = {$id} </script>";
            break;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id = $id;
        $name = $_POST["username"];
        $pass = $_POST["password"];
        $photo = $_FILES["photo"];
        $back = $_FILES["background"];

        $verify = $controler->findByName($name);

        if ($verify == "") {
            $backgroundData = file_get_contents($back["tmp_name"]);
            $photoData = file_get_contents($photo["tmp_name"]);

            $photoData == "" ? $photoData = null : $photoData = $photoData;
            $backgroundData == "" ? $backgroundData = null : $backgroundData = $backgroundData;

            $user = new User($backgroundData, $photoData, $id, $name, 0);

            $controler->insert($user, $pass);

            header('location: ../index.php');
        } else {
            echo "<script>document.getElementById('result').innerHTML += 'Nome já existente';</script>";
        }
    }

    ?>
</body>

</html>