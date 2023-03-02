<?php

	$id = $_GET['id'];

	$sql = $koneksi-> query("delete from kode_kas where id ='$id'");

	if ($sql){
        ?>
        <script type="text/javascript">
        // alert("Hapus Data Berhasil");
        window.location.href="?page=kode_kas";
        </script>
        <?php 
    }


?>
