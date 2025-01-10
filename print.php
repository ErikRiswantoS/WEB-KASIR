<?php 
    @ob_start();
    session_start();
    if (!empty($_SESSION['admin'])) { 
        // Lanjutkan
    } else {
        echo '<script>window.location="login.php";</script>';
        exit;
    }
    require 'config.php';
    include $view;
    $lihat = new view($config);
    $toko = $lihat->toko();
    $hsl = $lihat->penjualan();
?>
<html>
    <head>
        <title>Print Struk</title>
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
            }
            .container {
                width: 100%;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }
            .header, .footer {
                text-align: center;
                margin-bottom: 20px;
            }
            .header p, .footer p {
                margin: 5px 0;
                font-size: 16px;
            }
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            .table th, .table td {
                border: 1px solid #000;
                padding: 10px;
                text-align: left;
            }
            .table th {
                background-color: #f2f2f2;
            }
            .summary {
                margin-top: 20px;
                text-align: right;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <script>window.print();</script>
        <div class="container">
            <div class="header">
                <p><strong><?php echo $toko['nama_toko']; ?></strong></p>
                <p><?php echo $toko['alamat_toko']; ?></p>
                <p>Tanggal: <?php echo date("j F Y, G:i"); ?></p>
                <p>Kasir: <?php echo htmlentities($_GET['nm_member']); ?></p>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($hsl as $isi) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['jumlah']; ?></td>
                        <td>Rp.<?php echo number_format($isi['total'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>

            <div class="summary">
                <?php $hasil = $lihat->jumlah(); ?>
                <p>Total: Rp.<?php echo number_format($hasil['bayar'], 0, ',', '.'); ?>,-</p>
                <p>Bayar: Rp.<?php echo number_format(htmlentities($_GET['bayar']), 0, ',', '.'); ?>,-</p>
                <p>Kembali: Rp.<?php echo number_format(htmlentities($_GET['kembali']), 0, ',', '.'); ?>,-</p>
            </div>

            <div class="footer">
                <p>Terima Kasih Telah Berbelanja di Toko Kami!</p>
            </div>
        </div>
    </body>
</html>
