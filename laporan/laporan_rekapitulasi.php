<?php
$koneksi = new mysqli("localhost","root","","kas");

error_reporting(E_ALL^(E_NOTICE|E_WARNING)); 
?>
<title>LAPORAN REKAPITULASI KAS</title>
<div style="margin: 0 auto; width: 90%">
<div align="left"><b>LAPORAN REKAPITULASI KAS JEMAAT ELOHIM LATTA</b></div>
<table align="center" border="1" cellpadding="2" width="100%">
        <thead>
            <tr tr align="center" bgcolor="#C0C0C0">
                <th>No</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Masuk</th>
                <th>Jenis</th>
                <th>Keluar</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;

            $sql = $koneksi-> query("select * from kas");
            while ($data=$sql-> fetch_assoc()){

            ?>


            <tr class="odd gradeX">
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['kode']; ?></td>
                <td><?php echo date('d F Y', strtotime($data['tgl'])); ?></td>
                <td><?php echo $data['keterangan']; ?></td>
                <td align="right"><?php echo number_format($data['jumlah']).",-"; ?></td>
                <td><?php echo $data['jenis']; ?></td>
                <td align="right"><?php echo number_format($data['keluar']).",-"; ?></td>
            </tr>

            <?php
                $total=$total+$data['jumlah'];
                $total_keluar=$total_keluar+$data['keluar'];

                $saldo_akhir = $total-$total_keluar;
                }

            ?>

        </tbody>

            <tr>
                <th colspan="5" style="text-align: center; font-size: 20px">Total Kas Masuk</th>
                <th style="text-align: right; font-size: 17px"><?php echo"Rp." .number_format($total).",-";?></th>
            </tr>

            <tr>
                <th colspan="5" style="text-align: center; font-size: 20px">Total Kas Keluar</th>
                <th style="text-align: right; font-size: 17px"><?php echo"Rp." .number_format($total_keluar).",-";?></th>
            </tr>

            <tr>
                <th colspan="5" style="text-align: center; font-size: 20px">Saldo Akhir</th>
                <th style="text-align: right; font-size: 17px"><?php echo"Rp." .number_format($saldo_akhir).",-";?></th>
            </tr>
</table>
<script>
    window.print(); 
</script>
    