<?php

class Cash{
    private $id_cash;
    private $id_customer;
    private $total_cash;

    function getIdCash()
    {
        return $this->id_cash;
    }

    function getIdCustomer()
    {
        return $this->id_customer;
    }

    function getTotalCash()
    {
        return $this->total_cash;
    }
}