
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patient.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="icon" type="image/x-icon" href="medical.png">
</head>
<body>
    
<nav class="nav">
    <ul style="margin:auto;">
        <li><img height="60px" width="60px" src="images/medical.png" class="a" href="Home.html" target="_blank" alt="medical"></li>
        <li><a class="a" href="Home.php" target="_blank">Home</a></li>
        <li title="patients"><a class="a" href="Patients.php" target="_blank">Patients</a></li>
        <li title="doctors"><a class="a" href="doc.php" target="_blank">Doctors</a></li>
        <li title="Admissions"><a class="a" href="admissions.php" target="_blank">Admissions</a></li>
        <li title="province_names"><a class="a" href="provs.php" target="_blank">Prov_names</a></li>
        <li title="Display Data"><a class="a" href="displaying.php" target="_blank">Display Data</a></li>
    </ul>
</nav>
<script>
function animateButton(container) {
    const button = container.querySelector(".basket");
    const textArea = container.querySelector(".TextArea");

    // Animate the button (move to the left)

    // Position the text area next to the button
    textArea.style.opacity = 1;
    // textArea.style.left = "60px"; // Adjust the left position as needed
}

function resetButton(container) {
    const button = container.querySelector(".basket");
    const textArea = container.querySelector(".TextArea");

    // Reset the button to its original position

    // Hide the text area with animation
    textArea.style.opacity = 0;
}

</script>

<form class="addNew" action='doc.php' method='post'>
    <button style="background-color:ghostwhite;border-style:none;cursor:pointer" type="submit" name="doc" id="addButton"><img style="background-color:ghostwhite;" title="Add New Doctor" height="50px" weight="50px" src="images/add-user.png"></button>
</form>

<form class="form1" method="post" action="doc.php">
    <div class="button-container" onmouseover="animateButton(this)" onmouseout="resetButton(this)">
        <button type="submit" name="sub" class="image-container">
            <img title="Display Doctors Info" id="docPic" src="images\doc.png">
        </button>
        <div class="TextArea">
            Display The Data Of Doctors By Clicking On Doctor Image ^^.
        </div>
    </div>
</form>

<form method="post" action="valid.php">
<input name="doc" type="number" class="input" id="search" placeholder="SEARCH BY ID">
<img src="images/search.png" height="25px" width="25px"id="icon"></img>
</input>
</form>


<?php include 'connectionValidation.php';?>

    <?php


if(isset($_POST['insert1'])){
    $first_name = $_POST['fName'];
    $last_name = $_POST['lName'];
    $specialty = $_POST['sp'];
    $insert = "INSERT INTO doctors( first_name,last_name ,specialty)
                            VALUES (?,?,?)";
    $params = array( $first_name, $last_name, $specialty);
    $query1 = sqlsrv_prepare($conn, $insert, $params);
    if(sqlsrv_execute($query1) === TRUE){
        echo "<p style='position:absolute;right:50%;top:130px;text-align:center'><br>Data Inserted successfully &heartsuit;</p>";
    } else {
        echo "<br>Error inserting data: ";
        print_r(sqlsrv_errors());
    }
}

