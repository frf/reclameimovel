<?php

namespace Condominio\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    protected $id;
    protected $name;
    protected $email;
    protected $idface;
    protected $link;
    protected $gender;
    protected $role;
    protected $password;
    protected $salt;
    protected $username;
    
    private $enabled;
    private $accountNonExpired;
    private $credentialsNonExpired;
    private $accountNonLocked;


    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIdface() {
        return $this->idface;
    }

    public function getLink() {
        return $this->link;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setIdface($idface) {
        $this->idface = $idface;
        return $this;
    }

    public function setLink($link) {
        $this->link = $link;
        return $this;
    }

    public function setGender($gender) {
        $this->gender = $gender;
        return $this;
    }
    

     /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
    
     /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }
    public function getEnabled() {
        return $this->enabled;
    }

    public function getAccountNonExpired() {
        return $this->accountNonExpired;
    }

    public function getCredentialsNonExpired() {
        return $this->credentialsNonExpired;
    }

    public function getAccountNonLocked() {
        return $this->accountNonLocked;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
        return $this;
    }

    public function setAccountNonExpired($accountNonExpired) {
        $this->accountNonExpired = $accountNonExpired;
        return $this;
    }

    public function setCredentialsNonExpired($credentialsNonExpired) {
        $this->credentialsNonExpired = $credentialsNonExpired;
        return $this;
    }

    public function setAccountNonLocked($accountNonLocked) {
        $this->accountNonLocked = $accountNonLocked;
        return $this;
    }





}
