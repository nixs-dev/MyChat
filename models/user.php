<?php
class User
{

    public $fundo;
    public $imagem;
    public $id;
    public $nick;
    public $status;

    public function __construct($fundo, $imagem, $id, $nick, $status)
    {
        $this->fundo = $fundo;
        $this->imagem = $imagem;
        $this->id = $id;
        $this->nick = $nick;
        $this->status = $status;
    }

    public function setFundo($fundo)
    {
        $this->fundo = $fundo;
    }

    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFundo()
    {
        $i = $this->fundo;

        if (!is_null($i)) {
            return $i;
        } else {
            return null;
        }
    }

    public function getImagem()
    {
        $i = $this->imagem;

        if (!is_null($i)) {
            return $i;
        } else {
            return null;
        }
    }

    public function getID()
    {
        return $this->id;
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
