
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patient.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="icon" type="image/x-icon" href="images/medical.png">
</head>
<body>
    
<nav class="nav">
    <ul style="margin:auto;">
        <li><img height="60px" width="60px" src="medical.png" class="a" href="Home.html" target="_blank" alt="medical"></li>
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

<!-- Add New Admission -->
<form class="addNew" action='admissions.php' method='post'>
    <button style="background-color:ghostwhite;border-style:none;cursor:pointer" type="submit" name="adm" id="addButton"><img style="background-color:ghostwhite;" title="Add New Admission" height="50px" weight="50px" src="images/plus.png"></button>
</form>

<!-- Display The Data -->
<form class="form1" method="post" action="admissions.php">
    <div class="button-container" onmouseover="animateButton(this)" onmouseout="resetButton(this)">
        <button type="submit" name="sub" class="image-container">
            <img title="Display Admission Info" id="docPic" src="images/finance.png">
        </button>
        <div class="TextArea">
            Display The Data Of Admissions By Clicking On Admission Image ^^.
        </div>
    </div>
</form>


<!-- Search Form -->
<form method="post" action="valid.php">
    <input class="input" type="number"  id="search" name="adm" placeholder="SEARCH BY ID">
        <img src="images/search.png" height="25px" width="25px"id="icon"></img>
    </input>
</form>


<?php include 'connectionValidation.php';?>

    <?php


if(isset($_POST['insert'])){
    $id = $_POST['id'];
    $diagnosis = $_POST['dia'];
    $attending = $_POST['att'];
    $admission_date = $_POST['admDate'];
    $discharge_date = $_POST['disDate'];
    $searchPatient = "SELECT first_name , last_name, patient_id from patient where patient_id = $id";
    $exec = sqlsrv_query($conn, $searchPatient);
    if(sqlsrv_has_rows($exec)){
        $searchDoc = "SELECT * from doctors where doctor_id = $attending";
        $exe = sqlsrv_query($conn, $searchDoc);
        if(sqlsrv_has_rows($exe))
        {$insert = "INSERT INTO admission(patient_id,discharge_date,diagnosis,attending_doctor_id,admission_date)
                        VALUES (?,?,?,?,?)";
        $params = array($id,$discharge_date, $diagnosis,$attending,$admission_date);
        $query1 = sqlsrv_prepare($conn, $insert, $params);
        if(sqlsrv_execute($query1) === TRUE){
            echo "<p style='position:absolute;top:150px; right:50%;'>Data Inserted successfully &heartsuit;</p>";
        } else {
            echo "Error inserting data: ";
            print_r(sqlsrv_errors());
        }
    }else{
        echo "<p style='position:absolute;top:150px; right:50%;'>Error! Be sure that doctor id is correct...</p>";
    }
    }else{
    echo "<p style='position:absolute;top:150px; right:50%;'>Error! Be sure that patient id is correct...</p>";
}
}

