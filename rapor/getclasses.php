<?php
    require_once("../tu/admin/db.php");
    $sql = "SELECT DISTINCT kelas FROM siswa;";
    if ($result = $db -> query($sql)) {
        $kelas;
        while ($rows = $result -> fetch_row()) {
            $kelas[] = $rows[0];
        }
        echo json_encode($kelas);
        mysqli_free_result($result);
    }
?>