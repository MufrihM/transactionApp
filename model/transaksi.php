<?php

class Transaksi
{
    private $id_transaksi;
    private $id_customer;
    private $date_transaksi;
    private $name_transaksi;
    private $total_transaksi;
    private $type_transaksi;

    function __construct($id_transaksi, $id_customer, $date_transaksi, $name_transaksi, $total_transaksi, $type_transaksi)
    {
        $this->id_transaksi = $id_transaksi;
        $this->id_customer = $id_customer;
        $this->date_transaksi = $date_transaksi;
        $this->name_transaksi = $name_transaksi;
        $this->total_transaksi = $total_transaksi;
        $this->type_transaksi = $type_transaksi;
    }

    function getIdTransaksi()
    {
        return $this->id_transaksi;
    }

    function getIdCustomer()
    {
        return $this->id_customer;
    }

    function getDateTransaksi()
    {
        return $this->date_transaksi;
    }

    function getNameTransaksi()
    {
        return $this->name_transaksi;
    }

    function getTotalTransaksi()
    {
        return $this->total_transaksi;
    }

    function getTypeTransaksi()
    {
        return $this->type_transaksi;
    }
}