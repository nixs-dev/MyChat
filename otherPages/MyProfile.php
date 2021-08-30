<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="Profile.css">
    <script src="../Tools/Session.js"></script>
    <script src="../ComponentsCtrl/ProfileEditor.js"></script>
    <script src="../Tools/Profile.js"></script>
</head>

<body onload="fillProfile()">
    <form id="frame" enctype="multipart/form-data">

        <input id="fileInput" type="file" style="display:none;" onchange="ChangeBackground(this);" />
        <input type="button" id="change" value="Mudar" onclick="document.getElementById('fileInput').click();" />

        <h2 id="title">Perfil</h2>
        <div id="profilePhoto">
            <input id="fileInput2" type="file" style="display:none;" onchange="ChangeProfilePhoto(this);" />
            <img id="photo" src="../Images/UserIcon.png" onclick="document.getElementById('fileInput2').click();" />
        </div>
        <div>
            <label>ID : </label>
            <label class="form-label" id="id"></label>
        </div>
        <div>
            <label>Nome de Usuário : </label>
            <label class="form-label" id="username" name="username" onclick="TextToInput('username');"></label>
        </div>
        <div id="ChangePassword" style="display: none">
            <input type="text" id="OldPass" /><br>
            <input type="text" id="NewPass" />
        </div>

        <a href="#" onclick="showPasswordInput()"><label id="txtChangePass">Alterar senha</label></a>

        <input type="button" id="save" value="Salvar" onclick="Save();" disabled="disabled" />
    </form>

</body>

</html>