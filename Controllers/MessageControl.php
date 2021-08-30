<?php

require_once dirname(__FILE__) . "/../databaseConnector.php";
require_once dirname(__FILE__) . "/../Models/Message.php";

class MessageControl
{

    public function findAll()
    {
        global $conn;

        $qry = $conn->query("SELECT * FROM mensagens");
        $items = array();

        while ($row = $qry->fetch()) {
            $items[] = new Message($row["ID"], $row["idRemetente"], $row["idDestinatario"], $row["Conteudo"]);
        }

        return $items;
    }
}
