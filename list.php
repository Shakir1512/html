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

$sql = " SELECT * FROM registration_form";
$result = $mysqli->query($sql);
$mysqli->close();
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
        const confirmAction = () => {
            const response = confirm("Are you sure you want to delete that?");
            if (response) {
                alert("List item deleted. ");
            }
        }

        const allDelete = () => {
            let cnt = 0;
            var get = document.list.chk;
            for (var i = 0; i < get.length; i++) {
                if (get[i].checked == true) {
                    cnt++;
                }
            }
            if (cnt > 0) {
                const response = confirm("Are you sure you want to delete that?");
                if (response) {
                    alert("List item deleted. ");
                }

            }
            else {
                alert("Please select atleast one item to be deleted ");
            }
        }

        function checkUncheck(checkBox) {
            get = document.getElementsByName('chk');
            for (var i = 0; i < get.length; i++) {
                get[i].checked = checkBox.checked;
            }


        }

        // function deSelect(){
        //   get = document.getElementsByName('chk');
        //   var all=document.list.all;
        //   for (var i = 0; i < get.length; i++) {
        //     if(get[i].checked == false){
        //       all.checked = false;
        //     }
        //   }
        // }

        function deSelect() {
            var all = document.list.all;
            var ele = document.list.chk;
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].checked == false) {
                    all.checked = false;
                }
            }
            // if(flag==1){
            //    all.checked =false;
            //   }
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
                <?php 
                
                ?>
            });
            $("#confirm").click(function () {
                $("#myModal").modal('hide');
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
    </style>
</head>

<body>
    <div name="search" id="search">
        <input type="text" name="search" id="search" value=""> <button margin-left="2vw"> Search</button></input>
        <div align="right"><a href="registration.html"><button name="new" id="new"> + NEW </button></a></div>
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
                ?>
                <tr><td>
                    <input type="checkbox" onclick="deSelect()" name="chk" id="chk" onclick="deSelect()" value=""
                        padding="50px"></input>
                    </td>
                    <td> <?php echo $rows['image']; ?></td>
                    <td><?php echo $rows['first_name']; ?></td>
                    <td><?php echo $rows['last_name']; ?></td>
                    <td><?php echo $rows['email']; ?></td>
                    <td><?php echo $rows['phone_number']; ?></td>
                    <td>
                        <button> Edit </button>
                        <button onclick="confirmAction()"> Delete </button>
                    </td>
                    <td>
                        <div class="sample">

                            <button type="button" class="btn btn-primary"> View </button>


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
                                                    <td> Mohammad </td>
                                                </tr>
                                                <tr border="1px solid black" name="list">
                                                    <td> <b>Last Name :</b></td>
                                                    <td> Shakir </td>
                                                </tr>
                                                <tr border="1px solid black" name="list">
                                                    <td> <b>Phone Number :</b></td>
                                                    <td> 1234567890 </td>
                                                </tr>
                                                <tr border="1px solid black" name="list">
                                                    <td> <b>Email :</b></td>
                                                    <td> abc12@gmail.com /td>
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
                </tr>
                <?php
            }
            ?>
        </table>
    </form>
    <button id="allDelete" onclick="allDelete()" margin-left="2vw"> All Delete</button>
</body>

</html>