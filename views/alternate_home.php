<?php
session_start();

include '../database/connection.php';
include '../model/transaksi.php';

if (!isset($_SESSION["login"])) {
    echo "<script>location.href = 
    './login.php';
    </script>";
    exit;
}

$id_user = $_SESSION['id_user'];

$query =
    mysqli_query(
        $db,
        "SELECT * FROM transaksi 
    join customers on transaksi.id_customer = customers.id_customer
    join users on customers.id_user = users.id_user
    where users.id_user = $id_user;"
    );

$query_cashflow =
    mysqli_query(
        $db,
        "SELECT * FROM transaksi 
    join customers on transaksi.id_customer = customers.id_customer
    join users on customers.id_user = users.id_user
    where users.id_user = $id_user;"
    );

$total_pemasukan = 0;
$total_pengeluaran = 0;

while ($row = mysqli_fetch_array($query_cashflow)) {
    if ($row['type_transaksi'] === 'pemasukan') {
        $total_pemasukan = $row['total_transaksi'];
    } else {
        $total_pengeluaran = $row['total_transaksi'];
    };
};

$cash_data = mysqli_query(
    $db,
    "SELECT customers.name, cash.total_cash, 
((transaksi.total_transaksi)) as 'total_pemasukan'
FROM cash
join customers on customers.id_customer = cash.id_customer
JOIN transaksi on transaksi.id_customer = customers.id_customer
JOIN users on customers.id_user = users.id_user 
WHERE users.id_user = $id_user;"
);

$user_cash = mysqli_fetch_assoc($cash_data);

$formatted_cash = number_format($user_cash['total_cash'], 0, '', '.');
$user_cash_name = $user_cash['name'];
$user_cash_total = "Rp{$formatted_cash}";
$user_cash_pemasukan = number_format($total_pemasukan, 0, '', '.');
$user_cash_pengeluaran = number_format($total_pengeluaran, 0, '', '.');

?>