<?php
require_once("admin/db.php");

$target_dir = "uploads/";
$nis = $_POST["nis"];
$nama = $_POST["nama"];
$spp = $_POST["spp"];
$target_file = $target_dir . $nis . " " . $nama . ".pdf";
$uploadOk = 1;

if (isset($_POST["submit"])) {
  $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "<pre>File " . basename($_FILES["file"]["name"]) . " sudah terupload sebagai $target_file. Tunggu selagi file diproses.</pre>";
    $sppBool;
    if ($spp == "lunas") {
      $sppBool = 1;
    }
    else {
      $sppBool = 0;
    }
    
    $sql = "UPDATE siswa SET spp=$sppBool, bulanan_added=1 WHERE nis=$nis";
    if ($db -> query($sql)) {
      echo "<pre>Data untuk $nis, $nama sudah tersimpan, dengan SPP $spp.<pre>";
    }
  }
}
?>
<a href="./index.php#upload">Kembali ke halaman upload</a>
