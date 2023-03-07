<?php
if (isset($_POST['simpan'])) {

    $kode = $_POST['kode'];
    $keterangan = $_POST['keterangan'];
    $tgl = $_POST['tgl'];
    $jml = $_POST['jml'];
    $kode_kas = $_POST['kode_kas'];


    $sql = $koneksi->query("insert into kas (no_acc, keterangan, tgl, jumlah, jenis, keluar, kode_kas)values('$kode', '$keterangan', '$tgl', 0, 'keluar', '$jml', '$kode_kas')");

    if ($sql) {
?>
        <script type="text/javascript">
            alert("Simpan Data Berhasil");
            window.location.href = "?page=keluar";
        </script>
<?php
    }
}

if (isset($_POST['filter_tgl'])) {
    $mulai = $_POST['tgl_mulai'];
    $selesai = $_POST['tgl_selesai'];
    // $sql = $koneksi->query("SELECT * FROM kas WHERE jenis = 'keluar' AND tgl BETWEEN '$mulai' AND DATE_ADD('$selesai',INTERVAL 1 DAY)");
} else {
    $today = date('Y-m-d');
    $mulai = date('Y-m-01', strtotime($today));
    $selesai = date('Y-m-t', strtotime($today));
    // $sql = $koneksi->query("SELECT * FROM kas WHERE jenis = 'keluar' AND tgl BETWEEN '$mulai' AND DATE_ADD('$selesai',INTERVAL 1 DAY)");
    // $sql = $koneksi->query("SELECT * FROM kas WHERE jenis = 'keluar'");
}
$sql = $koneksi->query("SELECT 
kas.kode, kas.no_acc, kas.tgl, kas.keterangan, kas.keluar, kode_kas.kode_kas FROM kas 
    LEFT JOIN kode_kas on kas.kode_kas = kode_kas.id
    WHERE kas.jenis = 'keluar'
    AND kas.tgl BETWEEN '$mulai'
    AND DATE_ADD('$selesai',INTERVAL 1 DAY)
    ");
// var_dump($sql);
// die;
?>

<div class="row mt-4">

    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                DATA KAS KELUAR
            </div>

            <!--halaman tambah data-->
            <div class="panel-body">
                <div class="col">
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
                        Tambah Data
                    </button>
                    <a href='./laporan/pdf/kas-keluar/index.php?mulai="<?= $mulai ?>"&selesai="<?= $selesai ?>"' target="blank" class="btn btn-default" style="margin-top: 0px; height: 45px; width: 120px; font-size: 20px;"><i class="fa fa-print"></i> Cetak</a>


                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Form Tambah Data</h4>
                                </div>
                                <div class="modal-body">

                                    <form role="form" method="POST" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>No. ACC</label>
                                            <input class="form-control" name="kode" placeholder="Input No. ACC" />
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Kas</label>
                                            <select class="form-control" name="kode_kas">
                                                <?php
                                                $sql_kode_kas = $koneksi->query("SELECT * FROM kode_kas");
                                                while ($value = $sql_kode_kas->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['kode_kas'] ?></option>
                                                <?php
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input class="form-control" name="keterangan" placeholder="Keterangan" />
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input class="form-control" type="date" name="tgl" />
                                        </div>

                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input class="form-control" type="number" name="jml" />
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $total=0;
                            $no = 1;
                            // var_dump($sql->fetch_assoc());
                            // $sql = $koneksi->query("select * from kas where jenis = 'keluar'");
                            while ($data = $sql->fetch_assoc()) {

                            ?>


                                <tr class="odd gradeX">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['no_acc']; ?></td>
                                    <td><?php echo date('d F Y', strtotime($data['tgl'])); ?></td>
                                    <td><?php echo $data['kode_kas']; ?></td>
                                    <td><?php echo $data['keterangan']; ?></td>
                                    <td align="right"><?php echo number_format($data['keluar']) . ",-"; ?></td>
                                    <td>
                                        <a id="edit_data" data-toggle="modal" data-target="#edit" data-no_acc="<?= $data['no_acc'] ?>" data-id="<?php echo $data['kode'] ?>" data-keterangan="<?php echo $data['keterangan'] ?>" data-tgl="<?php echo $data['tgl'] ?>" data-jml="<?php echo $data['keluar'] ?>" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a>

                                        <a onclick="return confirm('Yakin Akan Menghapus Data Ini....????')" href="?page=keluar&aksi=hapus&id= <?php echo $data['kode']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</a>
                                    </td>
                                </tr>

                            <?php
                                $total = $total + $data['keluar'];
                            }

                            ?>

                        </tbody>

                        <tr>
                            <th colspan="4" style="text-align: center; font-size: 20px">Total Kas Keluar</th>
                            <th style="text-align: right; font-size: 17px"><?php echo "Rp." . number_format($total) . ",-"; ?></th>
                        </tr>

                    </table>
                </div>


                <!--Akhir halaman tambah data-->

                <!--halaman ubah-->

                <div class="panel-body">
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Form Edit Data</h4>
                                </div>
                                <div class="modal-body" id="modal_edit">

                                    <form role="form" method="POST">
                                        <input type="hidden" name="kode" id="kode">
                                        <div class="form-group">
                                            <label>Kode</label>
                                            <input class="form-control" name="no_acc" placeholder="Input Kode" id="no_acc" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Kas</label>
                                            <select class="form-control" name="kode_kas">
                                                <?php
                                                $sql_kode_kas = $koneksi->query("SELECT * FROM kode_kas");
                                                while ($value = $sql_kode_kas->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['kode_kas'] ?></option>
                                                <?php
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input class="form-control" name="keterangan" placeholder="Keterangan" id="keterangan" />
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input class="form-control" type="date" name="tgl" id="tgl" />
                                        </div>

                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input class="form-control" type="number" name="jml" id="jml" />
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <input type="submit" name="ubah" value="Ubah" class="btn btn-primary">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="assets/js/jquery-1.10.2.js"></script>
                <script type="text/javascript">
                    $(document).on("click", "#edit_data", function() {

                        var kode = $(this).data('id');
                        var no_acc = $(this).data('no_acc');
                        var keterangan = $(this).data('keterangan');
                        var tgl = $(this).data('tgl');
                        var jml = $(this).data('jml');

                        $("#modal_edit #kode").val(kode);
                        $("#modal_edit #no_acc").val(no_acc);
                        $("#modal_edit #keterangan").val(keterangan);
                        $("#modal_edit #tgl").val(tgl);
                        $("#modal_edit #jml").val(jml);
                    })
                </script>

                <?php

                if (isset($_POST['ubah'])) {
                    // var_dump($_POST);die;
                    $kode = $_POST['kode'];
                    $keterangan = $_POST['keterangan'];
                    $tgl = $_POST['tgl'];
                    $jml = $_POST['jml'];

                    $sql = $koneksi->query("update kas set keterangan = '$keterangan', tgl = '$tgl', jumlah = 0, jenis='keluar', keluar= '$jml' where kode='$kode' ");

                    if ($sql) {
                ?>
                        <script type="text/javascript">
                            alert("Ubah Data Berhasil");
                            window.location.href = "?page=keluar";
                        </script>
                <?php
                    }
                }
                ?>
                <!--Akhir halaman ubah-->

            </div>
        </div>
    </div>
</div>


<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
</script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>