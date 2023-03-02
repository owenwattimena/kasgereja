<?php
$koneksi = new mysqli("localhost","root","","kas");

error_reporting(E_ALL^(E_NOTICE|E_WARNING)); 
?>
<title>LAPORAN ASET JEMAAT</title>
<div style="margin: 0 auto; width: 90%">
<div align="left"><b>LAPORAN ASET JEMAAT ELOHIM LATTA</b></div>
<table align="center" border="1" cellpadding="2" width="100%">
                <tr align="center" bgcolor="#C0C0C0">
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Thn Perolehan</th>
                    <th>Harga</th>
                    <th>Kondisi</th>
                </tr>
            

                <?php
                $no = 1;

                $sql = $koneksi-> query("select * from aset");
                while ($data=$sql-> fetch_assoc()){

                ?>


               <tr class="odd gradeX">
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['kode']; ?></td>
                <td><?php echo $data['nama_brg']; ?></td>
                <td><?php echo number_format($data['jumlah'])."  Bh"; ?></td>
                <td><?php echo $data['thn_perolehan']; ?></td>
                <td align="right"><?php echo number_format($data['harga']).",-"; ?></td>
                <td><?php echo $data['kondisi']; ?></td>
            </tr>

            <?php
                $total=$total+$data['harga'];
                }

            ?>

            <tr>
            <th colspan="5" style="text-align: center; font-size: 20px">Total Harga</th>
            <th style="text-align: right; font-size: 17px"><?php echo"Rp." .number_format($total).",-";?></th>
         </tr>

           

</table>
<script>
    window.print(); 
</script>
    