<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="Profile.css">
</head>

<body>
    <form id="frame" method="post" enctype="multipart/form-data">
        <h2 style="margin-bottom: 50px;">Perfil</h2>
        <div>
            <img id="photo" src="../Images/UserIcon.png" />
        </div>
        <div>
            <label class="form-label" id="id">ID : </label>
        </div>
        <div>
            <label class="form-label" id="username">Nome de Usuário : </label>
        </div>
    </form>
</body>

<?php

include_once dirname(__FILE__) . "/../Models/User.php";
include_once dirname(__FILE__) . "/../Controllers/UserControl.php";

$id = $_GET["id"];

$ctrl = new UserControl();

$user = $ctrl->findById($id);

if ($user == "") {
    die;
}

echo "

<script>

";

if ($user['Fundo'] != null) {
    echo "document.getElementById('frame').style.backgroundImage = \"url('data:image/jpg;charset=utf8;base64," . base64_encode($user['Fundo']) . "')\";";
}

if ($user['Imagem'] != null) {
    echo "document.getElementById('photo').src = 'data:image/jpg;charset=utf8;base64," . base64_encode($user['Imagem']) . "';";
}

echo "
    
    document.getElementById('id').innerHTML += ${user['ID']};
    document.getElementById('username').innerHTML += '${user['Nick']}';

</script>

";

?>

</html>