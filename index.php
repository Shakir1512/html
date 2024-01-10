<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data</title>
</head>

<body>
  <b>First Name  :  </b>  <?php echo $_REQUEST["firstName"]?> <br>
  <b>Last Name  :  </b><?php echo $_REQUEST["lastName"]?> <br>
  <b>Password(in md5 format)  :  </b><?php echo md5($_REQUEST["password"])?> <br>
  <b>Confirm Password(in md5 format)  :  </b><?php echo md5($_REQUEST["confirmPassword"])?> <br>
  <b>Address  :  </b><?php echo $_REQUEST["address"]?> <br>
  <b>Email  :  </b><?php echo $_REQUEST["email"]?> <br>
  <b>Phone Number  :  </b><?php echo $_REQUEST["phoneNumber"]?> <br>
  <b>Gender  :  </b><?php echo $_REQUEST["gender"]?> <br>
  <b>Language  :  </b><?php $lang= $_REQUEST["language"]; print_r($lang);?> <br>
  <b>Country  :  </b><?php echo $_REQUEST["country"]?> <br>

  <?php
        $target_dir = "uploads/";
        $newFileName = date('dmY_his').$_REQUEST["fileToUpload"];
        $extension = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $newFileName . "." . $extension;
        $uploadOk = 1;

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // echo "The file ". htmlspecialchars($newFileName).".$extension". " has been uploaded.";
            $uploadOk = 1;
        } else {
            // echo "Sorry, there was an error uploading your file.";
            $uploadOk = 0;
        }
    ?>
  <b>Image  :  </b><?php $img = $_REQUEST['image'];
   echo date("dmY_His").substr($_REQUEST['image'],-4).".".strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));  
  ?> <br>


  
  <b>DOB  :  </b><?php $date = $_REQUEST["dob"];
echo $date ?> <br>
</body>

</html>