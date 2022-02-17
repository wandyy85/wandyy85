<?php
include_once("includes/functions.php");
$isLogged = isLogged();
if ($isLogged == 3) {
	header("Location:index.php ");
}
//mengirim form data 
$Title 	= $_POST['ProTitle'];
$Detalis = $_POST['ProDetalis'];
$fasilitas = $_POST['fasilitas'];
$price 	= $_POST['Proprice'];
$Maincategory 	= $_POST['Maincategory'];
$UserID = $_SESSION['loggedInUserId'];
$date = date("y-m-d");

$errors = [];
$successes = [];

$fileFinalName = '';
$fileFinalName2 = '';
$fileFinalName3 = '';
$fileFinalName4 = '';
$fileFinalName5 = '';

if ($_FILES['image']['name']) {
	$fileName 		= $_FILES['image']['name'];
	$fileType 		= $_FILES['image']['type'];
	$fileTmpName 	= $_FILES['image']['tmp_name'];
	$fileError 		= $_FILES['image']['error'];
	$fileSize 		= $_FILES['image']['size'];
	$fileFinalName = time() . rand() . '_' . $fileName;
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: unggah_iklan.php");
		return false;
	}
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName}");
}
if ($_FILES['image2']['name']) {
	$fileName 		= $_FILES['image2']['name'];
	$fileType 		= $_FILES['image2']['type'];
	$fileTmpName 	= $_FILES['image2']['tmp_name'];
	$fileError 		= $_FILES['image2']['error'];
	$fileSize 		= $_FILES['image2']['size'];
	$fileFinalName2 = time() . rand() . '_' . $fileName;
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName2}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: unggah_iklan.php");
		return false;
	}
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName2}");
}
if ($_FILES['image3']['name']) {
	$fileName 		= $_FILES['image3']['name'];
	$fileType 		= $_FILES['image3']['type'];
	$fileTmpName 	= $_FILES['image3']['tmp_name'];
	$fileError 		= $_FILES['image3']['error'];
	$fileSize 		= $_FILES['image3']['size'];
	$fileFinalName3 = time() . rand() . '_' . $fileName;
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName3}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: unggah_iklan.php");
		return false;
	}
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName3}");
}
if ($_FILES['image4']['name']) {
	$fileName 		= $_FILES['image4']['name'];
	$fileType 		= $_FILES['image4']['type'];
	$fileTmpName 	= $_FILES['image4']['tmp_name'];
	$fileError 		= $_FILES['image4']['error'];
	$fileSize 		= $_FILES['image4']['size'];
	$fileFinalName4 = time() . rand() . '_' . $fileName;
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName4}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: unggah_iklan.php");
		return false;
	}
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName4}");
}
if ($_FILES['image5']['name']) {
	$fileName 		= $_FILES['image5']['name'];
	$fileType 		= $_FILES['image5']['type'];
	$fileTmpName 	= $_FILES['image5']['tmp_name'];
	$fileError 		= $_FILES['image5']['error'];
	$fileSize 		= $_FILES['image5']['size'];
	$fileFinalName5 = time() . rand() . '_' . $fileName;
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName5}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: unggah_iklan.php");
		return false;
	}
	//memindahkan file ke assets/images/products 
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName5}");
}
if (is_numeric($price)) {
	echo "";
} else {
	$errors[] = 'Tolong Masukan Harga.';
}
if (
	$Title == "" ||
	$Detalis == "" ||
	$fasilitas == "" ||
	$price == "" ||
	$Maincategory == "" ||
	$fileFinalName == ""
) {
	$errors[] = 'Tolong Lengkapi Data Iklan Dengan Benar.';
}

//1) konek ke database
$ch = @mysqli_connect("localhost", "root", "", "kontrakan_babeh") or die("koneksi gagal");

//3) mengirim ke SQL query 
if (count($errors) == 0) {
	$result = mysqli_query($ch, "INSERT INTO `advertisments` 
	(`AdsID`, `Date`, `Status`, `Details`, `fasilitas`, `Price`, `Image`, `image2`,`image3`,`image4`,`image5`,`Title`,
`UserID`, `CategoryID`) VALUES 
(NULL, '$date', '1', '$Detalis', '$fasilitas', '$price', '$fileFinalName', '$fileFinalName2','$fileFinalName3','$fileFinalName4','$fileFinalName5', '$Title', '$UserID', '$Maincategory');
") or die("Cannot execute SQL - " . mysqli_error($ch));
	$successes[] = 'Iklan Berhasil Di Unggah ';
	header("Location: profile_iklan.php");
} else {
	$errors[] = "Tolong ikuti petunjuk dengan benar.";
	header("Location: " . $_SERVER['HTTP_REFERER']);
}



$_SESSION['errors'] = $errors;
$_SESSION['successes'] = $successes;
