<?php
if (isset($_POST['simpan'])) {

    // $kode = $_POST['kode'];
    // var_dump($_FILES);die;
    $nama_brg = $_POST['nama_brg'];
    $jumlah = $_POST['jumlah'];
    $thn_perolehan = $_POST['thn_perolehan'];
    $harga = $_POST['harga'];
    $kondisi = $_POST['kondisi'];
    $lokasi = $_POST['lokasi'];
    $merk = $_POST['merk'];
    $bukti_dokumen = null;
    $atas_nama = $_POST['atas_nama'];
    $keterangan = $_POST['keterangan'];
    if (isset($_FILES['bukti_dokumen']['tmp_name'])) {
        // Proses upload gambar di sini
        $lokasi_file = $_FILES['bukti_dokumen']['tmp_name'];
        $nama_file   = $_FILES['bukti_dokumen']['name'];
        $lokasi_tujuan = "storages/bukti-dokumen-aset/" . $nama_file;

        if (move_uploaded_file($lokasi_file, $lokasi_tujuan)) {
            // echo "File berhasil diupload";
            $bukti_dokumen = $nama_file;
        } else {
            die("File gagal diupload");
        }
    }

    $sql = $koneksi->query(
        "INSERT INTO aset 
            (nama_brg, jumlah, thn_perolehan, harga, kondisi, lokasi, merk, bukti_dokumen, atas_nama, keterangan)
            values
            ('$nama_brg', '$jumlah', '$thn_perolehan', '$harga', '$kondisi', '$lokasi', '$merk', '$bukti_dokumen', '$atas_nama', '$keterangan')"
    );

    if ($sql) {
?>
        <script type="text/javascript">
            alert("Simpan Data Berhasil");
            window.location.href = "?page=aset";
        </script>
    <?php
    }
}

if (isset($_POST['ubah'])) {
    $kode = $_POST['kode'];
    $nama_brg = $_POST['nama_brg'];
    $jumlah = $_POST['jumlah'];
    $thn_perolehan = $_POST['thn_perolehan'];
    $jml = $_POST['harga'];
    $kondisi = $_POST['kondisi'];
    $lokasi = $_POST['lokasi'];
    $merk = $_POST['merk'];
    $atas_nama = $_POST['atas_nama'];
    $keterangan = $_POST['keterangan'];
    $bukti_dokumen = null;

    if ($_FILES['bukti_dokumen']['error'] == 0) {
        // var_dump($_FILES['bukti_dokumen']);die;
        // Proses upload gambar di sini
        $lokasi_file = $_FILES['bukti_dokumen']['tmp_name'];
        $nama_file   = $_FILES['bukti_dokumen']['name'];
        $lokasi_tujuan = "storages/bukti-dokumen-aset/" . $nama_file;

        if (move_uploaded_file($lokasi_file, $lokasi_tujuan)) {
            // echo "File berhasil diupload";
            $bukti_dokumen = $nama_file;

            $result=$koneksi->query("SELECT bukti_dokumen FROM aset WHERE kode='$kode' LIMIT 1");
            // $koneksi->bind_param("i", $kode);
            // $koneksi->execute();
            // $result = $koneksi->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if(file_exists("storages/bukti-dokumen-aset/" . $row['bukti_dokumen'])){
                    unlink("storages/bukti-dokumen-aset/" . $row['bukti_dokumen']);
                }
            }

        } else {
            die("File gagal diupload");
        }
    }
    $query = "UPDATE aset SET 
        nama_brg = '$nama_brg', 
        jumlah = '$jumlah', 
        thn_perolehan = '$thn_perolehan', 
        harga = '$jml', 
        kondisi = '$kondisi', 
        lokasi = '$lokasi', 
        merk = '$merk', 
        atas_nama = '$atas_nama', 
        keterangan = '$keterangan' 
        WHERE kode='$kode'";
    if ($bukti_dokumen != null) {
        $query = "UPDATE aset SET 
        nama_brg = '$nama_brg', 
        jumlah = '$jumlah', 
        thn_perolehan = '$thn_perolehan', 
        harga = '$jml', 
        kondisi = '$kondisi', 
        lokasi = '$lokasi', 
        bukti_dokumen= '$bukti_dokumen',
        merk = '$merk', 
        atas_nama = '$atas_nama', 
        keterangan = '$keterangan' 
        WHERE kode='$kode'";
    }

    $sql = $koneksi->query($query);
    // var_dump($_POST);die;

    if ($sql) {
    ?>
        <script type="text/javascript">
            alert("Ubah Data Berhasil");
            window.location.href = "?page=aset";
        </script>
<?php
    }
}

