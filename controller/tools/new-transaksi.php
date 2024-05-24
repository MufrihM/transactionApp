<?php
session_start();
include '../../database/connection.php';

$id_user = $_SESSION['id_user'];

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
} else {
    echo 'Could not prepare statement!';
}
$stmt->close();
$db->close();