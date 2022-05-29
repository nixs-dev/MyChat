<?php
class Message
{

    public $ID;
    public $idRemetente;
    public $idDestinatario;
    public $conteudo_texto;
    public $conteudo_blob;

    public function __construct($ID, $idRemetente, $idDestinatario, $conteudo_texto, $conteudo_blob)
    {
        $this->ID = $ID;
        $this->idRemetente = $idRemetente;
        $this->idDestinatario = $idDestinatario;
        $this->conteudo_texto = $conteudo_texto;
        $this->$conteudo_blob = $conteudo_blob;
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

    public function setConteudoTexto($conteudo_texto)
    {
        $this->conteudo_texto = $conteudo_texto;
    }
    
    public function setConteudoBlob($conteudo_blob)
    {
        $this->conteudo_blob = $conteudo_blob;
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

    public function getConteudoTexto()
    {
        return $this->conteudo_texto;
    }
    
    public function getConteudoBlob()
    {
        return $this->conteudo_blob;
    }
}
