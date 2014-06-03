<?php

namespace Condominio\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class Noticia
{
    
    protected $id;
    protected $descricao;
    protected $dtCadastro;
    protected $autor;
    protected $autoremail;
    protected $categoria;
    
    public function getId() {
        return $this->id;
    }

   
    public function getDtCadastro() {
        return $this->dtCadastro;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDtCadastro($dtCadastro) {
        $this->dtCadastro = $dtCadastro;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getAutoremail() {
        return $this->autoremail;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
        return $this;
    }

    public function setAutoremail($autoremail) {
        $this->autoremail = $autoremail;
        return $this;
    }



    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }



}
