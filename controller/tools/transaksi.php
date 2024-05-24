<?php
session_start();
include '../../database/connection.php';

$id_user = $_SESSION['id_user'];

function setNewTransaksi($db, $id_user){
    if ($stmt = $db->prepare(
        'INSERT INTO transaksi (id_transaksi, id_customer, date_transaksi, name_transaksi, total_transaksi, type_transaksi) 
    VALUES (?, (select id_customer from customers where id_user = ?), ?, ?, ?, ?)'
    )) {
        $stmt->bind_param(
            'iissss',
            $_POST['id_transaksi'],
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

switch ($_GET['action']) {
    case 'create':
        setNewTransaksi($db, $id_user);
        break;
    case 'update':
        $film->update($_POST);
        break;
    default:
        break;
}

$db->close();