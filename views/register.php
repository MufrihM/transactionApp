<?php
session_start();

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
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-indigo-600">
    <div class="text-white pt-3 pl-3 fixed">
        <div class="text-xl font-bold">
            MANAJEMEN UANG
        </div>
    </div>
    <div class="flex h-screen justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-3">
            <div class="flex justify-center">
                <div class="text-lg font-semibold">
                    SIGN UP
                </div>
            </div>
            <div class="mt-2">
                <form action="" method="post">
                    <div class="flex">
                        <div class="flex flex-col pr-1">
                            <label for="fname">First Name</label>
                            <input class="border border-black rounded-sm pl-1" type="text" name="fname"
                                placeholder="Nama depan" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="lname">Last Name</label>
                            <input class="border border-black rounded-sm pl-1" type="text" name="lname"
                                placeholder="Nama belakang">
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="flex flex-col">
                            <label for="email">Email</label>
                            <input class="border border-black rounded-sm pl-1" type="email" name="email"
                                placeholder="abc@mail.com" required>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="flex flex-col">
                            <label for="pass">Password</label>
                            <input class="border border-black rounded-sm pl-1" type="password" name="password"
                                placeholder="Masukkan password" autocomplete="on" minlength="6" required>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="flex flex-col">
                            <label for="confirm">Confirm Password</label>
                            <input class="border border-black rounded-sm pl-1" type="password" name="confirm-password"
                                placeholder="Konfirmasi password" autocomplete="on" minlength="6" required>
                        </div>
                    </div>
                    <div class="flex justify-center mt-6 mb-2">
                        <button class="bg-indigo-600 rounded-md py-1 px-3 text-white hover:bg-indigo-500" type="submit">
                            SIGN UP
                        </button>
                    </div>
                    <div class="flex justify-center text-sm mb-3">
                        <div class="">
                            Apakah anda sudah memiliki akun?
                        </div>
                        <a class="ml-1 underline hover:text-indigo-600" href="./login.php">Login</a>
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

<script src="../controller/form-handling/register.js"></script>

</html>