<link rel="stylesheet" type="text/css" href="css/style.css">
<?php

$server = "localhost";
$user = "root";
$pass = "";
$dbname = "ictp";

//Creating connection for mysqli

$conn = new mysqli($server, $user, $pass, $dbname);

//Checking connection

if($conn->connect_error){
	die("Connection failed:" . $conn->connect_error);
}

$name = mysqli_real_escape_string($conn, $_POST['name']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$aff_ins = mysqli_real_escape_string($conn, $_POST['aff_ins']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$paperid = mysqli_real_escape_string($conn, $_POST['paperID']);
$memberid = mysqli_real_escape_string($conn, $_POST['memberid']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$add_paperid = mysqli_real_escape_string($conn, $_POST['additional_paperid']);
$date = date("D M d, Y G:i");


$sql= "INSERT INTO registration (NAME, TYPE, EMAIL, PHONE, ADDRESS, COUNTRY, PAPERID, MEMBERID, CATEGORY, ADD_PAPERID, FILE_NAME, DATE, AFF_INS) VALUES ('$name','$type','$email','$phone','$address','$country','$paperid','$memberid','$category','$add_paperid','$paperid','$date', '$aff_ins')";
/*if($conn->query($sql) === TRUE){
	echo "Record Added Sucessfully";
}
else
{
	echo "Error *****" . $sql . "<br/>" . $conn->error;
}*/




// file

if (isset($_POST['submit']) & $conn->query($sql) === TRUE) {
	$file = $_FILES['file'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('zip', 'rar', 'pdf');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 9999000000) {
				//$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileNameNew = $paperid.".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				//header("Location: index.php?uploadsuccess");
				echo "<h1 align='center'>Record added and File uploaded!!</h1>";
				echo "<h2 align='center'>Please collect your receipt by clicking the button bellow</h2>";
				echo "<h1 align='center'><a href='data.php?name=$name & file=$fileNameNew'><button class='btn'>Generate your printable receipt</button></a></h1>";
				
			} else {
				echo "<h1>Your file is too big!</h1>";
				echo "Error!!!";
				echo "<h2 align='center'>Please collect your receipt by clicking the button bellow</h2>";
				echo "<h1 align='center'><a href='data.php?name=$name & file=$fileNameNew'><button class='btn'>Generate your printable receipt</button></a></h1>";
			}
		} else {
			echo "<h1>There was an error uploading your file!<h1>";
			echo "Error !!!";
			echo "<h2 align='center'>Please collect your receipt by clicking the button bellow</h2>";
				echo "<h1 align='center'><a href='data.php?name=$name & file=$fileNameNew'><button class='btn'>Generate your printable receipt</button></a></h1>";
		}
	} else {
		echo "<h1>You cannot upload files of this type!</h1>";
		echo "Error!!! ";
		echo "<h2 align='center'>Please collect your receipt by clicking the button bellow</h2>";
				echo "<h1 align='center'><a href='data.php?name=$name & file=$fileNameNew'><button class='btn'>Generate your printable receipt</button></a></h1>";
	}
}

$conn->close();

?>