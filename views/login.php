<?php
session_start();
include ("../database/connection.php");

if (isset($_COOKIE['id_user']) && isset($_COOKIE['token'])) {
    $id_user = $_COOKIE['id_user'];
    $token = $_COOKIE['token'];

    // fetch data from database
    $result = $db->query("SELECT email FROM users WHERE id_user = $id_user");
    $row = mysqli_fetch_assoc($result);

    // check if the token is valid
    if ($token === hash('sha256', $row['email'])) {
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $id_user;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: ../../transactionApp");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-indigo-600">
    <div class="text-white pt-3 pl-3 fixed">
        <div class="text-xl font-bold">
            MANAJEMEN UANG
        </div>
    </div>
    <div class="flex h-screen justify-center items-center">
        <div class="w-80 bg-white rounded-lg shadow-lg p-3">
            <div class="flex justify-center">
                <div class="text-lg font-semibold">
                    LOGIN
                </div>
            </div>
            <div class="mt-2">
                <form action="" method="post">
                    <div class="mt-2">
                        <div class="flex flex-col">
                            <label for="email">Email</label>
                            <input class="border border-black rounded-sm pl-1" type="email" name="email"
                                autocomplete="on" placeholder="abc@mail.com" required>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="flex flex-col">
                            <label for="pass">Password</label>
                            <input class="border border-black rounded-sm pl-1" type="password" name="password"
                                autocomplete="on" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="flex justify-center mt-4 mb-2">
                        <button class="bg-indigo-600 rounded-md py-1 px-3 text-white hover:bg-indigo-500" type="submit">
                            LOGIN
                        </button>
                    </div>
                    <div class="flex justify-center text-sm mb-3">
                        <div class="">
                            Apakah anda belum memiliki akun?
                        </div>
                        <a class="ml-1 underline hover:text-indigo-600" href="./register.php">Sign Up</a>
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

<script src="../controller/form-handling/login.js"></script>

</html>