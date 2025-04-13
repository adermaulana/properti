<?php
include '../koneksi.php';

// Set header untuk file PDF
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data Riwayat Pemesanan.xls");
?>

<center>
    <h2>Data Riwayat Pemesanan</h2>
    <?php if(isset($_GET['dari']) && isset($_GET['sampai'])){ ?>
    <h4>Dari Tanggal <?= $_GET['dari'] ?> Sampai Tanggal <?= $_GET['sampai'] ?></h4>
    <?php } ?>
</center>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nomor Kamar</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Durasi Sewa</th>
        <th>Total Harga</th>
        <th>Status</th>
    </tr>
    <?php
    $no = 1;
    $where = "WHERE p.status = 'selesai'";
    
    if(isset($_GET['dari']) && isset($_GET['sampai'])){
        $dari = $_GET['dari'];
        $sampai = $_GET['sampai'];
        $where .= " AND p.tanggal_mulai BETWEEN '$dari' AND '$sampai'";
    }
    
    $tampil = mysqli_query($koneksi, "SELECT p.*,pl.nama,kamar.nomor_kamar FROM pemesanan p
                                                        JOIN pelanggan pl ON p.id_pelanggan = pl.id
                                                         JOIN 
                                                                kamar 
                                                            ON 
                                                                p.id_kamar = kamar.id $where ORDER BY id DESC");
    while ($data = mysqli_fetch_array($tampil)):
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['nomor_kamar'] ?></td>
        <td><?= $data['tanggal_mulai'] ?></td>
        <td><?= $data['tanggal_selesai'] ?></td>
        <td><?= $data['durasi_sewa'] ?> Hari</td>
        <td>Rp. <?= number_format($data['total_harga'], 0, ',', '.') ?></td>
        <td><?= $data['status'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>