<?php
if (isset($_POST["username"])) {
    if (isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $id;
        $role;
        if (($username == "seikosantana" && $password == "seikosantana123Qw")) {
            $id = "Seiko Santana";
            $role = "Web Admin";
        } else if (($username == "sd" && $password == "tusdm5")) {
            $id = "Melati";
            $role = "SD";
        } else if (($username == "smp" && $password == "tusmpm5")) {
            $id = "Yuni Kurniawan";
            $role = "SMP";
        } else if (($username == "sma" && $password == "tusmam5")) {
            $id = "Fida";
            $role = "SMA";
        }
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION["role"] = $role;
        header("Location: ./#upload");
    }
}
