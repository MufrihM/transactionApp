<?php
class Customers
{
    private $id_customer;
    private $full_name;
    private $email;
    private $phone;
    private $address;

    function get_id_customer()
    {
        return $this->id_customer;
    }

    function get_full_name()
    {
        return $this->full_name;
    }

    function get_email()
    {
        return $this->email;
    }

    function get_phone()
    {
        return $this->phone;
    }

    function get_address()
    {
        return $this->address;
    }
}