?>

<!-- Advanced Tables -->
<div class="panel panel-primary">
    <div class="panel-heading">
        DATA ASET JEMAAT
    </div>
    <div class="panel-body">
        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
            Tambah Data
        </button>

        <a href="./laporan/laporan_aset.php" target="blank" class="btn btn-default" style="margin-top: 0px; height: 45px; width: 120px; font-size: 20px;"><i class="fa fa-print"></i> Cetak</a>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Form Tambah Data Aset</h4>
                    </div>
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">


                            <!-- <div class="form-group">
                                        <label>Kode</label>
                                        <input class="form-control" name="kode" placeholder="Input Kode" />
                                    </div> -->

                            <div class="form-group">
                                <label>Nama Aset</label>
                                <input class="form-control" name="nama_brg" placeholder="Nama Aset" />
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Jumlah</label>
                                    <input class="form-control" type="number" name="jumlah" placeholder="Jumlah" />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Harga</label>
                                    <input class="form-control" type="number" name="harga" placeholder="Harga" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Tahun Perolehan</label>
                                    <input class="form-control" type="number" name="thn_perolehan" placeholder="Tahun Perolehan" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Kondisi</label>
                                    <input class="form-control" type="text" name="kondisi" placeholder="kondisi" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Lokasi</label>
                                    <input class="form-control" type="text" name="lokasi" placeholder="Lokasi" />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Merk</label>
                                    <input class="form-control" type="text" name="merk" placeholder="Merk" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Bukti Dokumen</label>
                                    <input class="form-control" type="file" name="bukti_dokumen" placeholder="Bukti Dokumen" />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Atas Nama</label>
                                    <input class="form-control" type="text" name="atas_nama" placeholder="Atas Nama" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
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
    <div class="panel-body">
        <form method="post" class="form-inline">
            <input id="nama_brg" type="text" class="form-control" name="barang" value="<?= $_POST['barang'] ?? '' ?>" placeholder="Nama Barang">
            <button type="submit" name="search" class="btn btn-info btn-sm form-control">CARI</button>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-sm table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No</th>
                        <!-- <th>Kode</th> -->
                        <th>Nama Aset</th>
                        <th>Jumlah</th>
                        <th>Thn Perolehan</th>
                        <th>Harga</th>
                        <th>Kondisi</th>
                        <th>Lokasi</th>
                        <th>Merk</th>
                        <th>Bukti Dokumen</th>
                        <th>Atas Nama</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if (isset($_POST['search'])) {
                        $barang = $_POST['barang'];
                        $sql = $koneksi->query("SELECT * FROM aset WHERE nama_brg LIKE '%$barang%'");
                    } else {
                        $sql = $koneksi->query("SELECT * FROM aset");
                    }
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                        <tr class="odd gradeX">
                            <td><?php echo $no++ ?></td>
                            <!-- <td><?php echo $data['kode']; ?></td> -->
                            <td><?php echo $data['nama_brg']; ?></td>
                            <td><?php echo number_format($data['jumlah']) . "  Bh"; ?></td>
                            <td><?php echo $data['thn_perolehan']; ?></td>
                            <td align="right"><?php echo number_format($data['harga']) . ",-"; ?></td>
                            <td><?php echo $data['kondisi']; ?></td>
                            <td><?php echo $data['lokasi']; ?></td>
                            <td><?php echo $data['merk']; ?></td>
                            <td> <a href="<?php echo '../storages/bukti-dokumen-aset/' . $data['bukti_dokumen']; ?>" target="_blank">Link</a> </td>
                            <td><?php echo $data['atas_nama']; ?></td>
                            <td><?php echo $data['keterangan']; ?></td>
                            <td>
                                <a id="edit_data" data-toggle="modal" data-target="#edit" data-kode="<?= $data['kode'] ?>" data-nama_brg="<?= $data['nama_brg'] ?>" data-jumlah="<?= $data['jumlah'] ?>" data-thn_perolehan="<?= $data['thn_perolehan'] ?>" data-jml="<?= $data['harga'] ?>" data-kondisi="<?= $data['kondisi'] ?>" data-lokasi="<?= $data['lokasi'] ?>" data-merk="<?= $data['merk'] ?>" data-atas_nama="<?= $data['atas_nama'] ?>" data-keterangan="<?= $data['keterangan'] ?>" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a>

                                <a onclick="return confirm('Yakin Akan Menghapus Data Ini....????')" href="?page=aset&aksi=hapus&id= <?php echo $data['kode']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</a>
                            </td>
                        </tr>

                    <?php
                        $total = $total + $data['harga'];
                    }

                    ?>

                </tbody>
                <tfoot>

                    <tr>
                        <th colspan="4" style="text-align: center; font-size: 20px">Total Harga</th>
                        <th style="text-align: right; font-size: 17px"><?php echo "Rp." . number_format($total) . ",-"; ?></th>
                        <th colspan="7"></th>
                    </tr>
                </tfoot>

            </table>
        </div>

        <!--halaman tambah data-->

        <!--Akhir halaman tambah data-->

        <!--halaman ubah-->

        <div class="panel-body">
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Form Edit Data Aset</h4>
                        </div>
                        <div class="modal-body" id="modal_edit">

                            <form role="form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="kode" id="kode">
                                <div class="form-group">
                                    <label>Nama Aset</label>
                                    <input class="form-control" name="nama_brg" placeholder="Nama Aset" id="nama_brg" />
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Jumlah</label>
                                        <input class="form-control" type="number" name="jumlah" placeholder="Jumlah" id="jumlah" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Harga</label>
                                        <input class="form-control" type="number" name="harga" placeholder="Harga" id="jml" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Tahun Perolehan</label>
                                        <input class="form-control" type="number" name="thn_perolehan" id="thn_perolehan" placeholder="Tahun Perolehan" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Kondisi</label>
                                        <input class="form-control" type="text" name="kondisi" placeholder="kondisi" id="kondisi" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Lokasi</label>
                                        <input class="form-control" type="text" name="lokasi" placeholder="Lokasi" id="lokasi" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Merk</label>
                                        <input class="form-control" type="text" name="merk" placeholder="Merk" id="merk" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Bukti Dokumen</label>
                                        <input class="form-control" type="file" name="bukti_dokumen" placeholder="Bukti Dokumen" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Atas Nama</label>
                                        <input class="form-control" type="text" name="atas_nama" id="atas-nama" placeholder="Atas Nama" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
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

                var kode = $(this).data('kode');
                var nama_brg = $(this).data('nama_brg');
                var jumlah = $(this).data('jumlah');
                var thn_perolehan = $(this).data('thn_perolehan');
                var jml = $(this).data('jml');
                var kondisi = $(this).data('kondisi');
                var lokasi = $(this).data('lokasi');
                var merk = $(this).data('merk');
                var atas_nama = $(this).data('atas_nama');
                var keterangan = $(this).data('keterangan');

                $("#modal_edit #kode").val(kode);
                $("#modal_edit #nama_brg").val(nama_brg);
                $("#modal_edit #jumlah").val(jumlah);
                $("#modal_edit #thn_perolehan").val(thn_perolehan);
                $("#modal_edit #jml").val(jml);
                $("#modal_edit #kondisi").val(kondisi);
                $("#modal_edit #lokasi").val(lokasi);
                $("#modal_edit #merk").val(merk);
                $("#modal_edit #atas-nama").val(atas_nama);
                $("#modal_edit #keterangan").val(keterangan);
            })
        </script>
        <!--Akhir halaman ubah-->

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