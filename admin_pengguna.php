<?php
include_once("includes/functions.php");
if (isLogged() !== 2) {
    header("Location: index.php ");
}

$page = 9;

$halaman = isset($_GET["halaman"]) ? $_GET["halaman"] : 1;
$awalan = ($halaman > 1) ? ($halaman * $page) - $page : 0;

$sabeb = "SELECT * FROM users LIMIT $awalan, $page";

$result = mysqli_query($clink, "SELECT * FROM users");
$results = mysqli_query($clink, $sabeb);

$tot = mysqli_num_rows($result);

$jmlhalaman = ceil($tot / $page);

?>
<!DOCTYPE html>

<head>
    <title>Daftar Member</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Stylee.css" />
    <script>
        function getareas(cid) {
            $(document).ready(function() {
                $.get("getAreas.php?cid=" + cid, function(data, status) {
                    $("#areaDiv").html(data);
                });
            });
        }
    </script>
</head>

<body>

    <?php
    drawHeader();
    ?>

    <div class="container">
        <h2 class="m-3">Daftar Member </h2>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Pengguna</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($clink, "SELECT * FROM `users` ORDER BY `users`.`UserID` ASC  ");
                if (mysqli_num_rows($result) > 1) {
                    //Show them

                    while ($row = mysqli_fetch_array($results)) {
                        echo "<tr '>
                                    <td>{$row['UserID']}</td>
                                    <td>{$row['UserName']}</td>
                                    <td>{$row['Email']}</td>
                                    <td>{$row['Phone']}</td>
                                    <td> ";
                        if ($row['Status'] == 1) {
                            echo "<a href='usershoworhide.php?UserID={$row['UserID']}' class='btn btn-danger ml-2 ' >Nonaktifkan<a>";
                        } else if ($row['Status'] == 0) {
                            echo "<a href='usershoworhide.php?UserID={$row['UserID']}' class='btn btn-primary ml-2  ' >Aktifkan<a>";
                        }
                        echo "</td> 
                                     
            
            </tr>";
                    }
                } else {
                    outputMessage("Akun Tidak Tersedia", 'warning');
                }
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <?php if ($halaman > 1) : ?>
                        <a class="page-link" href="?halaman=<?= $halaman - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    <?php endif ?>
                </li>

                <?php for ($i = 1; $i <= $jmlhalaman; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>

                <li class="page-item">
                    <?php if ($halaman < $jmlhalaman) : ?>
                        <a class="page-link" href="?halaman=<?= $halaman + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    <?php endif ?>
                </li>
            </ul>
        </nav>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- FOOTER -->
    <div class="footerutama">
        <div class="footer">
            <div class="footer-section" about">
                <h1 class="logo-text">Kontrakan Babeh</h1>
                <p>
                    Kontrakan Babeh adalah sebuah website
                    yang menyediakan layanan untuk pengguna
                    website untuk memasang iklan dan mencari
                    rumah atau kontrakan yang berada di DKI Jakarta.
                    Website ini peruntukan untuk
                    pengguna website yang ingin
                    menyewakan atau mencari tempat tinggal.

                </p>
                <div class="contact">
                    <i class="fas fa-phone">021-87761617</i>
                </div>
                <div class="email">
                    <i class="fas fa-envelope">wandyy85@gmail.com</i>
                </div>
            </div>

            <div class="footer-section" Link">
                <br>
                <br>
                <ul>
                    <a href="#" data-toggle="modal" data-target="#kebijakan">
                        <li>Kebijakan Kami</li>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#cara_Unggah">
                        <li>Cara Unggah Iklan</li>
                    </a>

                </ul>
            </div>

            <!-- Modal Kebijakan Kami -->
            <div class="modal fade" id="kebijakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="exampleModalScrollableTitle">Kebijakan Kami</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <p>Kontrakan Babeh berkomitmen untuk memastikan bahwa privasi Anda terlindungi. Jika kami meminta Anda untuk
                                memberikan informasi tertentu maka Anda dapat di identifikasi saat menggunakan situs laman
                                ini. </p>
                            <p>kontrakan babeh dapat mengubah kebijakan ini dari waktu ke waktu dengan memperbarui halaman ini. Anda harus
                                memeriksa halaman ini secara berkala untuk memastikan bahwa Anda setuju dengan pembaharuan apapun.
                                Kebijakan ini berlaku mulai dibuatnya laman ini. </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal fade" id="cara_Unggah" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="exampleModalScrollableTitle">Pejuntuk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <h5>User Wajib Menjadi Member</h5>
                            <P>User harus member jika ingin memasang iklan di web kontrakan babeh. jika belum, user dapat
                                mendaftar sebagai member terlebih dahulu.</P>
                            <h5>Unggah</h5>
                            <p>User yang sudah menjadi member dapat mengunggah iklan.
                                Panduan cara mengunggah iklan:
                            </p>
                            <span>1. Pastikan anda sudah mendaftar sebagai member kami.*</span><br>
                            <span>2. Isi judul iklan rumah yang ingin disewakan.*</span><br>
                            <span>3. Isi Keterangan iklan secara lengkap, mulai dari fasilitas rumah, lokasi yang lengkap, dan nomer telepon yang aktif.*</span><br>
                            <span>4. Catumkan harga sewa perbulan.*</span><br>
                            <span>5. Unggah gambar rumah (wajib jpg, jpeg, png), maksimal 5 gambar</span><br>
                            <span>6. Pilih kategori, terdapat 2 kategori yaitu rumah atau kontrakan.</span><br>
                            <span>7. Lalu tekan tombol unggah dan otomatis iklan anda terunggah di website kami.</span><br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer2">
                <p>Developed By SOEWANDI 2020</p>
            </div>

            <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>