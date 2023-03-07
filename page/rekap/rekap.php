<?php
if (isset($_POST['filter_tgl'])) {
    $mulai = $_POST['tgl_mulai'];
    $selesai = $_POST['tgl_selesai'];
} else {
    $today = date('Y-m-d');
    $mulai = date('Y-m-01', strtotime($today));
    $selesai = date('Y-m-t', strtotime($today));
}
$sql = $koneksi->query("SELECT 
    kas.kode, kas.no_acc, kas.tgl, kas.keterangan, kas.jumlah, kas.keluar, kas.jenis, kode_kas.kode_kas FROM kas 
        LEFT JOIN kode_kas on kas.kode_kas = kode_kas.id
        WHERE kas.tgl BETWEEN '$mulai'
        AND DATE_ADD('$selesai',INTERVAL 1 DAY)
        ");

?>

<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                REKAPITULASI KAS PERIODE <?= date('d F Y', strtotime($mulai)) ?> s/d <?= date('d F Y', strtotime($selesai)) ?>
            </div>
            <div class="panel-body">
                <a href='./laporan/pdf/rekap/index.php?mulai="<?= $mulai ?>"&selesai="<?= $selesai ?>"' target="blank" class="btn btn-default" style="margin-bottom: 0px; height: 45px; width: 120px; font-size: 20px;"><i class="fa fa-print"></i> Cetak</a>

                <div class="col">
                    <form method="post" class="form-inline">
                        <input type="date" name="tgl_mulai" value="<?= $_POST['tgl_mulai'] ?? $mulai ?>" class="form-control" required>
                        <input type="date" name="tgl_selesai" value="<?= $_POST['tgl_selesai'] ?? $selesai ?>" class="form-control ml-3" required>
                        <button type="submit" name="filter_tgl" class="btn btn-info ml-3">Filter</button>
                        <!-- <button type="submit" name="cetak" class="btn btn-info ml-3">Cetak</button> -->
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. ACC</th>
                                <th>Tanggal</th>
                                <th>Kode Kas</th>
                                <th>Keterangan</th>
                                <th>Masuk</th>
                                <th>Jenis</th>
                                <th>Keluar</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            $total = 0;
                            $total_keluar = 0;
                            $saldo_akhir = 0;

                            while ($data = $sql->fetch_assoc()) {

                            ?>


                                <tr class="odd gradeX">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['no_acc']; ?></td>
                                    <td><?php echo date('d F Y', strtotime($data['tgl'])); ?></td>
                                    <td><?php echo $data['kode_kas']; ?></td>
                                    <td><?php echo $data['keterangan']; ?></td>
                                    <td align="right"><?php echo number_format($data['jumlah']) . ",-"; ?></td>
                                    <td><?php echo $data['jenis']; ?></td>
                                    <td align="right"><?php echo number_format($data['keluar']) . ",-"; ?></td>
                                </tr>

                            <?php
                                $total = $total + $data['jumlah'];
                                $total_keluar = $total_keluar + $data['keluar'];

                                $saldo_akhir = $total - $total_keluar;
                            }

                            ?>

                        </tbody>

                        <tr>
                            <th colspan="5" style="text-align: center; font-size: 20px">Total Kas Masuk</th>
                            <th style="text-align: right; font-size: 17px"><?php echo "Rp." . number_format($total) . ",-"; ?></th>
                        </tr>

                        <tr>
                            <th colspan="5" style="text-align: center; font-size: 20px">Total Kas Keluar</th>
                            <th style="text-align: right; font-size: 17px"><?php echo "Rp." . number_format($total_keluar) . ",-"; ?></th>
                        </tr>

                        <tr>
                            <th colspan="5" style="text-align: center; font-size: 20px">Saldo Akhir</th>
                            <th style="text-align: right; font-size: 17px"><?php echo "Rp." . number_format($saldo_akhir) . ",-"; ?></th>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>