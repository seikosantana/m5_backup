<?php
    $data = json_decode(file_get_contents('php://input'), true);
    $nis = $data["nis"];
    $status = $data["status"];
    if (isset($nis) and isset($status)) {
        require_once("admin/db.php");
        $sql = "UPDATE siswa SET spp=$status WHERE nis=$nis";
        $json = new stdClass();
        if ($result = $db->query($sql)) {
            $json->status = "200";
        }
        else {
            $json->status = "500";
        }
        echo json_encode($json);
    }
    
?>