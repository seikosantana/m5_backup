<?php
require_once("db.php");

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
  $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "<pre>File " . basename($_FILES["file"]["name"]) . " sudah terupload. Tunggu selagi file diproses.</pre>";
    $dataSiswa = [];

    // Open the file for reading
    if (($h = fopen("$target_file", "r")) !== FALSE) {
      // Each line in the file is converted into an individual array that we call $data
      // The items of the array are comma separated
      while (($data = fgetcsv($h, 1000, ";")) !== FALSE) {
        // Each individual array is being pushed into the nested array
        $dataSiswa[] = $data;
      }

      foreach ($dataSiswa as list($nis, $nama, $kelas, $spp, $bagian)) {
        $namaSanitized = mysqli_real_escape_string($db, $nama);
        $sql = "INSERT INTO siswa (nis, nama, kelas, spp, bagian) VALUES ({$nis}, '{$namaSanitized}', '{$kelas}', '{$spp}', '{$bagian}')";
        if (!$db->query($sql) === TRUE) {
          echo "<pre>$sql\n$db->error</pre>";
        }
        
        // Close the file
      }
      fclose($h);
      unlink($target_file);
    } else {
      echo "Maaf, ada kesalahan dalam mengupload dan memproses file.";
    }
  }
}
?>
<a href="./#upload">Kembali ke halaman upload</a>
