<?PHP 

    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: index.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: index.php");
    }

    $koneksi = new mysqli("localhost","root","","kas");


    error_reporting(E_ALL^(E_NOTICE|E_WARNING)); 

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISFO KAS Pantekosta Maluku - Jemaat Passo</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="halaman_admin.php">Hello, <b><?= $_SESSION['username'] ?></b></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> SISTEM INFORMASI KAS & ASET SISFO KAS Pantekosta Maluku - Jemaat Passo&nbsp; 
<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <!-- <img src="assets/img/gpm.png" class="user-image img-responsive"/> -->
					</li>
				
                    <li>
                        <a  href="halaman_admin.php"><i class="glyphicon glyphicon-home"></i> DASHBOARD</a>

                    </li>

                    <li>
                        <a  href="?page=masuk"><i class="glyphicon glyphicon-import"></i> KAS MASUK</a>
                    </li>
                       
                    <li>
                        <a  href="?page=keluar"><i class="glyphicon glyphicon-export"></i> KAS KELUAR</a>
                    </li>
                    <li>
                        <a  href="?page=kode_kas"><i class="glyphicon glyphicon-list"></i> KODE KAS</a>
                    </li>

                    <li>
                        <a  href="?page=rekap"><i class="glyphicon glyphicon-credit-card"></i> REKAPITULASI KAS</a>
                    </li>

                    <li>
                        <a  href="?page=aset"><i class="glyphicon glyphicon-gift"></i> ASET</a>
                    </li>
                   
                    <!-- <li>
                        <a  href="?page=laporan"><i class="glyphicon glyphicon-floppy-save"></i> LAPORAN</a>
                    </li> -->
                     
                    <li>
                        <a  href="?page=user"><i class="glyphicon glyphicon-user"></i> MANAJEMEN USER</a>
                    </li>

                </ul>
                    
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
    
                        <?php

                            $page = $_GET['page'];
                            $aksi = $_GET['aksi'];

                            if ($page == "masuk"){
                                if ($aksi == "") {
                                    include "page/kas_masuk/masuk.php";
                                }
                                if ($aksi == "hapus") {
                                    include "page/kas_masuk/hapus.php";
                                }
                            }elseif ($page == "keluar"){
                                if ($aksi == "") {
                                    include "page/kas_keluar/keluar.php";
                                }
                                if ($aksi == "hapus") {
                                    include "page/kas_keluar/hapus.php";
                                }
                            }elseif ($page == "kode_kas"){
                                if ($aksi == "") {
                                    include "page/kode_kas/kode.php";
                                }
                                if ($aksi == "hapus") {
                                    include "page/kode_kas/hapus.php";
                                }
                            }
                            elseif ($page == "rekap"){
                                if ($aksi == "") {
                                    include "page/rekap/rekap.php";
                                }
                            }elseif ($page == "user"){
                                if ($aksi == "") {
                                    include "page/user/user.php";
                                }
                                if ($aksi == "hapus") {
                                    include "page/user/hapus.php";
                                }
                            }elseif ($page == ""){
                                    include "home.php";
                                }
                            elseif ($page == "aset"){
                                if ($aksi == "") {
                                    include "page/aset/aset.php";
                                }
                                if ($aksi == "hapus") {
                                    include "page/aset/hapus.php";
                                }
                            }elseif ($page == "laporan"){
                                if ($aksi == "") {
                                    include "page/laporan/laporan.php";
                                }
                                if ($aksi == "laporan") {
                                    include "./laporan/laporan_aset.php";
                                }
                            }
 
                        ?>

                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
