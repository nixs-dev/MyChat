<?php
class Message
{

    public $ID;
    public $idRemetente;
    public $idDestinatario;
    public $conteudo;

    public function __construct($ID, $idRemetente, $idDestinatario, $conteudo)
    {
        $this->ID = $ID;
        $this->idRemetente = $idRemetente;
        $this->idDestinatario = $idDestinatario;
        $this->conteudo = $conteudo;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function setIdRemetente($idRemetente)
    {
        $this->idRemetente = $idRemetente;
    }

    public function setIdDestinatario($idDestinatario)
    {
        $this->idDestinatario = $idDestinatario;
    }

    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getIdRemetente()
    {
        return $this->idRemetente;
    }

    public function getIdDestinatario()
    {
        return $this->idDestinatario;
    }

    public function getConteudo()
    {
        return $this->conteudo;
    }
}
