<?php
session_start();
?>
<html>
<head>
    <title>Chat</title>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/17c066a4d1.js" crossorigin="anonymous"></script>
    <script src="/static/js/session.js"></script>
    <script src="/static/js/chat.js"></script>
    <script src="/static/js/profile.js"></script>
    <script src="/static/js/popup.js"></script>
    <link rel="stylesheet" href="/static/css/chat.css">
</head>
<body onload="getSession(); setPhotoProfile();">

    <div id="sidebar">
        <div id="profilePhoto">
            <img id="photoMenu" src="/static/img/user_icon.png">
        </div>
        <div id="options">
            <div>
                <a href="/views/my_profile.php"><label>Meu Perfil</label></a>
            </div>
            <div>
                <label>Configurações</label>
            </div>
             <div>
                <label>Bloqueados</label>
            </div>
            <div>
                <label>Sobre</label>
            </div>
        </div>
        <button id="logout" onclick="finishSession()"><img src="/static/img/logout_icon.png"></button>
    </div>
    <div id="bodyPage">
        <div id="usersPanel">
            <div id="searchBar">
                <input type="text" placeholder="Pesquisar">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div id="friends">
                <?php
                    require_once dirname(__FILE__) . "/../models/user.php";
                    require_once dirname(__FILE__) . "/../controllers/user.php";

                    $userProfileModel = "
                                            <div id='UserID' class='profile' onclick='openForm(this.id);'>
                                                <img src='profilePhoto' alt='UserIcon' width='100' height='100'>
                                                <h5 style='text-align: center'>UserName</h5>
                                                <h5 id='status' style='text-align: center; color: #000000'>UserStatus</h5>
                                            </div>
                                        ";

                    $ctrl = new UserControl();

                    $users = $ctrl->findAll();

                    foreach ($users as $user) {

                        if ($user->getId() != $_SESSION['id']) {

                            $profile = $userProfileModel;

                            $profilePhoto = $user->getImagem();

                            if (!is_null($profilePhoto)) {
                                $profile = str_replace("profilePhoto", "data:image/jpg;charset=utf8;base64," . base64_encode($profilePhoto), $userProfileModel);
                            } else {
                                $profile = str_replace("profilePhoto", "/static/img/user_icon.png", $userProfileModel);
                            }

                            $profile = str_replace("UserName", $user->getNick(), $profile);
                            $profile = str_replace("UserID", $user->getId(), $profile);

                            $lastDateTime = explode(" ", $user->getStatus());
                            $currentDateTime = explode(" ", date('Y-m-d H:i:s'));
                            $lastTime = explode(":", $lastDateTime[1]);
                            $currentTime = explode(":", $currentDateTime[1]);

                            if($lastTime[0] == $currentTime[0] && $lastTime[1] == $currentTime[1]) {
                                $status = "Online";
                                $color = "#00FF00";
                            }
                            else {
                                $status = $lastDateTime[1];
                                $color = "#FF0000";
                            }


                            $profile = str_replace("UserStatus", $status, $profile);
                            $profile = str_replace("#000000", $color, $profile);

                            echo $profile;
                        }
                    }
                ?>
            </div>
        </div>
        <div class="form-popup" id="chat">
            <form class="form-container">

                <div id="chat-body">

                </div>

                <div id="chat-footer">
                    <input type="text" id="message" placeholder="Type here" name="message" required>

                    <button type="button" id="send" onclick="sendMessage();"><i class="fas fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>