<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container p-5">
        <div class="row">
            <h1 class="text-center">Form Belanja</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Produk Pilihan</label>
                    <select class="form-select" name="produk" id="produk">
                        <option value="">-- Pilih Produk --</option>
                        <option value="TV">TV</option>
                        <option value="Kulkas">Kulkas</option>
                        <option value="Mesin Cuci">Mesin Cuci</option>
                        <option value="AC">AC</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="1">
                </div>
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="text" class="form-control" id="total_harga" name="total_harga" disabled>
                </div>
                <button type="submit" name="proses" class="btn btn-success">Submit</button>
                <button type="reset" name="proses" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    function formatAngka(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function hitung() {
        var produk = document.getElementById('produk').value;
        var jumlah = parseInt(document.getElementById('jumlah').value);
        var harga_satuan;
        switch (produk) {
            case 'TV':
                harga_satuan = 1500000;
                break;
            case 'Kulkas':
                harga_satuan = 1000000;
                break;
            case 'Mesin Cuci':
                harga_satuan = 1300000;
                break;
            case 'AC':
                harga_satuan = 2000000;
                break;
            default:
                harga_satuan = 0
                break;
        }
        var hasil = harga_satuan * (!isNaN(jumlah) ? jumlah : 0);
        document.getElementById('total_harga').value = formatAngka(hasil);
    }
    hitung();
    document.getElementById('produk').addEventListener('change', hitung);
    document.getElementById('jumlah').addEventListener('input', hitung);
    </script>
</body>

</html>

<?php
function format_matauang($angka){
    $rupiah = number_format($angka, 0, ',', '.');
    return 'Rp '.$rupiah;
}

if(isset($_POST['proses'])) {
    $nama = $_POST['nama'];
    $produk = $_POST['produk'];
    $jumlah = $_POST['jumlah'];
    $harga_satuan;
    switch ($produk) {
        case 'TV':
            $harga_satuan = 1500000;
            break;
        case 'Kulkas':
            $harga_satuan = 1000000;
            break;
        case 'Mesin Cuci':
            $harga_satuan = 1300000;
            break;
        case 'AC':
            $harga_satuan = 2000000;
            break;
        default:
            $harga_satuan = 0;
            break;
    }

    $total_belanja = $harga_satuan * $jumlah;
    $diskon = $total_belanja * 0.2;
    $ppn = ($total_belanja - $diskon) * 0.1;
    $harga_bersih = ($total_belanja - $diskon) + $ppn;
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Invoice Pembelanjaan
                </div>
                <div class="card-body">
                    <p><strong>Nama Pelanggan :</strong> <?= $nama ?></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Belanja</th>
                                <th>Potongan Diskon</th>
                                <th>PPN</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $produk ?></td>
                                <td><?= $jumlah ?></td>
                                <td><?= format_matauang($harga_satuan) ?></td>
                                <td><?= format_matauang($total_belanja) ?></td>
                                <td><?= format_matauang($diskon) ?></td>
                                <td><?= format_matauang($ppn) ?></td>
                                <td><?= format_matauang($harga_bersih) ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" class="text-right">Total : </th>
                                <td><?= format_matauang($harga_bersih) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    Terima kasih atas pembelian Anda!
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>