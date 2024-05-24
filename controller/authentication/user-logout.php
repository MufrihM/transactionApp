<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

unset($_COOKIE['id_user']);
setcookie('id_user', '', time() - 3600, '/'); // empty value and old timestamp

unset($_COOKIE['token']);
setcookie('token', '', time() - 3600, '/'); // empty value and old timestamp

exit;