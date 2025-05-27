<?php
include '../koneksi.php';
session_start();

// Check if user is logged in
if($_SESSION['status'] != 'login' || !isset($_SESSION['username_admin'])){
  header("location:../pelanggan");
}

// Include TCPDF library
require_once('../tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Laporan Pemesanan Properti');
$pdf->SetSubject('Laporan PDF');
$pdf->SetKeywords('TCPDF, PDF, properti, laporan');

// Set default header data
$pdf->SetHeaderData('', 0, 'Laporan Pemesanan Properti', 'Dibuat oleh: ' . $_SESSION['nama_admin']);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Create HTML content
$html = '<h2 style="text-align:center">Laporan Pemesanan Properti</h2>';

// Add filter info if any
if(isset($_GET['periode'])) {
    $periode = $_GET['periode'];
    $filter_info = '';
    
    if($periode == 'hari') {
        $filter_info = "Hari: " . (isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'));
    } elseif($periode == 'minggu') {
        $filter_info = "Minggu Ini (".date('d M Y', strtotime('monday this week'))." - ".date('d M Y', strtotime('sunday this week')).")";
    } elseif($periode == 'bulan') {
        $filter_info = "Bulan Ini (".date('M Y').")";
    } elseif($periode == 'custom') {
        $filter_info = "Custom: ".(isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '')." s/d ".(isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '');
    }
    
    $html .= '<p><strong>Filter:</strong> '.$filter_info.'</p>';
}

// Create table header
$html .= '<table border="1" cellpadding="4">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th width="5%">No</th>
                    <th width="15%">ID Transaksi</th>
                    <th width="25%">Nama Properti</th>
                    <th width="15%">Harga</th>
                    <th width="15%">Tanggal</th>
                    <th width="15%">Metode</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>';

// Query data (same as in your riwayat.php)
$no = 1;
$query = "SELECT t.*, pr.nama_properti_222146, pr.harga_222146 
          FROM transaksi_222146 t
          JOIN properti_222146 pr ON t.id_properti_222146 = pr.id_properti_222146";

$conditions = [];
if(isset($_GET['periode'])) {
    $periode = $_GET['periode'];
    
    if($periode == 'hari') {
        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
        $conditions[] = "DATE(t.tanggal_transaksi_222146) = '$tanggal'";
    } 
    elseif($periode == 'minggu') {
        $minggu_awal = date('Y-m-d', strtotime('monday this week'));
        $minggu_akhir = date('Y-m-d', strtotime('sunday this week'));
        $conditions[] = "DATE(t.tanggal_transaksi_222146) BETWEEN '$minggu_awal' AND '$minggu_akhir'";
    } 
    elseif($periode == 'bulan') {
        $bulan_awal = date('Y-m-01');
        $bulan_akhir = date('Y-m-t');
        $conditions[] = "DATE(t.tanggal_transaksi_222146) BETWEEN '$bulan_awal' AND '$bulan_akhir'";
    } 
    elseif($periode == 'custom' && isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
        $tanggal_awal = $_GET['tanggal_awal'];
        $tanggal_akhir = $_GET['tanggal_akhir'];
        $conditions[] = "DATE(t.tanggal_transaksi_222146) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    }
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$query .= " ORDER BY t.tanggal_transaksi_222146 DESC";
$result = mysqli_query($koneksi, $query);

while($row = mysqli_fetch_array($result)) {
    // Format price
    $harga = 'Rp. ' . number_format($row['harga_222146'], 0, ',', '.');
    
    // Determine status color
    $status_color = '';
    switch($row['status_222146']) {
        case 'pending': $status_color = 'background-color:#fff3cd;'; break;
        case 'dikonfirmasi': 
        case 'lunas': $status_color = 'background-color:#d1e7dd;'; break;
        case 'batal': $status_color = 'background-color:#f8d7da;'; break;
    }
    
    $html .= '<tr>
                <td width="5%">'.$no++.'</td>
                <td width="15%">'.$row['id_transaksi_222146'].'</td>
                <td width="25%">'.$row['nama_properti_222146'].'</td>
                <td width="15%">'.$harga.'</td>
                <td width="15%">'.$row['tanggal_transaksi_222146'].'</td>
                <td width="15%">'.ucfirst($row['metode_pembayaran_222146']).'</td>
                <td width="10%" style="'.$status_color.'">'.ucfirst($row['status_222146']).'</td>
              </tr>';
}

$html .= '</tbody></table>';

// Add summary information
$html .= '<p style="margin-top:10px;"><strong>Total Data: </strong>'.($no-1).' transaksi</p>';
$html .= '<p><small>Dibuat pada: '.date('d/m/Y H:i:s').'</small></p>';

// Print text using writeHTML()
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('laporan_pemesanan_'.date('YmdHis').'.pdf', 'I');

// Close database connection
mysqli_close($koneksi);
?>