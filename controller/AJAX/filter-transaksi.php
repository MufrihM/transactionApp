<?php
session_start();
include '../../database/connection.php';
include ("../../model/transaksi.php");

$id_user = $_SESSION['id_user'];

function setAjaxTransaksi($db, $id_user, $type)
{
    $query =
        mysqli_query(
            $db,
            "SELECT * FROM transaksi 
    join customers on transaksi.id_customer = customers.id_customer
    join users on customers.id_user = users.id_user
    where users.id_user = $id_user and type_transaksi like '%$type%'"
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

        $color_type = $row['type_transaksi'] === 'pemasukan' ? 'bg-green-300' : 'bg-red-300';
        $type_name = ucwords($transaksi->getTypeTransaksi());
        $type = $transaksi->getTypeTransaksi() === 'pemasukan' ? 'status delivered' : 'status cancelled';

        $formatted_number = number_format($transaksi->getTotalTransaksi(), 0, '', '.');

        echo "<tr>
                            <td class='pr-6'>{$transaksi->getNameTransaksi()}</td>
                            <td class='px-5'>{$transaksi->getDateTransaksi()}</td>
                            <td class='px-6' flex><div class='{$color_type} px-2 mx-1 rounded-md'>{$type_name}</div></td>
                            <td class='px-6'>Rp{$formatted_number}</td>
                            <td class='px-6 flex'>
                                <div class='bg-yellow-300 px-2 mx-1 rounded-md'><button class='edit' data-id='{$transaksi->getIdTransaksi()}'>Edit</button></div>
                                <div class='bg-red-500 px-2 mx-1 rounded-md'><button class='delete' data-id='{$transaksi->getIdTransaksi()}'
                            data-type='{$transaksi->getTypeTransaksi()}'
                            data-total='{$transaksi->getTotalTransaksi()}'>Delete</button></div>
                            </td>
                    </tr>";
        $index++;
    }
    if ($index == 1) {
        echo "<tr>
                        <td class='pr-6'>No Data</td>
                        <td class='px-5'>No Data</td>
                        <td class='px-6'>No Data</td>
                        <td class='px-6'>No Data</td>
                        <td class='px-6'>No Data</td>
                    </tr>";
    }

    $db->close();
}
;

switch ($_GET['type']) {
    case 'all':
        setAjaxTransaksi($db, $id_user, 'pe');
        break;
    case 'pemasukan':
        setAjaxTransaksi($db, $id_user, 'pemasukan');
        break;
    case 'pengeluaran':
        setAjaxTransaksi($db, $id_user, 'pengeluaran');
        break;
    default:
        break;
}