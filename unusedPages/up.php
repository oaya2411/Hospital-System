<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admissions</title>
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
<form method="post" action="valid.php">
<input class="input" type="number"  id="search" name="adm" placeholder="SEARCH BY ID">
<img src="search.png" height="25px" width="25px"id="icon"></img>
</input>
</form>

<?php
    include 'connectionValidation.php';
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
                echo "<p style='text-align:center'><br>Data Inserted successfully &heartsuit;</p>";
            } else {
                echo "Error inserting data: ";
                print_r(sqlsrv_errors());
            }
        }else{
            echo "Error! Be sure that doctor id is correct...";

        }
        }else{
        echo "Error! Be sure that patient id is correct...";
    }
}
?>

<form id="f" class="form" method="post">
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
</form>
<footer style="background-color: #4A55A2; border-radius: 20px; margin:10px">
    <p style="text-align: center; color:ghostwhite;">Developed with all &heartsuit; by Aya Osama</p>
</footer>
</body>
</html>