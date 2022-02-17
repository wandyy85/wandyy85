<?php
include_once("includes/functions.php");
$isLogged = isLogged();
if ($isLogged == 3) {
    header("Location:index.php ");
}
$clink;
$AdsID = $_GET['ADS-ID'];
$result = mysqli_query($clink, "	DELETE FROM advertisments WHERE AdsID=$AdsID ") or die("Cannot execute SQL - " . mysqli_error($clink));
$successes[] = 'Iklan berhasil dihapus ';
$_SESSION['successes'] = $successes;

header("Location: profile_iklan.php");

$id = $_GET['id'];
