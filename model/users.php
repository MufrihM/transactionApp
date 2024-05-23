<?php

class Users{
    private $id_user;
    private $username;
    private $password;

    function getIdUser()
    {
        return $this->id_user;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }
}

?>