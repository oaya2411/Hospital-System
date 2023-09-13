

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Data</title>
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

<form class="form" method="post" action="Deletion2.php" >
    <fieldset class="field" style="margin-top: 0px">
        <legend><h1>Delete The Data Of</h1></legend>
        
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
</form>

<!-- 
    // if(isset($_POST['deleteProvinces']))
    // {
    //     $id = key($_POST['deleteProvinces']);
    //     //echo key($_POST['Update']);
    //     $query = "DELETE FROM provinces
    //                 where province_id = $id";
    //     $result = sqlsrv_query($conn, $query);
    //     if($result == true){
    //         echo "SUCCESS";
    //     }else{
    //         print_r(sqlsrv_errors());
    // }
    // }
    // if(isset($_POST['DeleteAdmission'])){
    //     $id = key($_POST['DeleteAdmission']);
    //     $query = "DELETE FROM admission
    //                 WHERE admission_id= $id";
    //     $exec = sqlsrv_query($conn, $query);
    //     if($exec == true){
    //         echo "SUCCESS";
    //     }else{
    //         print_r(sqlsrv_errors());
    // }
    // }

    // if(isset($_POST['deletePatient'])){
    //     $id = key($_POST['deletePatient']);
    //     $query = "DELETE FROM patient
    //     WHERE patient_id = $id";
    //     $exec = sqlsrv_query($conn, $query);
    //     if($exec == true){
    //         echo "SUCCESS";
    //         }else{
    //             print_r(sqlsrv_errors());
    //         }
    //     } -->
<?php
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
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['specialty'] . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="DeleteDoc['.$row['doctor_id'].']" value="Delete">'. "</td>";
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
                    <th>Update</th>
                </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['patient_id'] . "</td>";
                    echo "<td>" . $row['first_name']  . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['birth_date'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['province_id'] . "</td><br>";
                    echo "<td>" . $row['allergies'] . "</td>";
                    echo "<td>" . $row['height'] . "</td>";
                    echo "<td>" . $row['width'] . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="deletePatient['.$row['patient_id'].']" value="Delete">'. "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:0px 20px 10px 20px ;padding:7px'>
                        Unfortunately,Table Is Empty... Insert New Patient From Patients section...</div>";
            }
        }
        if(isset($_POST['admissions'])){
            $insert = "SELECT [admission_id] ,[patient_id]
                    ,[attending_doctor_id]
                    ,[diagnosis]
                    ,convert(varchar(100),[admission_date], 105) as [admission_date]
                    ,convert(varchar(100),[discharge_date], 105) as[discharge_date]
                FROM [hospital].[dbo].[admission]";
            $result = sqlsrv_query($conn, $insert);
            if(sqlsrv_has_rows($result)){
                echo "<h3>Admissions Table</h3>";
                echo "<table>
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
                    echo "<td>" . $row['attending_doctor_id'] . "</td>";
                    echo "<td>" . $row['diagnosis'] . "</td>";
                    echo "<td>" .  $row['admission_date'] . "</td>";
                    echo "<td>" . $row['patient_id'] . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="DeleteAdmission['.$row['admission_id'].']" value="Delete">'. "</td>";
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
                    echo "<td>" .  $row['province_name'] . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="deleteProvinces['.$row['province_id'].']" value="Delete">'. "</td>";
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
<footer style="background-color: #4A55A2; border-radius: 20px; margin-left: 20px; margin-right: 20px ;margin-top: 200px;">
    <p style="text-align: center; color:ghostwhite;">Developed with all &heartsuit; by Aya Osama</p>
</footer>

</body>
</html>

