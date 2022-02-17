<?php
include_once("includes/functions.php");

// jumlah halaman yg mau di tampilin
$page = 9;

$halaman = isset($_GET["halaman"]) ? $_GET["halaman"] : 1;
$awalan = ($halaman > 1) ? ($halaman * $page) - $page : 0;

$sabeb = "SELECT * FROM advertisments LIMIT $awalan, $page";

$result = mysqli_query($clink, "SELECT * FROM advertisments");
$results = mysqli_query($clink, $sabeb);

$tot = mysqli_num_rows($result);

$jmlhalaman = ceil($tot / $page);

?>
<!DOCTYPE html>

<head>
    <title>Kontrakan Babeh</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="assets/img/Sample 1.PNG" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/img/Sample 2.PNG" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/img/Sample 1.PNG" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>



    <div class="container ">
        <div class="control d-flex  justify-content-around">
            <div class="search text-center">
                <form method="get" action="index.php" class=" ">
                    <select class="select " name="Maincategory">
                        <option value='0'>Semua Kategori</option>
                        <?php
                        $resultcategories = mysqli_query($clink, "SELECT CategoryID , CategoryName FROM categories");
                        while ($rowcategories = mysqli_fetch_assoc($resultcategories)) {
                            echo "<option value='{$rowcategories['CategoryID']}'>{$rowcategories['CategoryName']}</option>";
                        }
                        ?>
                    </select>

                    <input type="submit" class="btn clicksearch" value="Cari">
                </form>
            </div>
        </div>
    </div>
    <div class='container'>
        <div class="btn-group btn-group-justified col-sm-12 m-2">
            <a href="index.php?pricedp" class="btn btnselect ">Harga Terendah</a>
            <a href="index.php?pricepd" class="btn btnselect ">Harga Tertinggi</a>
            <a href="index.php?New" class="btn btnselect ">Baru</a>
        </div>

        <section class="ads">
            <div class="container">
                <div class="row ">

                    <?php

                    if (isset($_GET['pricedp'])) {
                        $results = mysqli_query($clink, "SELECT * FROM `advertisments` ORDER BY `advertisments`.`Price` ASC  ");
                    } else if (isset($_GET['pricepd'])) {
                        $results = mysqli_query($clink, "SELECT * FROM `advertisments` ORDER BY `advertisments`.`Price` DESC ");
                    } else if (isset($_GET['New'])) {
                        $results = mysqli_query($clink, "SELECT * FROM `advertisments` ORDER BY `advertisments`.`AdsID` DESC     ");
                    } else if (isset($_GET['Maincategory']) and $_GET['Maincategory']) {
                        $categoryID = $_GET['Maincategory'];
                        $results = mysqli_query($clink, "SELECT * FROM advertisments , categories where categories.CategoryID= $categoryID and advertisments.CategoryID = categories.CategoryID ");
                    } else {
                        $result = mysqli_query($clink, "SELECT * FROM `advertisments` ORDER BY `advertisments`.`Details` ASC   ");
                    }
                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($results)) {
                            if ($row['Status'] == 1 || isLogged() == 2) {
                                echo "<div class='col-md-4 col-sm-6 '>
                            <div class='card ' > 
                            <img class='' src='assets/img/{$row['Image']}' class='card-img-top' style='width:100%' alt='...'>
                            <span class='float-left'> Rp. {$row['Price']} /Bulan</span>
                                <div class='card-body'>
                                <h5 class='card-title'>{$row['Title']}</h5>
                                <p class='card-text'>{$row['Details']}</p>
                                <a href='pageads.php?ADS-ID={$row['AdsID']}' class='botton '>Lihat Iklan</a>";
                                if ($row['Status'] == 1 && (isLogged() == 2)) {
                                    echo "<a href='adsshoworhide.php?ADS-ID={$row['AdsID']}' class='botton1 ' >Nonaktifkan</a>";
                                } else if ($row['Status'] == 0 && (isLogged() == 2)) {
                                    echo "<a href='adsshoworhide.php?ADS-ID={$row['AdsID']}' class='botton2  ' >Aktifkan</a>";
                                }
                                echo " </div> </div></div>";
                            }
                        }
                    } else {
                        outputMessage("Tidak ada iklan yang tersedia", 'warning');
                    }
                    ?>
                </div>

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
        </section>
    </div>
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
                            <P>User harus menjadi member jika ingin memasang iklan di Kontrakan Babeh. jika belum, user dapat
                                Registrasi sebagai member terlebih dahulu.</P>
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>