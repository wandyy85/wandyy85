<?php
include_once("includes/functions.php");
?>
<?php
// validasi username dan password di db

$ch = @mysqli_connect("localhost", "root", "", "kontrakan_babeh") or die("Koneksi Gagal");
$Email = $_POST['usernamelogin'];
$Password = $_POST['passwordlogin'];
//validasi data
$errorsLogin = [];
if ($Email == '' || $Password == '') {
    $errorsLogin[] = 'Tolong lengkapi data';
}

$result = mysqli_query($ch, 'SELECT UserID,UserName,Email,Password,Status FROM users where Email="' . $Email . '" and Password="' . $Password . '"  ')  or die(mysqli_error($ch));
$row = mysqli_fetch_assoc($result);

if ($Email == "admin@babeh.com" && $Password == "123456") {
    $_SESSION['admin'] = 'YES';
    header('location:index.php');
} else if (mysqli_num_rows($result) > 0 && $row['Status'] == 1) {
    $_SESSION['LOGGEDIN'] = 'YES';
    $_SESSION['usernamelogin'] = $row['UserName'];
    $_SESSION['passwordlogin'] = $row['Password'];
    $_SESSION['loggedInUserId'] = $row['UserID'];
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else if (mysqli_num_rows($result) > 0 && $row['Status'] == 0) {
    $errorsLogin[] = 'Akun anda telah di nonaktifkan oleh admin';
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    $errorsLogin[] = 'email atau password salah';
}
header("Location: " . $_SERVER['HTTP_REFERER']);

$_SESSION['errorsLogin'] = $errorsLogin;
 

?>