<?php
error_reporting(E_ALL);
global $result;
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

//Insert data
$firstname = $_REQUEST["firstName"];
$lastname = $_REQUEST["lastName"];
$email = $_REQUEST["email"];
$password = md5($_REQUEST["password"]);
$confirm_password = md5($_REQUEST["confirmPassword"]);
$phone = $_REQUEST["phoneNumber"];
$address = $_REQUEST["address"];
$gender = $_REQUEST["gender"];
$language = implode(",", $language = $_REQUEST["language"]);
$country = $_REQUEST["country"];
$file = date("dmY_His") . substr($_REQUEST['fileToUpload'], -4) . "." . strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
$dob = $_REQUEST["dob"];
$date_entered = date('dmY_his');
$date_modified = date('dmY_his');
$query = "INSERT INTO `reg`( `first_name`, `last_name`, `password`, `confirm_password`, `address`, `email`, `phone_number`, `gender`, `language`, `country`, `image`, `dob`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES ('$firstname','$lastname','$password','$confirm_password','$address','$email','$phone','$gender','$language','$country','$file','$dob',NOW(),NOW(),'Shakir','Mohammad')";
mysqli_query($mysqli, $query);


//Fetching all data
$sql = " SELECT * FROM reg where deleted=0";
$result = $mysqli->query($sql);
?>
<?php

// if (isset($_REQUEST['search'])) {
//     $query = $_REQUEST['search'];
//     $WHERE = "";
//     if ($query != null) {
//         $raw_results = "SELECT * FROM reg WHERE deleted=0 AND (`first_name` LIKE '%" . $query . "%') OR (`last_name` LIKE '%" . $query . "%') OR (`email` LIKE '%" . $query . "%') OR (`phone_number` LIKE '%" . $query . "%');";
//         $result = $mysqli->query($raw_results);
//     }

// }


?>
<html>
<title>Main</title>

<head>
    <style>
        #search {
            margin-left: 15vw;
        }

        #allDeleteBtn {
            margin-left: 10vw;
            height: 5vh;
            width: 7vw;
            padding: 1px;
        }

        #new {
            margin-right: 9vw;
            width: 5vw;
            height: 4vh;
        }

        table {
            border: solid 1px black;
            margin: 5px;
            margin-left: 10vw;
            width: 80vw
        }

        img {
            width: 4vw;
            height: 5vh;
        }

        button {
            width: 5w;
            height: 5vh;
        }
    </style>
    <script>
        function checkUncheck(checkBox) {
            get = document.getElementsByName('chk');
            for (var i = 0; i < get.length; i++) {
                get[i].checked = checkBox.checked;
            }


        }
        function deSelect() {
            var all = document.list.all;
            var ele = document.list.chk;
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].checked == false) {
                    all.checked = false;
                }
            }
        }
    </script>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css'
        media="screen" />
    <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
    <script type="text/javascript"
        src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
    <script>
        $(document).ready(function () {
            $(".btn").click(function () {
                $("#myModal").modal('show');
            });
            $("#confirm").click(function () {
                $("#myModal").modal('hide');
            });

        });
    </script>

    <script src="/js/delete.js"></script>
    <script src="/js/alldelete.js"></script>
    <script src="/js/search.js"></script>

    <style>
        .sample {
            margin: 20px;
        }

        #table1 {
            border: solid 1px black;
            margin: 5px;

            width: 60vw
        }

        img {
            width: 4vw;
            height: 5vh;
        }

        td {
            border: solid 1px black;
            margin: 5px;
        }

        #fromDate {
            margin-left: 2vw;
        }

        #searchInput {
            margin-top: 2vh;
            margin-left: 20vw;
        }

        #searchBtn {
            margin-top: 2vh;
            margin-left: 59.5vw;
            width: 6vw;
            height: 4vh;
        }

        #date {
            width: 8vw;
            height: 4vh;
            margin-left: 1vw;
        }
    </style>
</head>

<body id="main">
    <!-- <form action="" method="GET" name="Search" id="Search"> -->

    <input type="text" id="searchInput" name="search" value="" placeholder="Search data" margin-left="2vw" />
    <select name="dropdown" id="date">
        <option value="select">Select</option>
        <option value="1">Today</option>
        <option value="2">Yesterday</option>
        <option value="3">Last 7 days</option>
        <option value="4">Last 14 days</option>
        <option value="5">Last 1 month</option>
        <option value="6">Last 3 Month</option>
        <option value="6">Last 3 Month</option>
        <option value="7">Last 6 Month</option>
    </select>
    <input type="date" id="fromDate" />
    <input type="date" id="toDate" />

    <br><button type="submit" id="searchBtn" onclick="searchbtn()" data-mode="Search">Search</button>
    <!-- </form> -->

    <div align="right"><a href="registration.php"><button name="new" id="new"> + NEW </button></a></div>
    </div>
    <form name="list" id="list">
        <table>
            <tr border="1px solid black" name="list">
                <td>
                    <input type="checkbox" name="all" onclick='checkUncheck(this)' value="" padding="50px"></input>
                </td>
                <td> <b>Image</b></td>
                <td> <b>First Name </b></td>
                <td> <b>Last name </b></td>
                <td> <b>Email </b> </td>
                <td> <b>Phone </b> </td>
                <td> <b>Action </b> </td>
                <td> <b>View </b> </td>
            </tr>
            <p id="dis"> </p>
            <div id="display">
                <?php
                while ($rows = $result->fetch_assoc()) {
                    echo $current_ID = $row['id'];
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" onclick="deSelect()" name="chk" id="<?php echo $rows['id'] ?>"
                                onclick="deSelect()" value="" padding="50px"></input>
                        </td>
                        <td>
                            <?php echo $rows['image']; ?>
                        </td>
                        <td>
                            <?php echo $rows['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $rows['last_name']; ?>
                        </td>
                        <td>
                            <?php echo $rows['email']; ?>
                        </td>
                        <td>
                            <?php echo $rows['phone_number']; ?>
                        </td>
                        <td>
                            <button><a href="registration.php?id=<?php echo $rows['id'] ?>&mode=Edit">Edit</a>
                            </button>

                            <a href="#" class="delete-btn" data-id="<?php echo $rows['id']; ?>"
                                data-mode="Delete">Delete</a>
                        </td>
                        <td>
                            <div class="sample">
                                <button type="button" class="btn "> <a
                                        href="list.php?id=<?php echo $rows['id'] ?> mode=View">View</a>
                                </button>
                                <div id="myModal" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Applicant Details </h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <table id="table1">
                                                    <tr border="1px solid black" name="list">
                                                        <td> <b>First Name :</b></td>
                                                        <td id="fname"> Mohammad </td>
                                                    </tr>
                                                    <tr border="1px solid black" name="list">
                                                        <td> <b>Last Name :</b></td>
                                                        <td id="lname"> Shakir </td>
                                                    </tr>
                                                    <tr border="1px solid black" name="list">
                                                        <td> <b>Phone Number :</b></td>
                                                        <td id="phone"> 1234567890 </td>
                                                    </tr>
                                                    <tr border="1px solid black" name="list">
                                                        <td> <b>Email :</b></td>
                                                        <td id="email"> abc12@gmail.com /td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" id="confirm">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </div>
        </table>
    </form>
    <button id="allDeleteBtn" margin-left="2vw">All Delete</button>
</body>
</html>