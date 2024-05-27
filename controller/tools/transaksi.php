<?php
session_start();
include '../../database/connection.php';

$id_user = $_SESSION['id_user'];

function setNewTransaksi($db, $id_user){
    if ($stmt = $db->prepare(
        'INSERT INTO transaksi (id_transaksi, id_customer, date_transaksi, name_transaksi, total_transaksi, type_transaksi) 
    VALUES (NULL, (select id_customer from customers where id_user = ?), ?, ?, ?, ?)'
    )) {
        $stmt->bind_param(
            'issss',
            $id_user,
            $_POST['date'],
            $_POST['name'],
            $_POST['total'],
            $_POST['type']
        );
        $stmt->execute();
        $stmt->close();

        if ($cash_amount = $db->prepare(
            'UPDATE cash SET total_cash = total_cash + ? WHERE id_customer = (select id_customer from customers where id_user = ?)'
        )) {
            
            $total_transaksi = 0;
            switch($_POST['type']) {
                case 'pemasukan':
                    $total_transaksi = $_POST['total'];
                    break;
                case 'pengeluaran':
                    $total_transaksi = -$_POST['total'];
                    break;
            }
            
            $cash_amount->bind_param('ii', $total_transaksi, $id_user);
            $cash_amount->execute();
            $cash_amount->close();
        } else {
            echo 'Could not prepare statement!';
        }
    } else {
        echo 'Could not prepare statement!';
    }
}

function setUpdateTransaksi($db, $id_user, $data){
    if ($stmt = $db->prepare(
        'UPDATE transaksi 
        SET name_transaksi = ?, date_transaksi = ?, total_transaksi = ?, type_transaksi = ? 
        WHERE id_transaksi = ?'
    )) {
        
        $stmt->bind_param(
            'ssisi',
            $data['name'],
            $data['date'],
            $data['total'],
            $data['type'],
            $data['id']
        );
        $stmt->execute();
        $stmt->close();

        if ($cash_amount = $db->prepare(
            'UPDATE cash SET total_cash = total_cash + ? WHERE id_customer = (select id_customer from customers where id_user = ?)'
        )) {

            $new_total = 0;
            switch ($data['type']) {
                case 'pemasukan':
                    $new_total = $data['total'] - ($data['oldtype'] == 'pemasukan' ? $data['oldtotal'] : -$data['oldtotal']);
                    break;
                case 'pengeluaran':
                    $new_total = -$data['total'] - ($data['oldtype'] == 'pemasukan' ? $data['oldtotal'] : -$data['oldtotal']);
                    break;
            }
            
            $cash_amount->bind_param('ii', $new_total, $id_user);
            $cash_amount->execute();
            $cash_amount->close(true);
    } else {
        echo 'Could not prepare statement!';
    }
}}

function setDeleteTransaksi($db, $id_user){
    if ($stmt = $db->prepare('DELETE FROM transaksi WHERE id_transaksi = ?')) {
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();
        $stmt->close();

        $new_total = 0;
        switch ($_POST['type']) {
            case 'pemasukan':
                $new_total = $_POST['total'];
                break;
            case 'pengeluaran':
                $new_total = -$_POST['total'];
                break;
        }

        if ($cash_amount = $db->prepare(
            'UPDATE cash SET total_cash = total_cash - ? WHERE id_customer = (select id_customer from customers where id_user = ?)'
        )) {
            $cash_amount->bind_param('ii', $new_total, $id_user);
            $cash_amount->execute();
            $cash_amount->close();
    } else {
        echo 'Could not prepare statement!';
    }
    } else {
        echo 'Could not prepare statement!';
    }
}

switch ($_GET['action']) {
    case 'create':
        setNewTransaksi($db, $id_user);
        break;
    case 'update':
        setUpdateTransaksi($db, $id_user, $_POST);
        break;
    case 'delete':
        setDeleteTransaksi($db, $id_user);
        break;
    default:
        break;
}

$db->close();