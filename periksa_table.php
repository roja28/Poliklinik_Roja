<?php
include_once("koneksi.php");

$query = "SELECT periksa.id, 
                 periksa.id_pasien, 
                 periksa.id_dokter, 
                 periksa.tgl_periksa, 
                 periksa.catatan, 
                 periksa.obat, 
                 pasien.nama AS nama_pasien, 
                 dokter.nama AS nama_dokter
          FROM periksa
          LEFT JOIN pasien ON periksa.id_pasien = pasien.id_pasien
          LEFT JOIN dokter ON periksa.id_dokter = dokter.id_dokter";

$result = mysqli_query($mysqli, $query);

?>

<div class="col-md-12 table-container">
    <?php
    if (mysqli_num_rows($result) == 0) {
    ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Obat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">Tidak ada data Periksa</td>
                </tr>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Obat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $data['id'] ?></th>
                        <td><?php echo $data['nama_pasien'] ?></td>
                        <td><?php echo $data['nama_dokter'] ?></td>
                        <td><?php echo $data['tgl_periksa'] ?></td>
                        <td><?php echo $data['catatan'] ?></td>
                        <td><?php echo $data['obat'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
</div>
