<?php

define('HOST', 'localhost');
define('USER', 'root');
define('pass', '');
define('DB', 'pbweb_cashflow');

$db = new mysqli(HOST, USER, pass, DB);

if ($db->connect_errno) {
    die('Tidak dapat terhubung ke database');
}

$db->set_charset('utf8mb4');