<?php
include_once("includes/functions.php");
$isLogged = isLogged();
if ($isLogged == 3) {
    header("Location:index.php ");
}
$UserName =  $_SESSION['usernamelogin'];
$Password = $_SESSION['passwordlogin'];

?>
<!DOCTYPE html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/Stylee.css" />
</head>

<body>

    <?php
    drawHeader();
    ?>

    <section class="commercial-asd container">
        <h2>Ubah Profile Saya</h2>

        <?php
        $data = mysqli_query($clink, "select * from users where UserName='$UserName' AND Password='$Password'");
        $is_exist = mysqli_num_rows($data);
        if ($is_exist > 0) {
            $row = mysqli_fetch_assoc($data);
            $_SESSION['nama_user'] = $row['UserName']; // set session untuk nama
            $_SESSION['nim_user'] = $row['UserID']; // set session untuk nim
        } else {
            die('username atau password tidak ditemukan');
        }
        ?>


        <form action="update_profile.php" method="post" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <input type="hidden" name="UserID" value="<?php echo $row['UserID']; ?>">
                </div>
            </div>


            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Pengguna</label>
                <div class="col-sm-10">
                    <input name="UserName" class="form-control" placeholder="Masukan nama pengguna baru" id="colFormLabel" value="">
                </div>
            </div>

            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="Email" placeholder="Masukan email baru" class="form-control" id="colFormLabel" value="">
                </div>
            </div>

            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nomer Telepon</label>
                <div class="col-sm-10">
                    <input type="text" name="Phone" placeholder="Masukan nomer telepon baru" class="form-control" alt="wating" id="colFormLabel" value="">
                </div>
            </div>


            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Kata Sandi</label>
                <div class="col-sm-10">
                    <input type="password" name="Password" placeholder="Masukan kata sandi baru" class="form-control" alt="wating" id="inputPassword3" value="">
                </div>
            </div>


            <input class="btn" type="submit" value="Simpan">
        </form>



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


            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>