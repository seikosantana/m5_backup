<?php
    session_start();
?>
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
                $_SESSION["id"] = $id;
                $_SESSION["role"] = $role;
                $_SESSION["logged_in"] = true;
            }
            else {
                $_SESSION["logged_in"] = false;
            }
            header("location: index.php#upload");
        }
    }
?>