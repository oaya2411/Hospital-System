
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result</title>
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
<div style="margin:100px 0px 0px 0px">
<h1>Result:</h1>
<?php
    include 'connectionValidation.php';
    if(isset($_POST['patient'])){
        $id = $_POST['patient'];
        $search = "SELECT [patient_id]
        ,[first_name]
        ,[last_name]
        ,[gender]
        ,convert(varchar(50),[birth_date], 103) as [birth_date]
        ,[city]
        ,[province_id]
        ,[allergies]
        ,[height]
        ,[width]
        FROM [patient]
        where patient_id = $id";
        $result = sqlsrv_query($conn, $search);
        if(sqlsrv_has_rows($result)){
            // echo "<h3 style='margin:30px 2px 2px 5px'>Result Of Searching</h3>";
            echo "<table class='result'>
            <tr class='re'>
                <th class='res'>ID</th>
                <th class='res'>first name</th>
                <th class='res'>last name</th>
                <th class='res'>Gender</th>
                <th class='res'>Birthdate</th>
                <th class='res'>City</th>
                <th class='res'>Province ID</th>
                <th class='res'>Allergies</th>
                <th class='res'>Height</th>
                <th class='res'>Width</th>
            </tr>";
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo "<tr class='re'>";
                echo "<td>" . $row['patient_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['birth_date'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['province_id'] . "</td>";
                echo "<td>" . $row['allergies'] . "</td>";
                echo "<td>" . $row['height'] . "</td>";
                echo "<td>" . $row['width'] . "</td>";
                echo "</tr>";
            }
        echo "</table>";        
    }else{
        echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:30px 20px 10px 50px ;padding:7px'>
            Error!! This id doesn't exist in the system... Please search for existed one</div>";
    }
}

    if(isset($_POST['doc'])){
        $id = $_POST['doc'];
        $search = "SELECT * from doctors
                    where doctor_id = $id";
        $result = sqlsrv_query($conn, $search);
        if(sqlsrv_has_rows($result)){
            // echo "<h3 style='margin:30px 2px 2px 5px'>Result Of Searching</h3>";
            echo "<table class='result'>
            <tr class='re'>
                <th class='res'>ID</th>
                <th class='res'>first name</th>
                <th class='res'>last name</th>
                <th class='res'>specialty</th>
            </tr>";
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo "<tr class='re'>";
                echo "<td>" . $row['doctor_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['specialty'] . "</td>";
                echo "</tr>";
            }
        echo "</table>";        
    }else{
        echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:30px 20px 10px 50px ;padding:7px'>
            Error!! This id doesn't exist in the system... Please search for existed one</div>";
    }
    }
    if(isset($_POST['adm'])){
        $id = $_POST['adm'];
        $search = "SELECT [admission_id],[patient_id]
                        ,[attending_doctor_id]
                        ,[diagnosis]
                        ,convert(varchar(50),[admission_date], 103) as [admission_date]
                        ,convert(varchar(50),[discharge_date], 103) as[discharge_date]
                    FROM [hospital].[dbo].[admission] 
                    WHERE admission_id = $id";
        $result = sqlsrv_query($conn, $search);
        if(sqlsrv_has_rows($result)){
            // echo "<h3 style='margin:30px 2px 2px 5px'>Result Of Searching</h3>";
            echo "<table class='result'>
            <tr class='re'>
            <th class='res'>Admission ID</th>
            <th class='res'>Patient ID</th>
            <th class='res'>Attending Doctor ID</th>
                <th class='res'>Diagnosis</th>
                <th class='res'>Admission Date</th>
                <th class='res'>Discharge Date</th>
            </tr>";
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo "<tr class='re'>";
                echo "<td>" . $row['admission_id'] . "</td>";
                echo "<td>" . $row['patient_id'] . "</td>";
                echo "<td>" . $row['attending_doctor_id'] . "</td>";
                echo "<td>" . $row['diagnosis'] . "</td>";
                echo "<td>" . $row['admission_date'] . "</td>";
                echo "<td>" . $row['discharge_date'] . "</td>";
                echo "</tr>";
            }
        echo "</table>";        
    }else{
        echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:30px 20px 10px 50px ;padding:7px'>
            Error!! This id doesn't exist in the system... Please search for existed one</div>";
    }
    }
    if(isset($_POST['prov'])){
        $id = $_POST['prov'];
        $search = "SELECT * from provinces
                    where province_id = $id";
        $result = sqlsrv_query($conn, $search);
        if(sqlsrv_has_rows($result)){
            // echo "<h3 style='margin:30px 2px 2px 5px'>Result Of Searching</h3>";
            echo "<table class='result'>
            <tr class='re'>
                <th class='res'>ID</th>
                <th class='res'>Province Name</th>
            </tr>";
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo "<tr class='re'>";
                echo "<td>" . $row['province_id'] . "</td>";
                echo "<td>" . $row['province_name'] . "</td>";
                echo "</tr>";
            }
        echo "</table>";        
    }else{
        echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:30px 20px 10px 50px ;padding:7px'>
            Error!! This id doesn't exist in the system... Please search for existed one</div>";
    }
}

?>
</div>


</body>
</html>