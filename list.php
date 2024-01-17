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
//Single Delete
if (isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'Delete') {
    $current_id = $_REQUEST['id'];
    $query = "UPDATE `reg` SET deleted=1 WHERE id=$current_id;";
    $mysqli->query($query);
    // header("Location: list.php");
}

$sql = " SELECT * FROM reg where deleted=0";
$result = $mysqli->query($sql);




?>

<?php

if (isset($_REQUEST['search'])) {
    $query = $_REQUEST['search'];
    $WHERE = "";
    if ($query != null) {
        $raw_results = "SELECT * FROM reg WHERE deleted=0 AND (`first_name` LIKE '%" . $query . "%') OR (`last_name` LIKE '%" . $query . "%') OR (`email` LIKE '%" . $query . "%') OR (`phone_number` LIKE '%" . $query . "%');";
        $result = $mysqli->query($raw_results);
    }

}

//All delete
if (isset($_REQUEST['allDelete'])) {
    print_r("I'm in all delete");
    print $arr = json_decode($_REQUEST['delId']);
    $arr = explode(',', $arr);
    foreach ($arr as $item) {
        print $id = $item;
        $sql = "UPDATE `reg` SET `deleted`='1' WHERE id=$id";
        $result = $mysqli->query($sql);
    }
    header("Location:http://10.10.10.10/list.php");
}



?>

<html>
<title>Main</title>

<head>
    <style>
        #search {
            margin-left: 15vw;
        }

        #allDelete {
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

        const allDelete = () => {
            var delId = [];
            let cnt = 0;
            var get = document.getElementsByName('chk');
            console.log(get);
            for (var i = 0; i < get.length; i++) {
                if (get[i].checked == true) {
                    delId[cnt] = get[i].id;
                    console.log(delId[cnt]);
                    cnt++;
                }
            }
            if (cnt == 0) {
                alert("Please select atleast one item to be deleted");
                return false;
            } else if (cnt > 0) {
                if (confirm("Are you sure you want to delete that?"))
                    window.location.href = "http://10.10.10.10/list.php?id=" + delId + "&mode=allDelete";
                else
                    window.location.href = "http://10.10.10.10/list.php";
            }
            return true;
        }

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


            // $(".delete-btn").click(function () {
            //     if (confirm("Are you sure you want to delete")) {
            //         var id = $(this).data("id");
            //         var mode = $(this).data("mode");
            //         $.ajax({
            //             type: "POST",
            //             url: "list.php",
            //             data: { id: id, mode: mode },

            //             done(function (response) {
            //                 // alert("Success");

            //             }) ,
            //             fail( function (error) {

            //                 console.log(error);
            //             })
            //         });
            //     }
            //     else {
            //         return false;
            //     }
            // })
        });
    </script>

<script>
    $(document).ready(function () {
        $(".delete-btn").on("click", function () {
            var id = $(this).data("id");
            var mode = $(this).data("mode");
            $.ajax({
                type: "POST",
                url: "list.php",
                data: { id: id, mode: mode },
                success: function (response) {
                    alert("Success");
                    $( "#main" ).load( "#main" ); 
                },
                error: function (error) {

                    console.log(error);
                }
            });
        });
    });
</script>

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

        #Search {
            margin-left: 20vw;
        }

        #Search {}
    </style>
</head>

<body id="main">
    <form action="" method="GET" name="Search" id="Search">
        <input type="text" name="search" required value="<?php if (isset($_GET['search'])) {
            echo $_REQUEST['search'];
        } ?>" placeholder="Search data" margin-left="2vw" />
        <button type="submit" class="searchbtn">Search</button>
    </form>
    <!-- <div name="search" id="search">
        <input type="text" name="query" id="query" value=""> <button margin-left="2vw"> Search</button></input> -->
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

                        <a href="#" class="delete-btn" data-id="<?php echo $rows['id']; ?>" data-mode="Delete">Delete</a>
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
        </table>
    </form>
    <button id="allDelete" onclick="allDelete()" margin-left="2vw">
        <a href="list.php?id=<?php echo $rows['id'] ?>&mode=allDelete" name="allDelete">All Delete</a> </button>
</body>



</html>