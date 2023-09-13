
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients</title>
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
        <li title="Update Data"><a class="a" href="Deletion.php" target="_blank">Delete Data</a></li>
        <li title="Update Data"><a class="a" href="update.php" target="_blank">Update Data</a></li>
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

<form class="addNew" action='Patients.php' method='post'>
    <button style="background-color:ghostwhite;border-style:none;cursor:pointer" type="submit" name="patient" id="addButton"><img style="background-color:ghostwhite;" title="Add New Patient" height="50px" weight="50px" src="images/add-user.png"></button>
</form>

<form class="form1" method="post" action="Patients.php">
    <div class="button-container" onmouseover="animateButton(this)" onmouseout="resetButton(this)">
        <button type="submit" name="sub" class="image-container">
            <img title="Display Patient Info" id="docPic" src="images/patient.png">
        </button>
        <div class="TextArea">
            Display The Data Of Patients By Clicking On Doctor Image ^^.
        </div>
    </div>
</form>

<form method="post" action="valid.php">
<input type="number" name="patient" class="input" id="search" placeholder="SEARCH BY ID">
<img src="images/search.png" height="25px" width="25px"id="icon"></img>

</form>


<?php include 'connectionValidation.php';?>

<?php


    if(isset($_POST['insert'])){
        $first_name = $_POST['fName'] ;
        $last_name = $_POST['lName'] ;
        $gender = '';
        if(isset($_POST['gender'])){
            $gender = $_POST['gender'] ;
        }
        $birth_date = $_POST['date'];
        $city = $_POST['city'];
        $province_id = $_POST['province_id'] ;
        $allergies = $_POST['allergies'] ;
        $height = $_POST['height'] ;
        $width = $_POST['width'];
        $search = "";
        if($province_id != ''){ 
            $search = "SELECT * from provinces where province_id = $province_id";
                $exec = sqlsrv_query($conn, $search);
                if(sqlsrv_has_rows($exec)){
                    $insert = "INSERT INTO patient(first_name,last_name ,gender, birth_date, city, [patient].[province_id] ,allergies, 
                                                    height,width)
                                        VALUES (?,?,?,?,?,?,?,?,?)";
                $params = array($first_name,$last_name ,$gender, $birth_date, $city, $province_id , $allergies, $height, $width);
                $query1 = sqlsrv_prepare($conn, $insert, $params);
                if(sqlsrv_execute($query1) === TRUE){
                    echo "<p style='text-align:center'><br>Data Inserted successfully &heartsuit;</p>";
                } else {
                    echo "<br>Error inserting data: ";
                    print_r(sqlsrv_errors());
                }
                }else{
                    echo "<p style='position:absolute;right:50%;top:130px;text-align:center'><br>This Province Id doesn't exist...Try Again!</p>";
                }
        }else{
            $insert = "INSERT INTO patient(first_name,last_name ,gender, birth_date, city, allergies, 
                                            height,width)
                        VALUES (?,?,?,?,?,?,?,?)";
            $params = array($first_name,$last_name ,$gender, $birth_date, $city, $allergies, $height, $width);
            $query1 = sqlsrv_prepare($conn, $insert, $params);
            if(sqlsrv_execute($query1) === TRUE){
                echo "<p style='position:absolute;right:50%;top:130px;text-align:center'><br>Data Inserted successfully &heartsuit;</p>";
            } else {
            echo "<br>Error inserting data: ";
            print_r(sqlsrv_errors());
            }
        }
    }
    if(isset($_POST['patient'])){
        echo '<style>
                .form1 {
                    display: none; /* Make the content invisible */
                    height:0;
                    width:0;
                }
            </style>';
        echo'<form action="Patients.php" class="form" method="post">
        <fieldset class="field">
            <legend><h1>Insert New Patient</h1></legend>

            <label class="label" for="fName">Enter first name</label>
            <input class="input" type="text" id="fName" name="fName" required><br>

            <label class="label" for="lName">Enter last name</label>
            <input class="input" type="text" id="lName" name="lName" required><br>

            <label class="label" for="city">City</label>
            <input class="input" type="text" id="city" name="city"><br>

            <!-- <label class="label" for="province">Province ID</label>
            <input type="number" id="province" name="provinceID"><br> -->

            <label class="label" for="prov">Province ID</label>
            <input class="input" type="number" id="prov" name="province_id"><br>

            <label class="label" for="allergies">Allergies</label>
            <input class="input" type="text" id="allergies" name="allergies"><br>

            <label class="label" for="wide">Width</label>
            <input class="input"  type="number" id="wide" name="width" required><br>

            <label class="label" for="height">Height</label>
            <input class="input" type="number" id="height" name="height" required><br>

            <label class="label">Gender</label>

            <input class="input" type="radio" id="male" name="gender" value="M"><label class="label" for="male">Male</label>
            <input class="input" type="radio" id="female" name="gender" value="F"><label class="label" for="female">Female</label><br>

            <label class="label" for="date" >Birthdate</label>
            <input class="input" id="date" type="date" name="date" style="width:150px;"><br>
            
            <button class="b1" name="insert" type="submit" value="Submit">Submit Info</button>
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
        $query = "DELETE FROM patient
                    WHERE patient_id = $id";
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
        echo '<form action="Patients.php" method="post"><div id="confirmMessage">';
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
        $firstName = $_POST["firstName$id"];
        $lastName = $_POST["lastName$id"];
        $gender = $_POST["gender$id"];
        $birth_date = $_POST["birth_date$id"];
        $city = $_POST["city$id"];
        $province_id = $_POST["province_id$id"];
        $allergies = $_POST["allergies$id"];
        $height = $_POST["height$id"];
        $width = $_POST["width$id"];
        if($province_id != ''){
            $search = "SELECT * from provinces where province_id = $province_id";
            $exec = sqlsrv_query($conn, $search);
            if(sqlsrv_has_rows($exec)){
                $query = "UPDATE patient
                            set first_name = '$firstName',
                                last_name = '$lastName',
                                gender = '$gender',
                                birth_date = '$birth_date',
                                city = '$city',
                                province_id = '$province_id',
                                allergies = '$allergies',
                                height = '$height',
                                width = '$width'
                            where patient_id = $id;";
                $result = sqlsrv_query($conn, $query);
                if($result == true){
                    echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; 
                            background-color:#c2f0c2;'>Data Updated Successfully</div>";      
                }else{
                    print_r(sqlsrv_errors());
                }
            }else{
                    echo "This province id doesn't exist... Try again!";
            }
        }else{
            $query = "UPDATE patient
                            set first_name = '$firstName',
                                last_name = '$lastName',
                                gender = '$gender',
                                birth_date = '$birth_date',
                                city = '$city',
                                allergies = '$allergies',
                                height = '$height',
                                width = '$width'
                            where patient_id = $id;";
                $result = sqlsrv_query($conn, $query);
                if($result == true){
                    echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; 
                    background-color:#c2f0c2;'>Data Updated Successfully</div>"; 
                }else{
                    print_r(sqlsrv_errors());
                }
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
            $id = key($_POST['update']);
            $insert = "SELECT [patient_id]
                                ,[first_name]
                                ,[last_name]
                                ,[gender]
                                ,convert(varchar(50),[birth_date], 103) as [birth_date]
                                ,[city]
                                ,[province_id]
                                ,[allergies]
                                ,[height]
                                ,[width]
                                FROM [patient] where patient_id = $id";
            $result = sqlsrv_query($conn, $insert);
            if(sqlsrv_has_rows($result)){
                echo "<h3>Patients Table</h3>";
                echo "<div class='patientUpdateTable'><table style='width:100px'>
                <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>City</th>
                    <th>Province ID</th>
                    <th>Allergies</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Update</th>
                </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo '<form method="post" action="Patients.php">';
                    echo "<td>" . $row['patient_id'] . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='firstName".$row["patient_id"]."' value=" . $row['first_name'] ." ></input>" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='lastName".$row['patient_id']."' value=" . $row['last_name'] .">" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='gender".$row['patient_id']."' value=" . $row['gender'] .">" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='birth_date".$row['patient_id']."' value=" . $row['birth_date'] .">" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='city".$row['patient_id']."' value=" . $row['city'] .">" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='province_id".$row['patient_id']."' value=" . $row['province_id'] .">" . "</td><br>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='allergies".$row['patient_id']."' value=" . $row['allergies'] .">" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='height".$row['patient_id']."' value=" . $row['height'] .">" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='width".$row['patient_id']."' value=" . $row['width'] .">" . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="Update['.$row['patient_id'].']" value="Update"></form>'. "</td>";
                    echo "</tr>";
                }
                echo "</table></div>";
                echo "<P style='margin:10px;'>Update the data you want by clicking on the field you want to update on.<br>NOTE:Editing ID Isn't allowed...</P>";
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
                $insert = "SELECT [patient_id]
                ,[first_name]
                ,[last_name]
                ,[gender]
                ,convert(varchar(50),[birth_date], 103) as [birth_date]
                ,[city]
                ,[province_id]
                ,[allergies]
                ,[height]
                ,[width]
                FROM [patient]";
                $result = sqlsrv_query($conn, $insert);
                if(sqlsrv_has_rows($result)){
                    echo "<h3>Patients Table</h3>";
                    echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Gender</th>
                        <th>Birthdate</th>
                        <th>City</th>
                        <th>Province ID</th>
                        <th>Allergies</th>
                        <th>Height</th>
                        <th>Width</th>
                        <th>Option</th>
                    </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['patient_id']. "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['birth_date'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['province_id'] . "</td>";
                    echo "<td>" . $row['allergies'] . "</td>";
                    echo "<td>" . $row['height'] . "</td>";
                    echo "<td>" . $row['width'] . "</td>";
                    echo "<td>" . '<form method="post" action="Patients.php"><button type="submit" id="deleteButton" class="basket" name="update['.$row['patient_id'].']"><img title="Update Data" height="50px" width="50px" src="images/edit.png"></button>';
                    echo '<button type="submit" id="deleteButton" class="basket" name="delete['.$row['patient_id'].']"><img title="Delete" height="50px" width="50px" src="images/delete.png"></button></form>'. "</td>";
                    echo "</tr>";                    
                }
                    echo "</table>";
                } else {
                    echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                            Unfortunately,Table Is Empty... Insert New Patient From Patients section...</div>";
                }
        }
            
        
    
?>

<footer style="background-color: #4A55A2; border-radius: 20px; margin-left: 20px; margin-right: 20px ;">
    <p style="text-align: center; color:ghostwhite;">Developed with all &heartsuit; by Aya Osama</p>
</footer>

</body>
</html>

