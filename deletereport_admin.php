<?php
include_once("includes/functions.php");
if (isLogged() !== 2) {
    header("Location: index.php ");
}

$clink;
$AdsID = $_GET['ADS-ID'];
$result = mysqli_query($clink, "	DELETE FROM report WHERE AdsID=$AdsID ") or die("Cannot execute SQL - " . mysqli_error($clink));
$_SESSION['successes'] = $successes;

header("Location: admin_report.php");

$id = $_GET['id'];
