<?php
session_start();

include ("../database/connection.php");
include ("../model/transaksi.php");

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
    where users.id_user = $id_user"
    );

$cash_data = mysqli_query(
    $db,
    "SELECT customers.name, cash.total_cash, 
sum(transaksi.total_transaksi) as 'total_pemasukan', 
(sum(transaksi.total_transaksi) - cash.total_cash) as 'total_pengeluaran'
FROM cash
join customers on customers.id_customer = cash.id_customer
JOIN transaksi on transaksi.id_customer = customers.id_customer
JOIN users on customers.id_user = users.id_user 
WHERE users.id_user = $id_user and transaksi.type_transaksi = 'pemasukan';"
);

$user_cash = mysqli_fetch_assoc($cash_data);
if ($user_cash['total_cash'] == 0) {
    $cash_data_only_expense = mysqli_query(
        $db,
        "SELECT customers.name, cash.total_cash, 
sum(transaksi.total_transaksi) as 'total_pengeluaran',
(sum(transaksi.total_transaksi) + cash.total_cash) as 'total_pemasukan'
FROM cash
join customers on customers.id_customer = cash.id_customer
JOIN transaksi on transaksi.id_customer = customers.id_customer
JOIN users on customers.id_user = users.id_user 
WHERE users.id_user = $id_user and transaksi.type_transaksi = 'pengeluaran';"
    );
    $user_cash = mysqli_fetch_assoc($cash_data_only_expense);
};

$formatted_cash = number_format($user_cash['total_cash'], 0, '', '.');
$user_cash_name = $user_cash['name'];
$user_cash_total = "Rp{$formatted_cash}";
$user_cash_pemasukan = number_format($user_cash['total_pemasukan'], 0, '', '.');
$user_cash_pengeluaran = number_format($user_cash['total_pengeluaran'], 0, '', '.');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex overflow-hidden">
    <!-- sidebar -->
    <div id="sidebar" class="w-56 h-screen bg-indigo-600 text-white pt-10 pl-3 fixed transition-all duration-300">
        <p class="text-xl font-bold pb-3 menu-text">MANAJEMEN UANG</p>
        <div class="text-zinc-400 pt-2">
            <a href="home.php">
                <div class="flex hover:text-white pt-2">
                    <svg class="w-7 h-7 pr-2 icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path
                            d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
                    </svg>
                    <div class="menu-text">
                        Home
                    </div>
                </div>
            </a>
            <a href="tambah.php">
                <div class="flex hover:text-white pt-2">
                    <svg class="w-7 h-7 pt-1 pr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                    </svg>
                    <div class="menu-text">
                        Tambah Data
                    </div>
                </div>
            </a>
            <button id="logout">
                <div class="flex hover:text-white pt-2">
                    <svg class="w-7 h-7 pt-1 pr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                        <path
                            d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                    </svg>
                    <div class="menu-text">
                        Logout
                    </div>
                </div>
            </button>
        </div>
    </div>
    <!-- main content -->
    <dav id="main" class="flex-1 bg-gray-100 ml-56 pt-9 px-5 h-screen">
        <div class="text-2xl font-bold">
            Saldo <?php echo $user_cash_name ?>
        </div>
        <div class="flex flex-col justify-center items-center h-48 bg-indigo-600 mt-3 rounded-lg shadow-xl">
            <div>
                <p class="text-2xl font-semibold text-white"><?php echo $user_cash_total ?></p>
            </div>
            <div class="flex mt-3">
                <div class="flex text-green-400">
                    <div class="mt-2 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
                            <path
                                d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0" />
                        </svg>
                    </div>
                    <p class="text-lg mr-3">Rp<?php echo $user_cash_pemasukan ?></p>
                </div>
                <div class="flex text-red-400">
                    <div class="mt-2 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                            <path
                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0" />
                        </svg>
                    </div>
                    <p class="text-lg">Rp<?php echo $user_cash_pengeluaran ?></p>
                </div>
            </div>
        </div>
        <div class="mt-7">
            <div class="text-2xl font-bold mb-3">
                Transaksi
            </div>
            <div class="flex justify-end">
                <div class="border border-black rounded-lg w-32 bg-white">
                    <form action="#" class="pl-2">
                        <select id="type_transaksi">
                            <option selected value="all">All</option>
                            <option value="pengeluaran">Pengeluaran</option>
                            <option value="pemasukan">Pemasukan</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="mt-2 rounded-lg pl-3 py-2 bg-white shadow-xl">
                <table>
                    <thead class="text-lg">
                        <tr>
                            <th class="pr-6">Nama</th>
                            <th class="px-5">Tanggal</th>
                            <th class="px-6">Jenis</th>
                            <th class="px-6">Total</th>
                            <th class="px-6">Action</th>
                        </tr>
                    </thead>
                    <tbody id="ajax-type">
                        <?php
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
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </dav>
    <script>
    const sidebar = document.getElementById('sidebar');
    const menuTextElement = document.querySelectorAll('.menu-text');
    const main = document.getElementById('main');
    window.addEventListener('resize', () => {
        if (window.innerWidth < 768) {
            sidebar.classList.remove('w-56');
            sidebar.classList.add('w-16');
            main.classList.remove('ml-56');
            main.classList.add('ml-16');
            menuTextElement.forEach(element => {
                element.classList.add('hidden');
            });
        } else {
            sidebar.classList.remove('w-16');
            sidebar.classList.add('w-56');
            main.classList.remove('ml-16');
            main.classList.add('ml-56');
            menuTextElement.forEach(element => {
                element.classList.remove('hidden');
            });
        }
    });

    if (window.innerWidth < 768) {
        sidebar.classList.remove('w-56');
        sidebar.classList.add('w-16');
        main.classList.remove('ml-56');
        main.classList.add('ml-16');
        menuTextElement.forEach(element => {
            element.classList.add('hidden');
        });
    }
    </script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../controller/form-handling/transaksi.js"></script>
<script src="../controller/authentication/user-logout.js"></script>
<script src="../controller/AJAX/script-filter.js"></script>

</html>