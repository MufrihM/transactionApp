<?php
session_start();

require_once("../../database/connection.php");
require_once("../../model/transaksi.php");

$id_user = $_SESSION['id_user'];

$query =
    mysqli_query(
        $db,
        "SELECT * FROM transaksi 
    join customers on transaksi.id_customer = customers.id_customer
    join users on customers.id_user = users.id_user
    where users.id_user = $id_user"
    );

$index = 1;
while ($row = mysqli_fetch_array($query)) {
    $transaksi = new Transaksi(
        $row['id_transaksi'],
        $row['id_customer'],
        $row['date_transaksi'],
        $row['name_transaksi'],
        $row['total_transaksi'],
        $row['type_transaksi']
    );

    $type_name = ucwords($transaksi->getTypeTransaksi());
    $type = $transaksi->getTypeTransaksi() === 'pemasukan' ? 'status delivered' : 'status cancelled';

    echo "<tr>
                        <td> {$index} </td>
                        <td>{$transaksi->getNameTransaksi()}</td>
                        <td>{$transaksi->getDateTransaksi()}</td>
                        <td>
                            <p class='{$type}'>{$type_name}</p>
                        </td>
                        <td> <strong>Rp{$transaksi->getTotalTransaksi()}</strong></td>
                    </tr>";
    $index++;
}

if ($index == 1) {
    echo "<tr>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                    </tr>";
}

$db->close();