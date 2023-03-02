<?php
    $sql = $koneksi-> query("select * from kas");
    while ($data=$sql-> fetch_assoc()) {

        $jml = $data['jumlah'];
        $total_masuk = $total_masuk+$jml;

        $jml_keluar = $data['keluar'];
        $total_keluar = $total_keluar+$jml_keluar;

        $total = $total_masuk-$total_keluar;
    }
?>

<marquee>Selamat Datang Di Sistem Informasi Kas Jemaat Gereja Pentakosta Maluku - Jemaat Passo</marquee>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
         <h2>Halaman Utama</h2>   
            <h5>Pengelolaan Kas Jemaat Gereja Pentakosta Maluku - Jemaat Passo</h5>
        </div>
    </div>              
     <!-- /. ROW  -->
      <hr />
    <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-6">           
<div class="panel panel-back noti-box">
    <span class="icon-box bg-color-green set-icon">
        <i class="glyphicon glyphicon-import"></i>
    </span>
    <div class="text-box" >
        <p class="main-text"><?php echo "Rp." .number_format($total_masuk); ?>,-</p>
        <p class="text-muted">Total Kas Masuk</p>
    </div>
 </div>
 </div>
        <div class="col-md-4 col-sm-6 col-xs-6">           
<div class="panel panel-back noti-box">
    <span class="icon-box bg-color-red set-icon">
        <i class="glyphicon glyphicon-export"></i>
    </span>
    <div class="text-box" >
        <p class="main-text"><?php echo "Rp." .number_format($total_keluar); ?>,-</p>
        <p class="text-muted">Total Kas Keluar</p>
    </div>
 </div>
 </div>
        <div class="col-md-4 col-sm-6 col-xs-6">           
<div class="panel panel-back noti-box">
    <span class="icon-box bg-color-blue set-icon">
        <i class="glyphicon glyphicon-folder-close"></i>
    </span>
    <div class="text-box" >
        <p class="main-text"><?php echo "Rp." .number_format($total); ?>,-</p>
        <p class="text-muted">Sisa Saldo</p>
    </div>
 </div>
 </div>