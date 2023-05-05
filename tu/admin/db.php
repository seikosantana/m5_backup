<?php
    $db_host = "localhost";
    $db_user = "u141779213_seikosantana";
    $db_passowrd = "seikosantana123Qw";
    $db_name = "u141779213_siswa";
    $db = new mysqli("localhost", $db_user, $db_passowrd, $db_name);
    if ($db -> connect_errno) {
        echo "<script>alert('connection failed')</script>";
    }
?>