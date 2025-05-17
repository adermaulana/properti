<?php
include '../koneksi.php';
session_start();

if($_SESSION['status'] != 'login' || !isset($_SESSION['username_admin'])){
    header("location:../pelanggan");
}

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Pemesanan_" . date('Ymd') . ".xls");

// Query dasar
 $query = "SELECT t.*, pr.nama_properti_222146, pr.harga_222146 
                                    FROM transaksi_222146 t
                                    JOIN properti_222146 pr ON t.id_properti_222146 = pr.id_properti_222146";

                          // Create a conditions array to collect all WHERE conditions
                          $conditions = [];

                          // Filter based on periode
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

                          // If the logged-in user is a customer, add a condition for filtering by user ID
                          if(isset($_SESSION['id_pelanggan'])) {
                              $id_pengguna = $_SESSION['id_pelanggan'];
                              $conditions[] = "t.id_pengguna_222146 = '$id_pengguna'";
                          }

                          // Now add the WHERE clause only if there are conditions
                          if (!empty($conditions)) {
                              $query .= " WHERE " . implode(" AND ", $conditions);
                          }

                          // Finally add the ORDER BY clause
                          $query .= " ORDER BY t.tanggal_transaksi_222146 DESC";

                          // Execute the query
                          $result = mysqli_query($koneksi, $query);

                          // Check for errors
                          if (!$result) {
                              echo "Error in query: " . mysqli_error($koneksi);
                              echo "<br>Query: " . $query;
                          }
?>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Nama Properti</th>
            <th>Harga Properti</th>
            <th>Tanggal Transaksi</th>
            <th>Metode Pembayaran</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $total = 0;
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $harga = $row['harga_222146'];
                $total += $harga;
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['id_transaksi_222146'] ?></td>
            <td><?= $row['nama_properti_222146'] ?></td>
            <td>Rp. <?= number_format($harga, 0, ',', '.') ?></td>
            <td><?= $row['tanggal_transaksi_222146'] ?></td>
            <td><?= ucfirst($row['metode_pembayaran_222146']) ?></td>
            <td><?= $row['status_222146'] ?></td>
        </tr>
        <?php
            }
        }
        ?>
        <tr>
            <td colspan="3" align="right"><strong>Total:</strong></td>
            <td><strong>Rp. <?= number_format($total, 0, ',', '.') ?></strong></td>
            <td colspan="3"></td>
        </tr>
    </tbody>
</table>