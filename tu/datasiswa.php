<?php
    require_once("admin/db.php");
    if (isset($_GET["nis"])) {
        $nis = $_GET["nis"];
        $sql = "SELECT * FROM siswa WHERE nis='$nis'";
        $db -> query($sql);
        
        $nama;
        $kelas;
        $spp;
        $bulananStatus;
        $semesterStatus;
        if ($result = $db->query($sql)) {
            while ($row = $result -> fetch_row()) {
                $nama = $row[1];
                $kelas = $row[2];
                $spp = $row[3];
                $bulananStatus = $row[4];
                $semesterStatus = $row[5];
            }
            mysqli_free_result($result);
        }
        $data = new stdClass();
        $data->nama = $nama;
        $data->kelas = $kelas;
        $data->spp = $spp;
        $data->bulananStatus = $bulananStatus;
        $data->semesterStatus = $semesterStatus;
        echo json_encode($data);
    }
    else {
        echo "not set";
    }
?>