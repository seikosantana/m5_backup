<?php
session_start();
require_once("admin/db.php");
$bagian = $_SESSION["role"];
if ($bagian == "Web Admin") {
  $bagian = "bagian='sd' or bagian='smp' or bagian='sma'";
} else {
  $bagian = "bagian='$bagian'";
}
$uploadedSql = "SELECT * FROM siswa WHERE ($bagian) AND bulanan_added=1 order by kelas, nama;";
$unuploadedSql = "SELECT * FROM siswa WHERE ($bagian) AND (bulanan_added is NULL OR bulanan_added=0) order by kelas, nama;";

$nunggakSql = "SELECT * FROM siswa WHERE ($bagian) AND spp=0 order by kelas, nama;";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta property="og:title" content="Perguruan Kristen Methodist 5" />
  <meta property="og:image" content="http://methodist5.com/img/banner/building.jpg" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="400" />
  <meta property="og:image:height" content="300" />
  <meta property="og:description" content="Lihat promo dan syarat pendaftaran Methodist 5." />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Keseluruhan RAPOR <?php
                            echo $_SESSION["role"];
                            ?> | PKMI-5</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/css/bootstrap.css" />
  <link rel="stylesheet" href="/css/flaticon.css" />
  <link rel="stylesheet" href="/css/themify-icons.css" />
  <link rel="stylesheet" href="/vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="/vendors/nice-select/css/nice-select.css" />
  <!-- main css -->
  <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
  <?php
  require_once("admin/db.php");
  ?>
  <!--================ Start Header Menu Area =================-->
  <header class="header_area white-header">
    <div class="main_menu">
      <div class="search_input" id="search_input_box">
        <div class="container">
          <form class="d-flex justify-content-between" method="" action="">
            <input type="text" class="form-control" id="search_input" placeholder="Search Here" />
            <button type="submit" class="btn"></button>
            <span class="ti-close" id="close_search" title="Close Search"></span>
          </form>
        </div>
      </div>

      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand" href="index.html">
            <img class="logo-2" src="/img/logo2.png" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span> <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="/">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/profil.html">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/rapor/">Rapor</a>
              </li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                <ul class="dropdown-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="/blog/special/ultahemas/index.html">Pengumuman</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/blog/special/covid/index.html">Kegiatan</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="galeri.html">Galeri</a>
              </li>
              <li class="nav-item submenu dropdown d-none">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Unit</a>
                <ul class="dropdown-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="courses.html">TK</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="course-details.html">SD</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="elements.html">SMP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="elements.html">SMA</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item d-none">
                <a href="#" class="nav-link search" id="search">
                  <i class="ti-search"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================ End Header Menu Area =================-->

  <!--================Home Banner Area =================-->
  <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="banner_content text-center">
              <h2>Keseluruhan</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->

  <!--================ Start About Area =================-->

  <?php

  if (isset($_SESSION["role"])) :
  ?>
    <section class="about_area section_gap" id="upload">
      <form class="container" action="./upload.php" enctype="multipart/form-data" method="POST">
        <div class="row h_blog_item">
          <div class="col-lg-8 offset-lg-2">
            <div class="h_blog_text" id="syarat">
              <div class="h_blog_text_inner left right pb-3 pb-extra">
                <div style="text-align: right;">
                  <p>
                    <?php
                    echo $_SESSION["id"];
                    ?>
                    <a href="logout.php">Logout</a>?
                  </p>
                </div>
                <div class="row">
                  <h2>Belum Terupload</h2>
                  <table>
                    <tr>
                      <th>NIS</th>
                      <th></th>
                      <th>Nama Siswa</th>
                      <th></th>
                      <th>Kelas</th>
                      <th></th>
                    </tr>

                    <?php
                    if ($result = $db->query($unuploadedSql)) {
                      while ($row = $result->fetch_row()) {
                        $nis = $row[0];
                        $nama = $row[1];
                        $kelas = $row[2];
                        $spp = $row[3];
                        echo "<tr>
                              <td>$nis<td>
                              <td>$nama<td>
                              <td>$kelas<td>
                              </tr>";
                      }
                      $count = mysqli_num_rows($result);
                      echo "$count";
                      mysqli_free_result($result);
                    }
                    ?>
                  </table>
                </div>

                <div class="row">
                  <h2>Terupload</h2>
                  <table>
                    <tr>
                      <th>NIS</th>
                      <th></th>
                      <th>Nama Siswa</th>
                      <th></th>
                      <th>Kelas</th>
                    </tr>

                    <?php
                    if ($result = $db->query($uploadedSql)) {
                      while ($row = $result->fetch_row()) {
                        $nis = $row[0];
                        $nama = $row[1];
                        $kelas = $row[2];
                        $spp = $row[3];
                        echo "<tr>
                              <td>$nis<td>
                              <td>$nama<td>
                              <td>$kelas<td>
                              </tr>";
                      }
                      $count = mysqli_num_rows($result);
                      echo "$count";
                      mysqli_free_result($result);
                    }
                    ?>
                  </table>
                </div>

                <div class="row">
                  <h2>Nunggak</h2>
                  <table>
                    <tr>
                      <th>NIS</th>
                      <th></th>
                      <th>Nama Siswa</th>
                      <th></th>
                      <th>Kelas</th>
                    </tr>

                    <?php
                    if ($result = $db->query($nunggakSql)) {
                      while ($row = $result->fetch_row()) {
                        $nis = $row[0];
                        $nama = $row[1];
                        $kelas = $row[2];
                        $spp = $row[3];
                        echo "<tr>
                              <td>$nis<td>
                              <td>$nama<td>
                              <td>$kelas<td>
                              </tr>";
                      }
                      $count = mysqli_num_rows($result);
                      echo "$count";
                      mysqli_free_result($result);
                    }
                    ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <script>
      const cari = document.querySelector("#cari");
      cari.addEventListener("click", (event) => {
        let nis = document.getElementById("nis").value;
        fetch("datasiswa.php?nis=" + nis).then((Response) => {
          Response.json().then((json) => {
            console.log(json);
            let nama = json.nama;
            let kelas = json.kelas;
            let spp = json.spp;
            let sppElement = document.getElementById("spp");
            document.getElementById("nama").value = nama;
            document.getElementById("kelas").value = kelas;
            console.log(spp);
            if (spp == "0") {
              sppElement.selectedIndex = "1";
            } else {
              sppElement.selectedIndex = "0";
            }
          })
        })
        event.preventDefault();
      })
    </script>
  <?php
  else :
  ?>
    <section class="login-area section_gap" id="login">
      <form class="container" action="./login.php" enctype="multipart/form-data" method="POST">
        <div class="row h_blog_item d-flex justify-content-center">
          <div class="h_blog_text col-12 col-sm-8 col-md-6 col-lg-4" id="syarat">
            <div class="h_blog_text_inner left right pb-3 pb-extra">
              <h4>Login</h4>
              <?php
              session_destroy();
              if (isset($_SESSION["logged_in"])) :
              ?>
                <h6>Username atau password salah</h6>
              <?php
              endif;
              ?>
              <div class="font-applied col-12 pl-0">Username</div>
              <input type="text" name="username" class="col-12" required>
              <div class="font-applied mt-3 col-12 pl-0">Password</div>
              <input type="password" name="password" class="col-12" required>
              <div></div>
              <input type="submit" name="login" value="LOGIN" class="submit-btn mt-3 d-flex ml-auto font-applied">
            </div>
          </div>
        </div>
      </form>
    </section>

  <?php
  endif;
  ?>

  <!--================ End About Area =================-->

  <!--================ Start footer Area  =================-->
  <footer class="footer-area section_gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-6 single-footer-widget">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="#">Informasi Pendaftaran</a></li>
            <li><a href="#">Profil Sekolah</a></li>
            <li><a href="#">Galeri</a></li>
            <li><a href="#">Ekstrakurikuler</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 single-footer-widget">
          <h4>Berlangganan</h4>
          <p class="text-white">Ikuti perkembangan dan pengumuman seputar kegiatan dan informasi lainnya.</p>
          <div class="form-wrap" id="mc_embed_signup">
            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
              <input class="form-control" name="EMAIL" placeholder="Alamat email anda" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat email anda'" required="" type="email" />
              <button class="click-btn btn btn-default">
                <span>subscribe</span>
              </button>
              <div style="position: absolute; left: -5000px;">
                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text" />
              </div>

              <div class="info"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="row footer-bottom d-flex justify-content-between">
        <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">By Seiko Santana. <a href="https://wa.me/6285760041622">Need a website?</a></p>
        <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
        <div class="col-lg-4 col-sm-12 footer-social d-none">
          <a href="#"><i class="ti-facebook"></i></a>
          <a href="#"><i class="ti-twitter"></i></a>
          <a href="#"><i class="ti-dribbble"></i></a>
          <a href="#"><i class="ti-linkedin"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <!--================ End footer Area  =================-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="/js/jquery-3.2.1.min.js"></script>
  <script src="/js/popper.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <!-- <script src="/vendors/nice-select/js/jquery.nice-select.min.js"></script> -->
  <script src="/vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="/js/owl-carousel-thumb.min.js"></script>
  <script src="/js/jquery.ajaxchimp.min.js"></script>
  <script src="/js/mail-script.js"></script>
  <!--gmaps Js-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
  <script src="/js/gmaps.min.js"></script>
  <script src="/js/theme.js"></script>
</body>

</html>