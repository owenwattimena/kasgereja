<?php
require_once '../../../koneksi.php';
require_once '../../../vendor/autoload.php';
use Dompdf\Dompdf;
$mulai = str_replace('"', '', $_GET['mulai']);
$selesai = str_replace('"', '',$_GET['selesai']);

$sql = $koneksi->query("SELECT 
kas.kode, kas.no_acc, kas.tgl, kas.keterangan, kas.jumlah, kas.keluar, kas.jenis, kode_kas.kode_kas FROM kas 
    LEFT JOIN kode_kas on kas.kode_kas = kode_kas.id
    WHERE kas.tgl BETWEEN '$mulai'
    AND DATE_ADD('$selesai',INTERVAL 1 DAY)
    ");

// var_dump($mulai);die;
$table_rows = "";
$no = 0;
$total_masuk = 0;
$total_keluar = 0;
while ($data = $sql->fetch_assoc()) {
    ++$no;
    $table_rows .= "<tr>";
    $table_rows .= "<td class='center'>";
    $table_rows .= $no;
    $table_rows .= "</td>";
    $table_rows .= "<td>";
    $table_rows .= $data['no_acc'];
    $table_rows .= "</td>";
    $table_rows .= "<td>";
    $table_rows .= date('d F Y', strtotime($data['tgl']));
    $table_rows .= "</td>";
    $table_rows .= "<td>";
    $table_rows .= $data['kode_kas'];
    $table_rows .= "</td>";
    $table_rows .= "<td>";
    $table_rows .= $data['keterangan'];
    $table_rows .= "</td>";
    $table_rows .= "<td>";
    $table_rows .= "Rp. " . number_format($data['jumlah']) . ",-";
    $table_rows .= "</td>";
    $table_rows .= "<td>";
    $table_rows .= "Rp. " . number_format($data['keluar']) . ",-";
    $table_rows .= "</td>";
    $table_rows .= "<td>";
    $table_rows .= $data['jenis'];
    $table_rows .= "</td>";

    $table_rows .= "</tr>";
    $total_keluar += intval($data['keluar']);
    $total_masuk += intval($data['jumlah']);
}
$saldo = $total_masuk - $total_keluar;
$table_rows .= '<tr>';
$table_rows .= '<td colspan="5" class="right"><strong>TOTAL KAS MASUK</strong>';
$table_rows .= '</td>';
$table_rows .= '<td colspan="2">';
$table_rows .= "<strong>Rp. " . number_format($total_masuk) . ",-</strong>";
$table_rows .= '</td>';
$table_rows .= '<td>';
$table_rows .= '</td>';
$table_rows .= '</tr>';

$table_rows .= '<tr>';
$table_rows .= '<td colspan="5" class="right"><strong>TOTAL KAS KELUAR</strong>';
$table_rows .= '</td>';
$table_rows .= '<td colspan="2">';
$table_rows .= "<strong>Rp. " . number_format($total_keluar) . ",-</strong>";
$table_rows .= '</td>';
$table_rows .= '<td>';
$table_rows .= '</td>';
$table_rows .= '</tr>';

$table_rows .= '<tr>';
$table_rows .= '<td colspan="5" class="right"><strong>SALDO AKHIR</strong>';
$table_rows .= '</td>';
$table_rows .= '<td colspan="2">';
$table_rows .= "<strong>Rp. " . number_format($saldo) . ",-</strong>";
$table_rows .= '</td>';
$table_rows .= '<td>';
$table_rows .= '</td>';
$table_rows .= '</tr>';
$html = file_get_contents('html.php');
$html = str_replace('{{mulai}}', date('d F Y', strtotime($mulai)), $html);
$html = str_replace('{{selesai}}', date('d F Y', strtotime($selesai)), $html);
$html = str_replace('{{table_rows}}', $table_rows, $html);
// Membuat objek Dompdf
$dompdf = new Dompdf();

// Memasukkan kerangka HTML ke dalam objek Dompdf
$dompdf->loadHtml($html);

// Mengatur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// Merender PDF
$dompdf->render();

// Output laporan PDF
$dompdf->stream("laporan_kas_masuk_keluar.pdf", array("Attachment" => false));
exit(0);