<?php

class User {
    private $id;
    private $email;
    private $pwd;

    public function __construct($email = null, $pwd = null) { 
        $this->email = $email;
        $this->pwd = $pwd;
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the value of email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get the value of pwd
     */
    public function getPwd() {
        return $this->pwd;
    }
}
?>