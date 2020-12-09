<?php

class User {
    private $id;
    private $login;
    private $email;
    private $salt;
    private $pass;

    public function __construct(int $id, string $login, string $email, string $salt, string $pass) {
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->salt = $salt;
        $this->pass = $pass;
    }

    public function getId(): int {
        return $this->id;
    }


    public function getLogin(): string {
        return $this->login;
    }


    public function getEmail(): string {
        return $this->email;
    }


    public function setEmail(string $email) {
        $this->email = $email;
    }


    public function getSalt(): string {
        return $this->salt;
    }


    public function setSalt(string $salt) {
        $this->salt = $salt;
    }


    public function getPass(): string {
        return $this->pass;
    }


    public function setPass(string $pass) {
        $this->pass = $pass;
    }

}