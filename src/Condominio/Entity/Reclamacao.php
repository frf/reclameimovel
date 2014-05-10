<?php

namespace Condominio\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class Reclamacao
{
    
    /**
     * Empreendimento.
     *
     * @var \Condominio\Entity\Empreendimento
     */
    protected $empreendimento;
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
     * Id do Assunto da Reclamacao.
     *
     * @var integer
     */
    protected $idassunto;
    
    /**
     * Titulo.
     *
     * @var varchar 250
     */
    protected $titulo;
    /**
     * Dados do Imovel.
     *
     * @var varchar 250
     */
    protected $dados;
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
    
    protected $visita;
    
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
    public function getIdassunto() {
        return $this->idassunto;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    
    public function getDados() {
        return $this->dados;
    }

    public function setId($id) {
        $this->id = $id;
    }
    /**
     * Idu do usuário.
     *
     * @var int
     */
    public function setIdu($idu) {
        $this->idu = $idu;
    }
    /**
     * Id do empreendimento.
     *
     * @var int
     */
    public function setIde($ide) {
        $this->ide = $ide;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setDt_cadastro(\DateTime $dt_cadastro) {
        $this->dt_cadastro = $dt_cadastro;
    }
    public function setIdassunto($idassunto) {
        $this->idassunto = $idassunto;
        return $this;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
        return $this;
    }

    public function setDados($dados) {
        $this->dados = $dados;
        return $this;
    }
    public function getEmpreendimento() {
        return $this->empreendimento;
    }

    public function setEmpreendimento($empreendimento) {
        $this->empreendimento = $empreendimento;
        return $this;
    }
    public function getVisita() {
        return $this->visita;
    }

    public function setVisita($visita) {
        $this->visita = $visita;
        return $this;
    }







}
