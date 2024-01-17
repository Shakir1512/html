<?php
$user = 'root';
$password = 'c0relynx';
$database = 'Shakir';
$servername = 'localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);
if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
}
if (isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'Edit') {
  echo $id = $_REQUEST['id'];
  echo $query = "SELECT * FROM reg WHERE id=$id";
  $result = $mysqli->query($query);
  print_r($result);
  print_r($row = mysqli_fetch_assoc($result));
}
$lang=explode(",",$row['language']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>REGISTRATION FORM</title>
  <style>
    textarea,
    input {
      margin: 4px;
      width: auto;
      padding: 2px;
      padding-right: 2px;
    }
    td {
      margin: 4px;
      padding-right: 5px;
      background-color: #f0f8ff;
    }
    table,tr, td {
      border: solid 1px black;
      margin: 5px;
      margin-left: 20vw;
      width: 50vw;
      padding: 2px;
    }
    #submit,#reset,#back {
      margin-left: 16vw;
      size: 10;
      width: 6vw;
      height: 8vh;
      border-radius: 10px;
    }
    #reset {
      margin-left: 0vw;
    }
    #back {
      margin-left: 20vw;
      size: 20;
      width: 4vw;
      height: 6vh;
      border-radius: 10px;
    }
    #hidden {
      display: none;
    }
    #show {
      display: block;
    }
    img{
      width:7vw;
      height: 7vh;
      margin-left: 0.5vw;
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
<body>
  <form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
    <div align="center" style="background-color: white; margin-right: 50px">
      <b>REGISTRATION FORM</b>
    </div>
    <table>
      <tr>
        <td>First Name</td>
        <td>
          <input type="text" name="firstName" id="firstName" value="<?php echo $row['first_name']?>" /><br>
          <span id="fName"></span>
        </td>
      </tr>
      <tr>
        <td>Last Name</td>
        <td><input type="text" name="lastName" id="lastName" value="<?php echo $row['last_name']?>"  /><br>
          <span id="lName" style="display: none;">Please provide your last name.</span>
        </td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="text" name="password" id="password" value="<?php echo $_REQUEST['mode']=='Edit' ? $row['password'] :''?>" ><br>
          <span id="pass" style="display: none;">Please provide your Password.</span>
        </td>
      </tr>
      <tr>
        <td>Confirm Password</td>
        <td><input type="text" name="confirmPassword" id="confirmPassword" value="<?php echo $_REQUEST['mode']=='Edit' ? $row['confirm_password'] :''?>"/><br>
          <span id="cPass" style="display: none;">Please confirm your Password.</span>
        </td>
      </tr>
      <tr>
        <td>Address</td>
        <td>
          <textarea name="address" id="address" rows="3" cols="26.9" style="padding: 2px" value=""><?php echo $row['address']?></textarea><br>
          <span id="addr" style="display: none;">Please provide your Address.</span>
        </td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="email" name="email" id="email" value="<?php echo $row['email']?>"/><br>
          <span id="mail" style="display: none;">Please provide your email.</span>
        </td>
      </tr>
      <tr>
        <td>Phone Number</td>
        <td>
          <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo $row['phone_number']?>"/><br>
          <span id="phno" style="display: none;">Please provide your phone number.</span>
        </td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>
          <input type="radio" name="gender" id="genderMale" value="Male"<?php echo ($row['gender']=='Male')?'checked':'' ?>/>Male<br />
          <input type="radio" name="gender" id="genderFemale" value="Female"<?php echo ($row['gender']=='Female')?'checked':'' ?> />Female
          <br>
          <span id="gen" style="display: none;">Please provide your Gender.</span>
        </td>
      </tr>
      <tr>
        <td>Language</td>
        <td>    
          <input type="checkbox" name="language[]" id="language1" value="Hindi"<?php if(in_array("Hindi",$lang)) { ?> checked="checked" <?php } ?>  />Hindi<br />
          <input type="checkbox" name="language[]" id="language2" value="English"<?php if(in_array("English",$lang)) { ?> checked="checked" <?php } ?> />English<br />
          <input type="checkbox" name="language[]" id="language3" value="Bengali"<?php if(in_array("Bengali",$lang)) { ?> checked="checked" <?php } ?> />Bengali<br>
          <span id="lang" style="display: none;">Please select atleast 1 language.</span>
        </td>
      </tr>
      <tr>
        <td>Country</td>
        <td>     
          <select name="country" id="country">
            <option id="select" value="0">SELECT</option>
            <?php
            $countries = array("INDIA", "CHINA", "USA", "RUSSIA", "GERMANY");
            foreach ($countries as $item) {
              echo "<option value=$item >$item</option>";
            }
            ?>
          </select><br>
          <span id="count" style="display: none;">Please provide your country.</span>
        </td>
      </tr>
      <tr>
        <td>Image</td>
        <td><input type="file" name="fileToUpload" id="image1" value="" ><br>
        <!-- <img src="uploads/<?php echo $row['image']?>"/> -->
        <?php echo $_REQUEST['mode']=='Edit' ? $row['image'] :''?></input><br>
          <span id="img" style="display: none;">Please Upoad Image</span>
        </td>
      </tr>
      <tr>
        <td>DOB</td>
        <td>
          <input type="date" name="dob" id="calendar" mbsc-input placeholder="Please select..." value="<?php echo $row['dob']?>"/>
        </td>
      </tr>
    </table>
    <div>
      <a href="/list.php"><input type="button" name="back" id="back" value="Back" required /></a>
      <input type="submit" name="submit" id="submit" value="Submit" onclick="list.php" />
      <input type="reset" name="reset" id="reset" value="Reset" required />
    </div>
  </form>
</body>

<script>
  $(document).ready(function () {
    alert("Okay");
    $('#submit').click(function () {
      var fname = $("#firstName").val();
      var lname = $("#lastName").val();
      var addr = $("#address").val();
      var emailID = $("#email").val();
      var PhoneNo = $("#phoneNumber").val();
      var gndr = $("input[name='gender']:checked").val();
      var dateOfBirth = $("#dob").val();
      var lng = $("input[name='language[]']:checked").val();
      var cnt = $("#country").val();
      var passwd = $("#password").val();
      var cnfPasswd = $("#confirmPassword").val();
      function hideErrorMessage(selector) {
        $(selector).hide();
      }
      function showErrorMessage(selector, message) {
        $(selector).html(message).show();
      }
      if (!fname) {   // Validation logic for First Name
        showErrorMessage("#fName", "First Name is required");
        $("#firstName").focus();
        return false;
      } else if (/[^a-zA-Z\s]/.test(fname)) {
        showErrorMessage("#fName", "No numeric values allowed here");
        $("#firstName").focus();
        return false;
      } else {
        hideErrorMessage("#fName");
      }
      if (!lname) {   // Validation logic for Last Name
        showErrorMessage("#lName", "Last Name is required");
        $("#lastName").focus();
        return false;
      } else if (/[^a-zA-Z\s]/.test(lname)) {
        showErrorMessage("#lName", "No numeric values allowed here");
        $("#lastName").focus();
        return false;
      } else {
        hideErrorMessage("#lName");
      }
      if (passwd.length == 0) {   //Password Validation
        showErrorMessage("#pass", "Please Enter your Password");
        $("#password").focus();
        return false;
      }
      else {
        hideErrorMessage("#pass");
      }
      if (passwd.length < 8) {
        showErrorMessage("#pass", "Your Password must be of atleast 8 digits")
        $("#password").focus();
        return false;
      }
      else {
        hideErrorMessage("#pass");
        $("#confirmpassword").focus();
      }
      if (cnfPasswd.length == 0) {   //Password Validation
        showErrorMessage("#cPass", "Please confirm your password");
        $("#confirmpassword").focus();
        return false;
      }
      else {
        hideErrorMessage("#cPass");
      }
      if (passwd != cnfPasswd) {
        showErrorMessage("#cPass", "Both passwords must be the same");
        $("#confirmpassword").focus();
        return false;
      }
      else {
        hideErrorMessage("#cPass");
      }
      if (!addr.length) {   // Validation logic for Address
        showErrorMessage("#addr", "Please Enter Your Address");
        $("#address").focus();
        return false;
      } else {
        hideErrorMessage("#addr");
      }
      if (!emailID) {      // Validation logic for Email
        showErrorMessage("#mail", "Please provide your email");
        $("#email").focus();
        return false;
      } else {
        hideErrorMessage("#mail");
      }
      if (!PhoneNo) {      // Validation logic for Phone Number
        showErrorMessage("#phno", "Phone number cannot be empty");
        $("#phoneNumber").focus();
        return false;
      } else if (!/^\d{10}$/.test(PhoneNo)) {
        showErrorMessage("#phno", "Phone number must be of 10 digits");
        $("#phoneNumber").focus();
        return false;
      } else {
        hideErrorMessage("#phno");
      }
      if (gndr === undefined) {      // Validation logic for Gender
        showErrorMessage("#gen", "Please select your gender");
        $("#gen").mouseover(function () {
          $("#gen").hide();
        });
        return false;
      }
      if (lng === undefined) {       // Validation logic for Language
        showErrorMessage("#lang", "Please select your language");
        $("#language").mouseover(function () {
          $("#lang").hide();
        });
        return false;
      }
      if (cnt == 0) {           // Validation logic for Country
        showErrorMessage("#count", "Please select your country");
        $("#country").click(function () {
          $("#count").hide();
        });
        return false;
      }
      let inputFile = $("#image1").val();      // Validation logic for Image
      let imgError = $("#img");
      if (inputFile.length == 0) {
        imgError.html("Please upload Image").show();
        return false;
      } else {
        imgError.hide();
      }
      let selectedFile = $("#image1")[0].files[0];
      let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
      if (!allowedTypes.includes(selectedFile.type)) {
        imgError.html("Invalid file type. Please upload a JPEG ,JPG or PNG file").show();
        $("#image1").val("");
        return false;
      } else {
        imgError.hide();
      }
      this.submit();
    });
  });
</script>
</html>