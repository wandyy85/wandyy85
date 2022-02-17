<?php
// koneksi database
include 'includes/functions.php';

// menangkap data yang di kirim dari form
$UserID = $_POST['UserID'];
$UserName = $_POST['UserName'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$Password = $_POST['Password'];

$errors = [];
$successes = [];
if (
    $UserName == '' ||
    $Email == '' ||
    $Phone == '' ||
    $Password == ''

) {
    $errors[] = 'Tolong lengkapi profile anda';
}

// update data ke database
if (count($errors) == 0) {
    mysqli_query($clink, "update users set UserName='$UserName', Email='$Email', Phone='$Phone', Password='$Password' where UserID='$UserID'");
    $result = mysqli_query($clink, "SELECT UserID,UserName,Email,Phone,Password,Status FROM users where UserID='$UserID' ")  or die(mysqli_error($ch));
    $row = mysqli_fetch_assoc($result);
    $_SESSION['usernamelogin'] = $row['UserName'];
    $_SESSION['passwordlogin'] = $row['Password'];
    // mengalihkan halaman kembali ke index.php
    $successes[] = 'Data Anda Berhasil Diubah ';
    header("Location: profile.php");
} else {
    $errors[] = "";
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

$_SESSION['successes'] = $successes;
$_SESSION['errors'] = $errors;
