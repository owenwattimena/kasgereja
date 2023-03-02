<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             DATA PENGGUNA
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Password</th>
                                            <th>Level</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;

                                        $sql = $koneksi-> query("select * from tuser");
                                        while ($data=$sql-> fetch_assoc()){

                                        ?>


                                        <tr class="odd gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['username']; ?></td>
                                            <td><?php echo $data['nama_lengkap']; ?></td>
                                            <td><?php echo $data['password']; ?></td>
                                            <td><?php echo $data['level']; ?></td>
                                            <td><img src="images/<?php echo $data['foto'] ?>" width="50" heigth="50" alt=""></td>
                                            <td>
                                                <a id="edit_data" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['id'] ?>" data-username="<?php echo $data['username'] ?>" data-nama_lengkap="<?php echo $data['nama_lengkap'] ?>"data-password="<?php echo $data['password'] ?>" data-level="<?php echo $data['level'] ?>" data-foto="<?php echo $data['foto'] ?>" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a>

                                                <a onclick="return confirm('Yakin Akan Menghapus Data Ini....????')" href="?page=user&aksi=hapus&id= <?php echo $data['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</a>
                                            </td>
                                        </tr>

                                        <?php
                                            
                                            }

                                        ?>

                                    </tbody>

                                      

                                </table>
                            </div>

                        <!--halaman tambah data-->

                        <div class="panel-body">
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
                              Tambah Data
                            </button>

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Form Tambah Data User</h4>
                                        </div>
                                        <div class="modal-body">

                                          <form role="form" method="POST" enctype="multipart/form-data">

                                            <div class="form-group">
                                                    <label>Id</label>
                                                    <input class="form-control" type="number" name="id" />
                                            </div>

                                            <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control"name="username" placeholder="Input Username" />
                                            </div>

                                            <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input class="form-control"name="nama_lengkap" placeholder="Input Nama Lengkap" />
                                            </div>

                                            <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" name="password" />
                                            </div>

                                            <label for="">Level</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="level" class="form-control show-tick" />
                                                        <option value="">--Pilih Level--</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="klasis">Klasis</option>
                                                        <option value="sinode">Sinode</option>
                                                    </select>
                                            </div>

                                            <div class="form-group">
                                                    <label>Foto</label>
                                                    <input type="file" name="foto" class="form-line" />
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
                    
                        <?php
                            if (isset($_POST['simpan'])) {

                                $id = $_POST['id'];
                                $username = $_POST['username'];
                                $nama_lengkap = $_POST['nama_lengkap'];
                                $password = $_POST['password'];
                                $level = $_POST['level'];

                                $foto = $_FILES['foto']['name'];
                                $lokasi = $_FILES['foto']['tmp_name'];
                                $upload = move_uploaded_file($lokasi, "images/" .$foto);

                                if ($upload){


                                $sql = $koneksi-> query ("insert into tuser (id, username, nama_lengkap, password, level, foto) values('$id', '$username', '$nama_lengkap', '$password', '$level', '$foto')");

                                if ($sql){
                                    ?>
                                        <script type="text/javascript">
                                            alert("Simpan Data Berhasil");
                                            window.location.href="?page=user";
                                        </script>
                                    <?php 
                                }
                            }

                          }
                        ?>

                      <!--Akhir halaman tambah data-->

                      <!--halaman ubah-->

                      <div class="panel-body">
                            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Form Edit Data User</h4>
                                        </div>
                                        <div class="modal-body" id="modal_edit">

                                         <form role="form" method="POST" enctype="multipart/form-data">

                                            <div class="form-group">
                                                    <label>Id</label>
                                                    <input class="form-control" name="id" id="id" readonly />
                                            </div>

                                            <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control"name="username" placeholder="Input Username" id="username"/>
                                            </div>

                                            <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input class="form-control"name="nama_lengkap" placeholder="Input nama lengkap" id="nama_lengkap"/>
                                            </div>

                                            <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" name="password" id="password" />
                                            </div>

                                            <label for="">Level</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select  name="level" class="form-control show-tick">
                                                        <option value="">--Pilih Level--</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="klasis">Klasis</option>
                                                        <option value="sinode">Sinode</option>
                                                    </select>
                                            </div>

                                            <div class="form-group">
                                                    <label>Foto</label>
                                                    <input type="file" name="foto" class="form-line"/>
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
                          $(document).on("click", "#edit_data", function(){

                             var id = $(this).data('id');
                             var username = $(this).data('username');
                             var nama_lengkap = $(this).data('nama_lengkap');
                             var password = $(this).data('password');
                             var level = $(this).data('level');
                             var foto = $(this).data('foto');

                             $("#modal_edit #id").val(id);
                             $("#modal_edit #username").val(username);
                             $("#modal_edit #nama_lengkap").val(nama_lengkap);
                             $("#modal_edit #password").val(password);
                             $("#modal_edit #level").val(level);
                             $("#modal_edit #foto").val(foto);
                          })
                      </script>

                      <?php 

                        if (isset($_POST['ubah'])) {

                            $id = $_POST['id'];
                            $username = $_POST['username'];
                            $nama_lengkap = $_POST['nama_lengkap'];
                            $password = $_POST['password'];
                            $level = $_POST['level'];
                            $foto = $_FILES['foto']['name'];
                            $lokasi = $_FILES['foto']['tmp_name'];
                            $upload = move_uploaded_file($lokasi, "images/" .$foto);

                            if ($upload){

                            $sql = $koneksi-> query ("update tuser set username = '$username', nama_lengkap = '$nama_lengkap', password = '$password', level = '$level', foto = '$foto' where id='$id' ");

                            if ($sql){
                                    ?>
                                        <script type="text/javascript">
                                            alert("Ubah Data Berhasil");
                                            window.location.href="?page=user";
                                        </script>
                                    <?php 
                            }
                          } 
                        }
                    ?>
                      <!--Akhir halaman ubah-->

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
                      $(document).ready(function () {
                          $('#dataTables-example').dataTable();
                      });
              </script>
                   <!-- CUSTOM SCRIPTS -->
              <script src="assets/js/custom.js"></script>