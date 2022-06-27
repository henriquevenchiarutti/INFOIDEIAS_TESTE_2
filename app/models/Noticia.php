<?php



use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Noticia extends Model
{
    private $id;
    private $titulo;
    private $texto;
    private $data_ultima_atualizacao;
    private $data_cadastro;

    public function initialize()
    {
        $this->setSource("noticia");
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->titulo;
    }

    public function setTitle($title)
    {
        $this->titulo = $title;
    }

    public function getText()
    {
        return $this->texto;
    }

    public function setText($text)
    {
        $this->texto = $text;
    }

    public function getLastUpdateDate()
    {
        return $this->data_ultima_atualizacao;
    }

    public function setLastUpdateDate()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->data_ultima_atualizacao = date('y-m-d h:i:s');
    }

    public function getRegisterDate()
    {
        return $this->data_cadastro;
    }

    public function setRegisterDate()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->data_cadastro = date('y-m-d h:i:s');
    }
    
}
