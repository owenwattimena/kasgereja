<?php
$total_masuk = 0;
$total_keluar = 0;

$sql = $koneksi->query("select * from kas");
while ($data = $sql->fetch_assoc()) {

    $jml = $data['jumlah'];
    $total_masuk = $total_masuk + $jml;

    $jml_keluar = $data['keluar'];
    $total_keluar = $total_keluar + $jml_keluar;

    $total = $total_masuk - $total_keluar;
}
$year = $_GET['tahun'] ?? intval(date('Y'));

$sql = $koneksi->query("SELECT MONTH(tgl) as bulan, SUM(IF(jenis = 'masuk', jumlah, 0)) as total_masuk, SUM(IF(jenis = 'keluar', keluar, 0)) as total_keluar FROM kas WHERE YEAR(tgl) = '$year' GROUP BY MONTH(tgl)");
// Menyiapkan array untuk label bulan dan data penjualan
$labels = array();
$data_masuk = array();
$data_keluar = array();
while ($row = $sql->fetch_assoc()) {
    array_push($labels, date("F", mktime(0, 0, 0, $row['bulan'], 1)));
    array_push($data_masuk, intval($row['total_masuk']));
    array_push($data_keluar, intval($row['total_keluar']));
}

// Menyiapkan array data untuk Google Charts
$data = array(
    array('Bulan', 'Kas Masuk', 'Kas Keluar')
);

foreach ($labels as $index => $bulan) {
    array_push($data, array($bulan, $data_masuk[$index], $data_keluar[$index]));
}
// var_dump($data);
// die;
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
                <div class="text-box">
                    <p class="main-text"><?php echo "Rp." . number_format($total_masuk); ?>,-</p>
                    <p class="text-muted">Total Kas Masuk</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="glyphicon glyphicon-export"></i>
                </span>
                <div class="text-box">
                    <p class="main-text"><?php echo "Rp." . number_format($total_keluar); ?>,-</p>
                    <p class="text-muted">Total Kas Keluar</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="glyphicon glyphicon-folder-close"></i>
                </span>
                <div class="text-box">
                    <p class="main-text"><?php echo "Rp." . number_format($total); ?>,-</p>
                    <p class="text-muted">Sisa Saldo</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-right">
        <div class="form-inline col">
            <form action="" method="get">
                <select name="tahun" id="tahun" class="form-control">
                    <?php
                for ($i = intval(date('Y')); $i > (intval(date('Y')) - 30); $i--) { ?>
                    <option value="<?= $i ?>" <?= $year==$i? 'selected':'' ?>><?= $i ?></option>
                    <?php } ?>
                </select>
                <button type="submit" class="btn btn-info ml-3">Filter</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div id="chart_div"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($data); ?>);
        console.table(<?= json_encode($data); ?>);
        var options = {
            title: 'Kas Masuk dan Keluar ' + `<?= $year ?>`,
            chartArea: {
                width: '50%'
            },
            hAxis: {
                title: 'Jumlah',
                minValue: 0
            },
            vAxis: {
                title: 'Bulan'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>