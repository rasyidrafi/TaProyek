<?php

session_start();

// timpa session dengan array kosong
$_SESSION = [];
session_unset();

// hancurkan semua session
session_destroy();

// lalu alihkan ke halaman login
header('Location: login.php');
exit;

?>