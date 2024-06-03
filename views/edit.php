<?php
session_start();
include ("../database/connection.php");
require_once ("../model/transaksi.php");

if (!isset($_SESSION["login"])) {
    echo "<script>location.href = 
    './login.php';
    </script>";
    exit;
}

if (!isset($_GET['token']) || strlen(trim($_GET['token'])) <= 20) {
    echo "<script>location.href = 
    './home.php';
    </script>";
    exit;
}

function getSubstring($input, $length)
{
    $result = substr($input, 10, $length);
    return $result;
}

$inputString = $_GET['token'];
$result = getSubstring($inputString, strlen($inputString) - 20);
$id_transaksi = $result;

$query = mysqli_query($db, "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi");
if (mysqli_num_rows($query) == 0) {
    header("Location: ./home.php");
    exit;
}
$row = mysqli_fetch_assoc($query);

$transaksi = new Transaksi(
    $row['id_transaksi'],
    $row['id_customer'],
    $row['date_transaksi'],
    $row['name_transaksi'],
    $row['total_transaksi'],
    $row['type_transaksi']
);
function setSelectedTypeOption($transaksi)
{
    $enum_type = ["pengeluaran", "pemasukan"];

    foreach ($enum_type as $type) {
        $cptlz = ucfirst($type);
        if ($type == $transaksi->getTypeTransaksi()) {
            echo "<option value='$type' selected>$cptlz</option>";
        } else {
            echo "<option value='$type'>$cptlz</option>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex">
    <div class="w-56 h-screen bg-indigo-600 text-white pt-10 pl-3 fixed">
        <p class="text-xl font-bold pb-3 ">MANAJEMEN UANG</p>
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
        </div>
    </div>
    <div class="flex w-screen h-screen justify-center items-center bg-grey-100 ml-56">
        <div class="bg-white w-80 rounded-lg shadow-xl py-3 px-5">
            <div class="flex justify-center mb-2">
                <div class="text-lg font-semibold">Ubah Data</div>
            </div>
            <div class="mt-1">
                <form action="" class="update" data-id="<?php echo $transaksi->getIdTransaksi() ?>"
                    data-oldtotal="<?php echo $transaksi->getTotalTransaksi() ?>"
                    data-oldtype="<?php echo $transaksi->getTypeTransaksi() ?>" method="post">

                    <div class="flex flex-col mb-2">
                        <label for="nama">Nama Transaksi</label>
                        <input class="border border-gray-400 rounded-sm py-1 pl-1" type="text" name="name"
                            value="<?php echo $transaksi->getNameTransaksi() ?>" required>
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="tanggal">Tanggal</label>
                        <input class="border border-gray-400 rounded-sm py-1 pl-1" type="date" name="date"
                            value="<?php echo $transaksi->getDateTransaksi() ?>" required>
                    </div>
                    <div class="flex flex-col mb-2 rounded-sm">
                        <label for="jenis">Jenis Transaksi</label>
                        <select class="border border-gray-400 rounded-sm py-1 pl-1" name="type" id="type" required>
                            <?php setSelectedTypeOption($transaksi); ?>
                        </select>
                        <!-- <label for="jenis">Jenis Transaksi</label>
                        <input class="border border-gray-400 rounded-sm" type="text" name="jenis"> -->
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="jumlah">Jumlah Transaksi</label>
                        <input class="border border-gray-400 rounded-sm py-1 pl-1" type="number" name="total"
                            value="<?php echo $transaksi->getTotalTransaksi() ?>" required>
                    </div>
                    <div class="flex justify-center mt-4 mb-2">
                        <button class="bg-indigo-600 rounded-md text-white font-semibold py-1 px-2"
                            type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="../controller/form-handling/transaksi.js"></script>

</html>