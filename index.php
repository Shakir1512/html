<?php
error_reporting(E_ALL);
$host = "10.10.10.10:3306";
$username = "root";
$password = "c0relynx";
$dbname = "Shakir";
$con = mysqli_connect($host, $username, $password, $dbname);
if (!$con) {
  die("Connection failed! " . mysqli_connect_error());
} else {
  echo "Connection Established Successfully";
}
echo $firstname = $_REQUEST["firstName"];
echo $lastname = $_REQUEST["lastName"];
echo $email = $_REQUEST["email"];
echo $password = md5($_REQUEST["password"]);
echo $confirm_password = md5($_REQUEST["confirmPassword"]);
echo $phone = $_REQUEST["phoneNumber"];
echo $address = $_REQUEST["address"];
echo $gender = $_REQUEST["gender"];
echo $language = implode(",", $language = $_REQUEST["language"]);
echo $country = $_REQUEST["country"];
echo $file = date("dmY_His") . substr($_REQUEST['fileToUpload'], -4) . "." . strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
echo $dob = $_REQUEST["dob"];
echo $date_entered = date('dmY_his');
echo $date_modified = date('dmY_his');
$query = "INSERT INTO `reg`( `first_name`, `last_name`, `password`, `confirm_password`, `address`, `email`, `phone_number`, `gender`, `language`, `country`, `image`, `dob`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES ('$firstname','$lastname','$password','$confirm_password','$address','$email','$phone','$gender','$language','$country','$file','$dob',NOW(),NOW(),'Shakir','Mohammad')";
mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data</title>
</head>

<body>
  <b>First Name : </b>
  <?php echo $_REQUEST["firstName"] ?> <br>
  <b>Last Name : </b>
  <?php echo $_REQUEST["lastName"] ?> <br>
  <b>Password(in md5 format) : </b>
  <?php echo md5($_REQUEST["password"]) ?> <br>
  <b>Confirm Password(in md5 format) : </b>
  <?php echo md5($_REQUEST["confirmPassword"]) ?> <br>
  <b>Address : </b>
  <?php echo $_REQUEST["address"] ?> <br>
  <b>Email : </b>
  <?php echo $_REQUEST["email"] ?> <br>
  <b>Phone Number : </b>
  <?php echo $_REQUEST["phoneNumber"] ?> <br>
  <b>Gender : </b>
  <?php echo $_REQUEST["gender"] ?> <br>
  <b>Language : </b>
  <?php $lang = $_REQUEST["language"];
  print_r($lang); ?> <br>
  <b>Country : </b>
  <?php echo $_REQUEST["country"] ?> <br>
  <?php
  $target_dir = "uploads/";
  $newFileName = date('dmY_his') . $_REQUEST["fileToUpload"];
  $extension = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
  $target_file = $target_dir . $newFileName . "." . $extension;
  $uploadOk = 1;

  //Delete Previous File
  // $files = glob('uploads/*');
  // foreach ($files as $file) {
  //   if (is_file($file)) {
  //     unlink($file);
  //   }
  // }
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "The file ". htmlspecialchars($newFileName).".$extension". " has been uploaded.";
    $uploadOk = 1;
  } else {
    // echo "Sorry, there was an error uploading your file.";
    $uploadOk = 0;
  }
  ?>
  <b>Image : </b>
  <?php $img = $_REQUEST['fileToUpload'];
  echo date("dmY_His") . substr($_REQUEST['fileToUpload'], -4) . "." . strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
  ?> <br>
  <b>DOB : </b>
  <?php $date = $_REQUEST["dob"];
  echo $date ?> <br>
</body>

</html>