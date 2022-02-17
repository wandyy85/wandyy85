<?php
include_once("includes/functions.php");



?>
<!DOCTYPE html>

<head>
    <title>Kontrakan Babeh</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/halaman_iklannn.css" />

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

    <section class="ads">
        <?php
        // mengambil informasi iklan yang ada di database ads
        $AdsID = $_GET['ADS-ID'];
        $clink;
        $resultADS = mysqli_query($clink, "SELECT Date,Details,fasilitas,Price,Image,Status,Title,CategoryID,UserID FROM advertisments WHERE AdsID=$AdsID");
        $rowADS = mysqli_fetch_assoc($resultADS);
        $UserID = $rowADS['UserID'];
        $result = mysqli_query($clink, "	SELECT * FROM advertisments WHERE AdsID=$AdsID 	") or die("Cannot execute SQL - " . mysqli_error($clink));
        $row = mysqli_fetch_assoc($result);

        // admin only can to visit this page
        if ($rowADS['Status'] == 0 && isLogged() !== 2) {
            header('location:index.php');
        }
        ######################### mengambil informasi user
        $resultuser = mysqli_query($clink, "SELECT UserName,Email,Phone,areaID FROM users WHERE UserID=$UserID");
        $rowuser = mysqli_fetch_assoc($resultuser);
        ######################### mengambil nama daerah
        $areaID = $rowuser['areaID'];
        $resultareas = mysqli_query($clink, "SELECT areaName,cityID FROM areas WHERE areaID=$areaID");
        $rowareas = mysqli_fetch_assoc($resultareas);
        ######################### mengambil nama kecamatan
        $cityID = $rowareas['cityID'];
        $resultcity = mysqli_query($clink, "SELECT cityName FROM cities WHERE cityID=$cityID");
        $rowcity = mysqli_fetch_assoc($resultcity);
        ####################################################################################
        ########################## mengambil kategori
        $CategoryID = $rowADS['CategoryID'];
        $resultCategory = mysqli_query($clink, "SELECT CategoryName FROM categories WHERE CategoryID=$CategoryID");
        $rowCategory = mysqli_fetch_assoc($resultCategory);
        #############################################################################  
        $AdsID;
        $resultreport = mysqli_query($clink, "SELECT UserID FROM report WHERE AdsID=$AdsID");
        $rowreport = mysqli_fetch_assoc($resultreport);
        ?>
        <div class="container">
            <hr>

            <div class="card">
                <div class="row">
                    <aside class="col-sm-5 border-right">


                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="assets/img/<?php echo $row['Image']; ?>" class="d-block w-20" alt="...">
                                </div>

                                <div class="carousel-item">
                                    <img src="assets/img/<?php echo $row['image2']; ?>" class="d-block w-20" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/<?php echo $row['image3']; ?>" class="d-block w-20" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/<?php echo $row['image4']; ?>" class="d-block w-20" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/<?php echo $row['image5']; ?>" class="d-block w-20" alt="...">
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

                        <br>
                        <div class=" pl-5">
                            <dl class="param param-feature">
                                <dt>Nama :</dt>
                                <dd><?php echo $rowuser['UserName']; ?></dd>
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Email :</dt>
                                <dd><?php echo $rowuser['Email']; ?></dd>
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Nomer Telepon :</dt>
                                <dd><?php echo $rowuser['Phone']; ?></dd>
                            </dl> <!-- item-property-hor .// -->
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Alamat :</dt>
                                <dd><?php echo $rowcity['cityName'] . " , " . $rowareas['areaName']; ?></dd>
                            </dl> <!-- item-property-hor .// -->
                        </div> <!-- card-body.// -->
                    </aside>
                    <aside class="col-sm-7">
                        <article class="card-body p-5">
                            <h3 class="title mb-3"><?php echo $rowADS['Title']; ?></h3>
                            <dl class="item-property">
                                <dt>Keterangan Lengkap :</dt>
                                <dd>
                                    <p><?php echo $rowADS['Details']; ?></p>
                                </dd>
                            </dl>
                            <dl class="item-property">
                                <dt>Failitas :</dt>
                                <dd>
                                    <p><?php echo $rowADS['fasilitas']; ?></p>
                                </dd>
                            </dl>
                            <dl class="param param-feature">
                                <dt>Harga per bulan :</dt>
                                <dd><a>Rp. <?php echo $rowADS['Price']; ?></dd></a>
                                <dl class="param param-feature">
                                    <dt>Tanggal :</dt>
                                    <dd><?php echo $rowADS['Date']; ?></dd>
                                </dl> <!-- item-property-hor .// -->
                                <dl class="param param-feature">
                                    <dt>Kategori :</dt>
                                    <dd><?php echo $rowCategory['CategoryName']; ?></dd>
                                </dl> <!-- item-property-hor .// -->
                                <hr>

                                <?php

                                if (isLogged() == 1 && $_SESSION['loggedInUserId'] !== $rowreport['UserID']) {
                                    if (isset($_SESSION['loggedInUserId']) and $_SESSION['loggedInUserId'] !== $rowADS['UserID']) {
                                        echo '<a href="" class="btn btn-lg btn-danger text-uppercase float-right" data-toggle="modal" data-target="#myModal2">Pengaduan</a>';
                                    }
                                    echo "
                                    <div class='modal' id='myModal2'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content LogIn'>
                                                    <div class='modal-header'>
                                                        <h4 class='modal-title'>Pengaduan</h4>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class='col-12 float-left'>
                                                            <form action='Report.php' method='POST'>
                                                                <div class='form-group'>
                                                                    <textarea placeholder='Masalah' name='Detalis' id='my-input' class='form-control ' rows='5'></textarea>
                                                                    <input type='hidden' name='AdsID' value='$AdsID'>
                                                                </div>
                                                                <button type='submit' class='btn '>Kirim</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                } else if (isLogged() == 3) {
                                    echo "
                                <a href='' class='btn btn-lg btn-danger text-uppercase float-right' data-toggle='modal' data-target='#myModal'>Pengaduan</a>";
                                } else {
                                    echo "";
                                } ?>
                                <?php
                                if ($rowADS['Status'] == 1 && (isLogged() == 2)) {
                                    echo "<br><a href='adsshoworhide.php?ADS-ID={$AdsID}' class='btn btn-danger mt-2 float-right' >Nonaktifkan Iklan<a>";
                                } else if ($rowADS['Status'] == 0 && (isLogged() == 2)) {
                                    echo "<br><a href='adsshoworhide.php?ADS-ID={$AdsID}' class='btn btn-primary mt-2 ' >Aktifkan Iklan<a>";
                                }
                                ?>
                        </article> <!-- card-body.// -->
                    </aside> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card.// -->
        </div>
        <!--container.//-->

    </section>

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
                <h2>Ngontrak nyok</h2>
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
                            <P>User harus member jika ingin memasang iklan di web kontrakan_babeh.com. jika belum, user dapat
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>