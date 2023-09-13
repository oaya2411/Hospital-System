

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Data</title>
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

<?php include 'connectionValidation.php'; ?>

<form class="form" method="post" action="update.php" ">
    <fieldset class="field" style="margin-top: 0px">
    
        <legend><h1>Update The Data Of</h1></legend>
        
        <input type="checkbox" id="doctorsList" name="doc" > <span></span>
        <label class="label" for="doctorsList">Doctors</label>
        
        <input type="checkbox" id="patientsList" name="patientsList" > <span></span>
        <label class="label" for="patientsList">Patients</label>
        
        <input type="checkbox" id="ProvincesList" name="prov" > <span></span>
        <label class="label" for="ProvincesList">Provinces</label>

        <input type="checkbox" id="AdmissionsList" name="admissions" > <span></span>
        <label class="label" for="AdmissionsList">Admissions</label>
        
        <button class="b1" name="sub"  type="submit" value="Submit">Display Info</button>
    </fieldset>

<?php
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
    if(isset($_POST['UpdateProvinces']))
    {
        $id = key($_POST['UpdateProvinces']);
        //echo key($_POST['Update']);
        $province_name = $_POST["prov$id"];
        $query = "UPDATE provinces
                    set province_name = '$province_name'
                    where province_id = $id";
        $result = sqlsrv_query($conn, $query);
        if($result === true){
            echo "SUCCESS";
        }else{
            print_r(sqlsrv_errors());
    }
    echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Updated Successfully</div>";
    }
    if(isset($_POST['UpdateAdmission'])){
        $id = key($_POST['UpdateAdmission']);
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
                    where patient_id = $id";
        $result = sqlsrv_query($conn, $query);
        if($result === true){
            echo "SUCCESS";
        }else{
            print_r(sqlsrv_errors());
    }
    echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Updated Successfully</div>";
    }else{
        echo "There isn't doctor id like this please, Change it to existing one";
    }
    }
    if(isset($_POST['UpdatePatient'])){
        $id = key($_POST['UpdatePatient']);
        $firstName = $_POST["firstName$id"];
        $lastName = $_POST["lastName$id"];
        $gender = $_POST["gender$id"];
        $birth_date = $_POST["birth_date$id"];
        $city = $_POST["city$id"];
        $province_id = $_POST["province_id$id"];
        $allergies = $_POST["allergies$id"];
        $height = $_POST["height$id"];
        $width = $_POST["width$id"];
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
            echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; 
            background-color:#c2f0c2;'>Data Updated Successfully</div>";
            if($result === true){
                echo "SUCCESS";
            }else{
                print_r(sqlsrv_errors());
            }
        }else{
                echo "This province id doesn't exist... Try again!";
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
                    <th>UPDATE</th>
                </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['doctor_id'] . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='firstName".$row["doctor_id"]."' value=" . $row['first_name'] ." ></input>" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='lastName".$row['doctor_id']."' value=" . $row['last_name'] .">" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='spec".$row['doctor_id']."' value=" . $row['specialty'] .">" . "</td>";
                    echo "<td>" . '<form method="post" action="Deletion.php"><input type="submit" id="updateButton" name="Update['.$row['doctor_id'].']" value="YES"></form>'. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            //<button name="del" class="deleteFromTable" id="'.$row["doctor_id"].' type="submit"">delete</button>
            }else{
                echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                        Unfortunately,Table Is Empty... Insert New Doctor From Doctors section...</div>";
            }
        }
        if(isset($_POST['patientsList'])){
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
                    echo "<td>" . '<input type="submit" id="updateButton" name="UpdatePatient['.$row['patient_id'].']" value="Update">'. "</td>";
                    echo "</tr>";
                }
                echo "</table></div>";
            } else {
                echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                        Unfortunately,Table Is Empty... Insert New Patient From Patients section...</div>";
            }
        }
        if(isset($_POST['admissions'])){
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
                    echo "<td>" . $row['patient_id'] . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='attendingDoctorId".$row["patient_id"]."' value=" . $row['attending_doctor_id'] ." ></input>" . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='diag".$row['patient_id']."' value='" . $row['diagnosis'] ."'></input>" . "</td>";
                    echo "<td>" . "<input type='date' class='tableData' name='adm" . $row['patient_id'] . "' value='" . $row['admission_date'] ."'></input>" . "</td>";
                    echo "<td>" . "<input value='" . $row['discharge_date'] ."' type='date' class='tableData' name='dis".$row['patient_id']."'></input>" . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="UpdateAdmission['.$row['patient_id'].']" value="Update">'. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            
            }else{
                echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                            Unfortunately,Table Is Empty... Insert New Admission From Admissions section...</div>";
            }
        }
        if(isset($_POST['prov'])){
            $insert = "SELECT * from provinces";
            $result = sqlsrv_query($conn, $insert);
            if(sqlsrv_has_rows($result)){
                echo "<h3>Provinces Table</h3>";
                echo "<table>
                        <tr>
                            <th>Province ID</th>
                            <th>Province Name</th>
                            <th>Update</th>
                        </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['province_id'] . "</td>";
                    echo "<td>" . "<input type='textarea' class='tableData' name='prov".$row['province_id']."' value=" . $row['province_name'] .">" . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="UpdateProvinces['.$row['province_id'].']" value="Update">'. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            
        }else{
            echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                        Unfortunately,Table Is Empty... Insert New Province From Provinces section...</div>";
        }
    }
}

?>

</form>

<footer style="background-color: #4A55A2; border-radius: 20px; margin-left: 20px; margin-right: 20px ;margin-top: 200px;">
    <p style="text-align: center; color:ghostwhite;">Developed with all &heartsuit; by Aya Osama</p>
</footer>

</body>
</html>

