<?php

namespace Condominio\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

class Reclamacao
{
    /**
     * Reclamacao id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Id do Usuario.
     *
     * @var integer
     */
    protected $idu;

    /**
     * Id do Empreendimento.
     *
     * @var integer
     */
    protected $ide;
    
    /**
     * Titulo.
     *
     * @var varchar 250
     */
    protected $titulo;
    /**
     * Descricao.
     *
     * @var text
     */
    protected $descricao;

    /**
     * Data de Cadastro.
     *
     * @var datetime
     */
    protected $dt_cadastro;

    public function getId() {
        return $this->id;
    }

    public function getIdu() {
        return $this->idu;
    }

    public function getIde() {
        return $this->ide;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDt_cadastro() {
        return $this->dt_cadastro;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdu($idu) {
        $this->idu = $idu;
    }

    public function setIde($ide) {
        $this->ide = $ide;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setDt_cadastro(\DateTime $dt_cadastro) {
        $this->dt_cadastro = $dt_cadastro;
    }
    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }


}
