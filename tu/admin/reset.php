<?php
    if (isset($_GET["confirm"])) {
        require_once("db.php");
        $db -> query("DELETE FROM siswa");
        header("Location: index.php");
    }
    else
?>
    <p>Apakah anda yakin? Tindakan ini tidak dapat dibatalkan.</p>
    <a href="./reset.php?confirm">Ya</a>