<?php
    require_once("../tu/admin/db.php");
    $kelas = $_GET["kelas"];
    if ($result = $db ->query("SELECT nama, nis from siswa where kelas='$kelas' ORDER BY nama;")) {
        $nama;
        $nis;
        while ($row = $result -> fetch_row()) {
            $nama[] = $row[0];
            $nis[] = $row[1];
        }
        $obj = new stdClass();
        $obj -> nama = $nama;
        $obj -> nis = $nis;
        echo json_encode($obj);
        mysqli_free_result($result);
    }
    
?>