<?php

require_once dirname(__FILE__) . "/database.php";
require_once dirname(__FILE__) . "/../models/message.php";

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
