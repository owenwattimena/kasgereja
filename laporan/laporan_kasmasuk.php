<?php
$koneksi = new mysqli("localhost", "root", "", "kas");

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<title>LAPORAN KAS MASUK</title>
<div style="margin: 0 auto; width: 90%">
    <div align="left"><b>DATA KAS MASUK GEREJA PENTAKOSTA MALUKU - PASSO</b></div>
    <table align="center" border="1" cellpadding="2" width="100%">
        <tr align="center" bgcolor="#C0C0C0">
            <th>No</th>
            <th>No. ACC</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
        </tr>

        <?php
        $no = 1;

        $mulai = $_GET['mulai'];
        // die($mulai);
        $selesai = $_GET['selesai'];
        $sql = $koneksi->query("SELECT * FROM kas WHERE jenis = 'masuk' AND tgl BETWEEN $mulai AND DATE_ADD($selesai,INTERVAL 1 DAY)");
        while ($data = $sql->fetch_assoc()) {

        ?>

            <tr class="odd gradeX">
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['no_acc'] ?></td>
                <td><?php echo date('d F Y', strtotime($data['tgl'])) ?></td>
                <td><?php echo $data['keterangan']; ?></td>
                <td align="right"><?php echo number_format($data['jumlah']) . ",-" ?></td>
            </tr>

        <?php

            $total = $total + $data['jumlah'];
        }
        ?>

        <tr>
            <th colspan="4" style="text-align: center; font-size: 20px">Total Kas Masuk</th>
            <th style="text-align: right; font-size: 17px"><?php echo "Rp." . number_format($total) . ",-"; ?></th>
        </tr>
    </table>
    <script>
        window.print();
    </script>