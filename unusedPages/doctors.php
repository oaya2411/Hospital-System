<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patient.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="icon" type="image/x-icon" href="medical.png">
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
        <li title="Update Data"><a class="a" href="Deletion.php" target="_blank">Delete Data</a></li>
        <li title="Update Data"><a class="a" href="update.php" target="_blank">Update Data</a></li>
    </ul>
</nav>

<form class="form" method="post" action="doctors.php" ">
    <fieldset class="field" style="margin-top: 0px">
    
        <legend><h1>Display The Data Of</h1></legend>
        
        <input class="input" type="checkbox" id="doctorsList" name="doc" > <span></span>
        <label class="label" for="doctorsList">Doctors</label>
        
        <input class="input" type="checkbox" id="patientsList" name="patientsList" > <span></span>
        <label class="label" for="patientsList">Patients</label>
        
        <input class="input" type="checkbox" id="ProvincesList" name="prov" > <span></span>
        <label class="label" for="ProvincesList">Provinces</label>

        <input class="input" type="checkbox" id="AdmissionsList" name="admissions" > <span></span>
        <label class="label" for="AdmissionsList">Admissions</label>
        <div class="images"><img src="doctor.png" title="More.." ></div>
        <button class="b1" name="sub" type="submit" value="Submit"></button>
    </fieldset>
</form>
<?php include 'connectionValidation.php'; 

?>

    <?php

    if(isset($_POST['confirm'])){
        $id = key($_POST['confirm']);
        //echo key($_POST['Update']);
        $query = "DELETE FROM doctors
                    WHERE doctor_id = $id";
        $result = sqlsrv_query($conn, $query);
        if($result == true){
            echo "<p>Data Deleted Successfully ^^.</p>";
        }else{
            print_r(sqlsrv_errors());
    }
    }

    if(isset($_POST['delete'])){
        $id = key($_POST['delete']);
        echo $id;
        echo '<form action="doctors.php" method="post"><div id="confirmMessage">';
        echo '<h3>Are You Sure You Want To Do This?</h3>Warning: You won\'t be able to get this data if you delete or update it to another value.<br>';
        echo '<button type="submit" class="con" id="confirm" name="confirm['.$id.']">YES</button>';
        echo '<button type="submit" class="con" id="refuse">NO</button>';
        echo '</div></form>';
    }


    if(isset($_POST['Update']))
    {
        $id = key($_POST['Update']);
        //echo key($_POST['Update']);
        $firstName = $_POST["firstName$id"];
        $lastName = $_POST["lastName$id"];
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
        $id = key($_POST['update']);
        $insert = "SELECT * FROM doctors where doctor_id = $id;";
            $result = sqlsrv_query($conn, $insert);
            if(sqlsrv_has_rows($result)){
                echo "<P style='margin:10px;'><b>Update the data you want by clicking on the field you want to update on.</b><br>NOTE:Editing ID Isn't allowed...</P>";
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
                    echo "<td>" . "<input type='textbox' class='tableData' name='firstName".$row["doctor_id"]."' value=" . $row['first_name'] ." ></input>" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='lastName".$row['doctor_id']."' value=" . $row['last_name'] .">" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='spec".$row['doctor_id']."' value=" . $row['specialty'] .">" . "</td>";
                    echo "<td>" . '<form method="post" action="doctors.php"><input type="submit" id="updateButton" name="Update['.$row['doctor_id'].']" value="Update"></form>'. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
    }
}
    if(isset($_POST['sub'])){
        if(isset($_POST['doc'])){
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
                    echo "<td>" . '<form method="post" action="doctors.php"><button type="submit" id="deleteButton" class="basket" name="update['.$row['doctor_id'].']"><img title="Update Data" height="50px" width="50px" src="edit.png"></button>';
                    echo '<button type="submit" id="deleteButton" class="basket" name="delete['.$row['doctor_id'].']"><img title="Delete" height="50px" width="50px" src="delete.png"></button></form>'. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            }else{
                echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                        Unfortunately,Table Is Empty... Insert New Doctor From Doctors section...</div>";
            }
        }
            
        
    
}

?>

        <!-- if(
        }else if($table === 'Patients'){
            $query = "DELETE FROM patient
            WHERE patient_id = $id";
        }else if($table === 'Admissions'){
            $query = "DELETE FROM admission
                        WHERE patient_id = $id";
        }else{
            $query = "DELETE FROM provinces
            WHERE province_id = $id";
        } -->
<footer style="background-color: #4A55A2; border-radius: 20px; margin-left: 20px; margin-right: 20px ;margin-top: 200px;">
    <p style="text-align: center; color:ghostwhite;">Developed with all &heartsuit; by Aya Osama</p>
</footer>

</body>
</html>

