<?php
class Customers
{
    private $id_customer;
    private $full_name;
    private $email;
    private $phone;
    private $address;

    function getIdCustomer()
    {
        return $this->id_customer;
    }

    function getFullName()
    {
        return $this->full_name;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getAddress()
    {
        return $this->address;
    }
}