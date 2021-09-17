<?php

require_once dirname(__FILE__) . "/../databaseConnector.php";
require_once dirname(__FILE__) . "/../Models/User.php";

class UserControl
{

    public function findAll()
    {
        global $conn;

        $qry = $conn->query("SELECT * FROM usuarios");
        $items = array();

        while ($row = $qry->fetch()) {
            $items[] = new User($row["Fundo"], $row["Imagem"], $row["ID"], $row["Nick"], $row["UltimaVez"]);
        }

        return $items;
    }

    public function findByName($name)
    {
        global $conn;

        $qry = $conn->prepare("SELECT * FROM usuarios WHERE Nick = :name");
        $qry->bindParam(":name", $name);

        $qry->execute();

        $item = $qry->fetch();

        return $item;
    }

    public function findById($id)
    {
        global $conn;

        $qry = $conn->prepare("SELECT * FROM usuarios WHERE ID = :id");
        $qry->bindParam(":id", $id);

        $qry->execute();

        $item = $qry->fetch();

        return $item;
    }

    public function checkUserName($name)
    {
        global $conn;

        $qry = $conn->prepare("SELECT * FROM usuarios WHERE Nick = :name");
        $qry->bindParam(":name", $name);

        $qry->execute();

        if ($qry->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($user, $pass)
    {
        global $conn;

        $qry = $conn->prepare("SELECT * FROM usuarios WHERE Nick = :user and Senha = :pass");
        $qry->bindParam(":user", $user);
        $qry->bindParam(":pass", $pass);

        $qry->execute();

        if ($qry->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($userObj, $pass)
    {
        global $conn;

        $qry = $conn->prepare("INSERT INTO usuarios VALUES (:fnd, :img, :id, :name, :pass, :stat)");
        $qry->bindValue(":fnd", $userObj->getFundo(), PDO::PARAM_LOB);
        $qry->bindValue(":img", $userObj->getImagem(), PDO::PARAM_LOB);
        $qry->bindValue(":id", $userObj->getID());
        $qry->bindValue(":name", $userObj->getNick());
        $qry->bindParam(":pass", $pass);
        $qry->bindValue(":stat", $userObj->getStatus());

        $qry->execute();
    }
}