if(isset($_POST['doc'])){
    echo '<style>
            .form1 {
                display: none; /* Make the content invisible */
                height:0;
                width:0;
            }
        </style>';
    echo'<form id="f" class="form" method="post" action="doc.php">
            <fieldset class="field">
                <legend><h1>Insert New Doctor</h1></legend>

                <label class="label" for="fName">Enter first name</label>
                <input class="input" type="text" id="fName" name="fName" required><br>

                <label class="label" for="lName">Enter last name</label>
                <input class="input" type="text" id="lName" name="lName" required><br>

                <label class="label" for="special">Specialty</label>
                <input class="input" type="text" id="special" name="sp"><br>
                <br>
                <button class="b1" type="submit" name="insert1" value="Submit">Submit Info</button>
            </fieldset>
        </form>';
}


    if(isset($_POST['confirm'])){
            echo '<style>
                    .form1 {
                        display: none; /* Make the content invisible */
                        height:0;
                        width:0;
                    }
                </style>';
        $id = key($_POST['confirm']);
        //echo key($_POST['Update']);
        $query = "DELETE FROM doctors
                    WHERE doctor_id = $id";
        $result = sqlsrv_query($conn, $query);
        if($result == true){
            echo "<p style='text-align:center'>Data Deleted Successfully ^^.</p>";
        }else{
            print_r(sqlsrv_errors());
    }
    }

    if(isset($_POST['delete'])){
        echo '<style>
                .form1 {
                    display: none; /* Make the content invisible */
                    height:0;
                    width:0;
                }
                
            </style>';
        $id = key($_POST['delete']);
        echo '<form action="doc.php" method="post"><div id="confirmMessage">';
        echo '<h3>Are You Sure You Want To Do This?</h3>Warning: You won\'t be able to get this data if you delete or update it to another value.<br>';
        echo '<button type="submit" class="con" id="confirm" name="confirm['.$id.']">YES</button>';
        echo '<button type="submit" class="con" id="refuse">NO</button>';
        echo '</div></form>';
    }

    if(isset($_POST['Update']))
    {
        echo '<style>
                .form1 {
                    display: none; /* Make the content invisible */
                    height:0;
                    width:0;
                }
            </style>';

        $id = key($_POST['Update']);
        // echo key($_POST['Update']);
        $firstName = $_POST["first_name$id"];
        $lastName = $_POST["last_name$id"];
        $specialty = $_POST["spec$id"];
        $query = "UPDATE doctors
                    set first_name = '$firstName',
                        last_name = '$lastName',
                        specialty = '$specialty'
                    where doctor_id = $id";
        $result = sqlsrv_query($conn, $query);
        if($result === true){
            echo "SUCCESS";
        }else{
            print_r(sqlsrv_errors());
    }
    echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Updated Successfully</div>";
    }
    
        if(isset($_POST['update'])){
            echo '<style>
                    .form1 {
                        display: none; /* Make the content invisible */
                        height:0;
                        width:0;
                    }
                </style>';
            $id = key($_POST['update']);
            $insert = "SELECT * FROM doctors where doctor_id = $id;";
                $result = sqlsrv_query($conn, $insert);
                if(sqlsrv_has_rows($result)){
                    echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>first name</th>
                        <th>last name</th>
                        <th>specialty</th>
                        <th>UPDATE</th>
                    </tr>";
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['doctor_id'] . "</td>";
                        echo '<form method="post" action="doc.php">';
                        echo "<td>" . "<input type='textbox' class='tableData' name='first_name".$row["doctor_id"]."' value=" . $row['first_name'] ." ></input>" . "</td>";
                        echo "<td>" . "<input type='textbox' class='tableData' name='last_name".$row['doctor_id']."' value=" . $row['last_name'] ."></input>" . "</td>";
                        echo "<td>" . "<input type='textbox' class='tableData' name='spec" . $row['doctor_id'] . "' value=" . $row['specialty'] ."></input>" . "</td>";
                        echo "<td>" . '<input type="submit" id="updateButton" name="Update['.$row['doctor_id'].']" value="Update"></form>'. "</td>";
                        echo "</tr>";
                    }
                echo "</table>";
                echo "<P style='margin:10px; color:#fffcccc;'>Update the data you want by clicking on the field you want to update on.<br>NOTE:Editing ID Isn't allowed...</P>";
        }
    }

    

    if(isset($_POST['sub'])){
            echo '<style>
                    .form1 {
                        display: none; /* Make the content invisible */
                        height:0;
                        width:0;
                    }
                    
                </style>';
            $insert = "SELECT * FROM doctors";
            $result = sqlsrv_query($conn, $insert);
            if(sqlsrv_has_rows($result)){
                echo "<h3>Doctors Table</h3>";
                echo "<table>
                <tr>
                    <th>ID</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>specialty</th>
                    <th>Option</th>
                </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    echo "<tr>";
                    echo "<td>" . $row['doctor_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['specialty'] . "</td>";
                    echo "<td>" . '<form method="post" action="doc.php"><button type="submit" id="deleteButton" class="basket" name="update['.$row['doctor_id'].']"><img title="Update Data" height="50px" width="50px" src="images/edit.png"></button>';
                    echo '<button type="submit" id="deleteButton" class="basket" name="delete['.$row['doctor_id'].']"><img title="Delete" height="50px" width="50px" src="images/delete.png"></button></form>'. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            }else{
                echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                        Unfortunately,Table Is Empty... Insert New Doctor From Doctors section...</div>";
            }
        }
            
        
    
?>

<footer style="background-color: #4A55A2; border-radius: 20px; margin-left: 20px; margin-right: 20px ;">
    <p style="text-align: center; color:ghostwhite;">Developed with all &heartsuit; by Aya Osama</p>
</footer>

</body>
</html>

