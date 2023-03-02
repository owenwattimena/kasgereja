<?php
if (isset($_POST['simpan'])) {

    $kode = $_POST['kode'];

    $sql = $koneksi->query("INSERT INTO kode_kas (kode_kas)values('$kode')");

    if ($sql) {
?>
        <script type="text/javascript">
            alert("Simpan Data Berhasil");
            window.location.href = "?page=kode_kas";
        </script>
<?php
    }
}


$sql = $koneksi->query("SELECT * FROM kode_kas");

?>

<div class="row mt-4">

    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                KODE KAS
            </div>

            <!--halaman tambah data-->
            <div class="panel-body">
                <div class="col">
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
                        Tambah Data
                    </button>


                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Form Tambah Data</h4>
                                </div>
                                <form role="form" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Kode Kas</label>
                                            <input class="form-control" name="kode" placeholder="Kode Kas" />
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            // var_dump($sql->fetch_assoc());
                            // $sql = $koneksi->query("select * from kas where jenis = 'keluar'");
                            while ($data = $sql->fetch_assoc()) {

                            ?>


                                <tr class="odd gradeX">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['kode_kas']; ?></td>
                                    <td>
                                        <!-- <a id="edit_data" data-toggle="modal" data-target="#edit" data-no_acc="<?= $data['no_acc'] ?>" data-id="<?php echo $data['kode'] ?>" data-keterangan="<?php echo $data['keterangan'] ?>" data-tgl="<?php echo $data['tgl'] ?>" data-jml="<?php echo $data['keluar'] ?>" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a> -->

                                        <a onclick="return confirm('Yakin Akan Menghapus Data Ini....????')" href="?page=kode_kas&aksi=hapus&id=<?php echo $data['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</a>
                                    </td>
                                </tr>

                            <?php
                                $total = $total + $data['keluar'];
                            }

                            ?>

                        </tbody>

                    </table>
                </div>


                <!--Akhir halaman tambah data-->

                <!--halaman ubah-->

                
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