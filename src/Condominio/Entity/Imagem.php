<?php

namespace Condominio\Entity;


class Imagem
{
    
    private $id;
    private $idr;
    private $file;
    
    public function getId() {
        return $this->id;
    }

    public function getIdr() {
        return $this->idr;
    }

    public function getFile() {
        return $this->file;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdr($idr) {
        $this->idr = $idr;
    }

    public function setFile($file) {
        $this->file = $file;
    }



}
