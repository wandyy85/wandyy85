<?php
include_once("includes/functions.php");
?>
<?php
$ReceivedUserName = trim(strtolower($_POST['UserName']));
$ReceivedEmail = trim(strtolower($_POST['Email']));
$ReceivedPassword = trim(strtolower($_POST['Password']));
$ReceivedConfirmPassword = trim($_POST['ConfirmPassword']);
$ReceivedPhone = trim($_POST['Phone']);
$Receivedtype = trim(strtolower($_POST['type']));
$Receivedareas = trim($_POST['areas']);
$errors = [];
$successes = [];

//Validasi
if ($ReceivedPassword != $ReceivedConfirmPassword) {
    $errors[] = 'Kata Sandi Tidak cocok';
}
if (
    $ReceivedUserName == "" ||
    $ReceivedEmail == "" ||
    $ReceivedPassword == "" ||
    $ReceivedConfirmPassword == "" ||
    $ReceivedPhone == "" ||
    $Receivedtype == "" ||
    $Receivedareas == ""
) {
    $errors[] = 'Lengkapi semua data';
}


$result = mysqli_query($clink, "SELECT * from users WHERE  Phone='{$ReceivedPhone}' ") or die(mysqli_error($clink));
if (mysqli_num_rows($result) > 0) {

    $errors[] = 'Nomer Telpon telah digunakan';
}
$result = mysqli_query($clink, "SELECT * from users WHERE  Email='{$ReceivedEmail}' ") or die(mysqli_error($clink));
if (mysqli_num_rows($result) > 0) {

    $errors[] = 'Email telah digunakan';
}
if (count($errors) == 0) {

    $qq = "INSERT INTO `users` (`UserID`, `UserName`, `Email`, `Password`, `Phone`, `type`, `Status`,`areaID`) VALUES
	(NULL, '$ReceivedUserName', '$ReceivedEmail', '$ReceivedPassword', '$ReceivedPhone',  '$Receivedtype', 1 , '$Receivedareas')";
    $successes[] = 'Selamat anda telah menjadi member';
    $result = mysqli_query($clink, $qq) or die(mysqli_error($ch));
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    $errors[] = "Ikuti Petunjuk dengan benar";
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

$_SESSION['errors'] = $errors;
$_SESSION['successes'] = $successes;

?>