if(isset($_POST['adm'])){
    echo '<style>
            .form1 {
                display: none; /* Make the content invisible */
                height:0;
                width:0;
            }
        </style>';
    echo'<form id="f" class="form" method="post">
            <fieldset class="field">
                <legend><h1>Insert New Admission</h1></legend>

                <label class="label" for="patient_id" >Enter patient ID</label>
                <input class="input" type="number" id="patient_id" name="id" required><br>


                <label class="label" for="dia">Diagnosis</label>
                <input class="input" type="text" id="dia" name="dia"><br>

                <label class="label" for="attend_doc">Attending doctor ID</label>
                <input class="input" type="number" id="attend_doc" name="att" required><br>

                <label class="label" for="date1" >Admission date</label>
                <input class="input" id="date1" type="date" name="admDate" style="width:150px;" required>
                <br>

                <label class="label" for="date2">Discharge date</label>
                <input class="input" id="date2" type="date" name="disDate" style="width:150px;">
                <br>
                <button class="b1" name="insert" type="submit" value="Submit">Submit Info</button>
            </fieldset>
        </form>';
}


    if(isset($_POST['confirm'])){
            echo '<style>
                    .form1{
                        display: none; /* Make the content invisible */
                        height:0;
                        width:0;
                        }
                </style>';
        $id = key($_POST['confirm']);
        //echo key($_POST['Update']);
        $query = "DELETE FROM admission
                    WHERE admission_id = $id";
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
        echo '<form action="admissions.php" method="post"><div id="confirmMessage">';
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
        $attending = $_POST["attendingDoctorId$id"];
        $diag = $_POST["diag$id"];
        $adm = $_POST["adm$id"];
        $dis = $_POST["dis$id"];
        $search = "SELECT doctor_id,first_name from doctors where $attending = doctor_id";
        $exec = sqlsrv_query($conn, $search);
        if(sqlsrv_has_rows($exec)){
            $query = "UPDATE admission
                        set attending_doctor_id = '$attending',
                            diagnosis = '$diag',
                            admission_date = '$adm',
                            discharge_date = '$dis'
                        where admission_id = $id";
            $result = sqlsrv_query($conn, $query);
            if($result == true){
                echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Updated Successfully</div>";
            }else{
                print_r(sqlsrv_errors());
        }
        }else{
            echo "<p style='position:absolute;top:150px; right:50%;'>There isn't doctor id like this please, Change it to existing one.</p>";
        }
        }
    
        if(isset($_POST['update'])){
            echo '<style>
                    .form1 {
                        display: none; /* Make the content invisible */
                        height:0;
                        width:0;
                    }
                </style>';
            $insert = "SELECT [admission_id], [patient_id]
                            ,[attending_doctor_id]
                            ,[diagnosis]
                            ,convert(varchar(100),[admission_date], 105) as [admission_date]
                            ,convert(varchar(100),[discharge_date], 105) as[discharge_date]
                        FROM [hospital].[dbo].[admission]";
            $result = sqlsrv_query($conn, $insert);
            if(sqlsrv_has_rows($result)){
                echo "<h3>Admissions Table</h3>";
                echo "<table>
                        <tr>
                            <th>Admission ID</th>
                            <th>Patient ID</th>
                            <th>Attending Doctor ID</th>
                            <th>Diagnosis</th>
                            <th>Admission Date</th>
                            <th>Discharge Date</th>
                            <th>Update</th>
                        </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['admission_id'] . "</td>";
                    echo '<form method="post" action="admissions.php">';
                    echo "<td>" . $row['patient_id'] . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='attendingDoctorId".$row["admission_id"]."' value=" . $row['attending_doctor_id'] ." ></input>" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='diag".$row['admission_id']."' value='" . $row['diagnosis'] ."'></input>" . "</td>";
                    echo "<td>" . "<input type='date' class='tableData' name='adm" . $row['admission_id'] . "' value='" . $row['admission_date'] ."'></input>" . "</td>";
                    echo "<td>" . "<input type='date' class='tableData' name='dis".$row['admission_id']."' value='" . $row['discharge_date'] ."'></input>" . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="Update['.$row['admission_id'].']" value="Update">'. "</form></td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "<P style='margin:10px;'>Update the data you want by clicking on the field you want to update on.<br>
            NOTE:<br><p style='margin:30px;'>
                    1- Editing in admission id and patient id aren't allowed.</1><br>
                    2- Every time you edit info be sure to enter the dates again.</2>
                </P></p>";
            }else{
                echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                            Unfortunately,Table Is Empty... Insert New Admission From Admissions section...</div>";
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
                $insert = "SELECT [admission_id], [patient_id]
                ,[attending_doctor_id]
                ,[diagnosis]
                ,convert(varchar(50),[admission_date], 103) as [admission_date]
                ,convert(varchar(50),[discharge_date], 103) as[discharge_date]
                    FROM [hospital].[dbo].[admission]";
                $result = sqlsrv_query($conn, $insert);
                if(sqlsrv_has_rows($result)){
                    echo "<h3>Admissions Table</h3>";
                    echo "<table>
                            <tr>
                                <th>Admission ID</th>
                                <th>Patient ID</th>
                                <th>Attending Doctor ID</th>
                                <th>Diagnosis</th>
                                <th>Admission Date</th>
                                <th>Discharge Date</th>
                                <th>Option</th>
                            </tr>";
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['admission_id'] . "</td>";
                        echo "<td>" . $row['patient_id'] . "</td>";
                        echo "<td>" . $row['attending_doctor_id'] . "</td>";
                        echo "<td>" . $row['diagnosis'] . "</td>";
                        echo "<td>" . $row['admission_date'] . "</td>";
                        echo "<td>" . $row['discharge_date'] . "</td>";
                        echo "<td>" . '<form method="post" action="admissions.php"><button type="submit" id="deleteButton" class="basket" name="update['.$row['admission_id'].']"><img title="Update Data" height="50px" width="50px" src="images/edit.png"></button>';
                        echo '<button type="submit" id="deleteButton" class="basket" name="delete['.$row['admission_id'].']"><img title="Delete" height="50px" width="50px" src="images/delete.png"></button></form>'. "</td>";
                        echo "</tr>";
                    }
                echo "</table>";
            }else{
                echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                        Unfortunately,Table Is Empty... Insert New Admission From Plus Icon...</div>";
            }
        }
            
        
    
?>

<footer style="background-color: #4A55A2; border-radius: 20px; margin-left: 20px; margin-right: 20px ;">
    <p style="text-align: center; color:ghostwhite;">Developed with all &heartsuit; by Aya Osama</p>
</footer>

</body>
</html>

