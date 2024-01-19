<?php
$user = 'root';
$password = 'c0relynx';
$database = 'Shakir';
$servername = 'localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'Search') {
    echo $query = $_REQUEST['keyword'];
    echo $dropdown = $_REQUEST['dropDown'];
    echo $fromDate = $_REQUEST['fromDate'];
    echo $toDate = $_REQUEST['toDate'];

    $WHERE = "";
    if ($query != null && $fromDate !='' && $toDate !='') {
       $WHERE .= " AND (`first_name` LIKE '%" . $query . "%') OR (`last_name` LIKE '%" . $query . "%') OR (`email` LIKE '%" . $query . "%') OR (`phone_number` LIKE '%" . $query . "%');";
       $WHERE .= "AND (date(created_date) between '$fromDate' and '$toDate')";
       // $result = $mysqli->query($raw_results);
    }
    if ($query != null){
        $WHERE .= " AND (`first_name` LIKE '%" . $query . "%') OR (`last_name` LIKE '%" . $query . "%') OR (`email` LIKE '%" . $query . "%') OR (`phone_number` LIKE '%" . $query . "%');";
    }
    if ($dropdown != 'select') {
        if ($dropdown == "1")
            $WHERE .= "AND (date(created_date) = CURRENT_DATE)";
        else if ($dropdown == '2')
            $WHERE .= "AND (date(created_date) = (CURRENT_DATE - INTERVAL 1 day))";
        else if ($dropdown == '3')
            $WHERE .= "AND (date(created_date) >= (CURRENT_DATE - INTERVAL 7 day))";
        else if ($dropdown == '4')
            $WHERE .= "AND (date(created_date) >= (CURRENT_DATE - INTERVAL 1 month))";
        else if ($dropdown == '5')
            $WHERE .= "AND (date(created_date) >= (CURRENT_DATE - INTERVAL 3 month))";
        else if ($dropdown == '6')
            $WHERE .= "AND (date(created_date) >= (CURRENT_DATE - INTERVAL 6 month))";
        else if ($dropdown == '6')
            $WHERE .= "AND (date(created_date) >= (CURRENT_DATE - INTERVAL 12 month))";
    } 
   
        if ($query == null && $fromDate !='' && $toDate !='') {
            $WHERE .= "AND (date(created_date) between '$fromDate' and '$toDate')";
        } else {
            if ($fromDate) {
                $WHERE .= "AND (date(created_date) >= '$fromDate' and CURRENT_DATE )";
            }
            if ($toDate) {
                $WHERE .= "AND (date(created_date) >= '01-01-2023' and '$toDate' )";
            }
        }
    

    echo $raw_results="SELECT * FROM reg WHERE deleted=0 $WHERE";

    $result = $mysqli->query($raw_results);
}
?>

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
        <td> <b>Created Date</b> </td>
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
                    <?php echo $rows['created_date']; ?>
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
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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