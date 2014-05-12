<?php

namespace Condominio\Entity;


class Empreendimento
{
    protected $empresa;
    /**
     * Reclamacao id.
     *
     * @var integer
     */
    protected $id;
    
    /**
     * Reclamacao ide empresa.
     *
     * @var integer
     */
    protected $ide;
    
    /**
     * IdNome do Empreendimento.
     *
     * @var integer
     */
    protected $idnome;

    /**
     * Nome.
     *
     * @var varchar 250
     */
    protected $nome;
    
    protected $uf;
    protected $cidade;
    protected $visita;

    /**
     * Bairro.
     *
     * @var vahchar 250
     */
    protected $bairro;
    
    public function getId() {
        return $this->id;
    }

    public function getIde() {
        return $this->ide;
    }

    public function getIdnome() {
        return $this->idnome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setIde($ide) {
        $this->ide = $ide;
        return $this;
    }

    public function setIdnome($idnome) {
        $this->idnome = $idnome;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
        return $this;
    }
    public function getUf() {
        return $this->uf;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setUf($uf) {
        $this->uf = $uf;
        return $this;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
        return $this;
    }
    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
        return $this;
    }
    public function getVisita() {
        return $this->visita;
    }

    public function setVisita($visita) {
        $this->visita = $visita;
    }





}
