<?php

include_once("includes/functions.php");
$isLogged = isLogged();
if ($isLogged == 3) {
	header("Location:index.php ");
}
//receive form data 
$ProTitle    	= $_POST['ProTitle'];
$ProDetalis     = $_POST['ProDetalis'];
$fasilitas		= $_POST['fasilitas'];
$Proprice       = $_POST['Proprice'];
$AdsID = $_POST['AdsID'];
$Maincategory = $_POST['Maincategory'];
//$image 	= $_POST['image']; // receive file name ONLY

//image1
$fileFinalName = '';
if ($_FILES['Image']['name']) {
	$fileName 		= $_FILES['Image']['name'];
	$fileType 		= $_FILES['Image']['type'];
	$fileTmpName 	= $_FILES['Image']['tmp_name'];
	$fileError 		= $_FILES['Image']['error'];
	$fileSize 		= $_FILES['Image']['size'];
	$fileFinalName = time() . rand() . '_' . $fileName;
	//Move uploaded file from tmp directory to assets/images/products 
	$clink;
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: editSaveads.php");
		return false;
	}
	//Get the old image name/path and delete it - FROM DB
	$result = mysqli_query($clink, "SELECT Image from advertisments where AdsID={$AdsID}");
	$row = mysqli_fetch_array($result);
	$oldImage = $row['Image'];
	@unlink("assets/img/{$oldImage}");
}

//image2
$fileFinalName2 = '';
if ($_FILES['image2']['name']) {
	$fileName 		= $_FILES['image2']['name'];
	$fileType 		= $_FILES['image2']['type'];
	$fileTmpName 	= $_FILES['image2']['tmp_name'];
	$fileError 		= $_FILES['image2']['error'];
	$fileSize 		= $_FILES['image2']['size'];
	$fileFinalName2 = time() . rand() . '_' . $fileName;
	//Move uploaded file from tmp directory to assets/images/products 
	$clink;
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName2}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: editSaveads.php");
		return false;
	}
	//Get the old image name/path and delete it - FROM DB
	$result = mysqli_query($clink, "SELECT Image from advertisments where AdsID={$AdsID}");
	$row = mysqli_fetch_array($result);
	$oldImage = $row['Image'];
	@unlink("assets/img/{$oldImage}");
}


//image3
$fileFinalName3 = '';
if ($_FILES['image3']['name']) {
	$fileName 		= $_FILES['image3']['name'];
	$fileType 		= $_FILES['image3']['type'];
	$fileTmpName 	= $_FILES['image3']['tmp_name'];
	$fileError 		= $_FILES['image3']['error'];
	$fileSize 		= $_FILES['image3']['size'];
	$fileFinalName3 = time() . rand() . '_' . $fileName;
	//Move uploaded file from tmp directory to assets/images/products 
	$clink;
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName3}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: editSaveads.php");
		return false;
	}
	//Get the old image name/path and delete it - FROM DB
	$result = mysqli_query($clink, "SELECT Image from advertisments where AdsID={$AdsID}");
	$row = mysqli_fetch_array($result);
	$oldImage = $row['Image'];
	@unlink("assets/img/{$oldImage}");
}


//image4
$fileFinalName4 = '';
if ($_FILES['image4']['name']) {
	$fileName 		= $_FILES['image4']['name'];
	$fileType 		= $_FILES['image4']['type'];
	$fileTmpName 	= $_FILES['image4']['tmp_name'];
	$fileError 		= $_FILES['image4']['error'];
	$fileSize 		= $_FILES['image4']['size'];
	$fileFinalName4 = time() . rand() . '_' . $fileName;
	//Move uploaded file from tmp directory to assets/images/products 
	$clink;
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName4}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: editSaveads.php");
		return false;
	}
	//Get the old image name/path and delete it - FROM DB
	$result = mysqli_query($clink, "SELECT Image from advertisments where AdsID={$AdsID}");
	$row = mysqli_fetch_array($result);
	$oldImage = $row['Image'];
	@unlink("assets/img/{$oldImage}");
}

//image5
$fileFinalName5 = '';
if ($_FILES['image5']['name']) {
	$fileName 		= $_FILES['image5']['name'];
	$fileType 		= $_FILES['image5']['type'];
	$fileTmpName 	= $_FILES['image5']['tmp_name'];
	$fileError 		= $_FILES['image5']['error'];
	$fileSize 		= $_FILES['image5']['size'];
	$fileFinalName5 = time() . rand() . '_' . $fileName;
	//Move uploaded file from tmp directory to assets/images/products 
	$clink;
	move_uploaded_file($fileTmpName, "assets/img/{$fileFinalName5}");
	$gambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $fileName);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $gambarvalid)) {
		echo "<script>
        alert('Yang Diupload Bukan Gambar !');
		</script>";
		header("location: editSaveads.php");
		return false;
	}
	//Get the old image name/path and delete it - FROM DB
	$result = mysqli_query($clink, "SELECT Image from advertisments where AdsID={$AdsID}");
	$row = mysqli_fetch_array($result);
	$oldImage = $row['Image'];
	@unlink("assets/img/{$oldImage}");
}

// Connect to DB SERVER 
$errors = [];
$successes = [];
if (is_numeric($Proprice)) {
	echo "";
} else {
	$errors[] = 'Tolong isi harga dan format gambar dengan benar';
}
if (
	$ProTitle == "" ||
	$ProDetalis == "" ||
	$fasilitas == "" ||
	$Proprice == "" ||
	$Maincategory == "" ||
	$fileFinalName2 == "" ||
	$fileFinalName == ""
) {
	$errors[] = 'Tolong lengkapi data iklan';
}


if (count($errors) == 0) {
	$result = mysqli_query($clink, "UPDATE advertisments set 
	Details='$ProDetalis',
	fasilitas='$fasilitas',
	Price='$Proprice',
	Image='$fileFinalName',
	image2='$fileFinalName2' ,
	image3='$fileFinalName3' ,
	image4='$fileFinalName4' ,
	image5='$fileFinalName5' ,
	Title='$ProTitle' , CategoryID='$Maincategory' WHERE AdsID = '$AdsID'") or die("Cannot execute SQL - " . mysqli_error($clink));
	$successes[] = 'Iklan berhasil diubah';
	header("Location:profile_iklan.php");
} else {
	$errors[] = "Tolong ikuti petunjuk";
	header("Location: " . $_SERVER['HTTP_REFERER']);
}

$_SESSION['errors'] = $errors;
$_SESSION['successes'] = $successes;
