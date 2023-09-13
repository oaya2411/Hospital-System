<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patient.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="icon" type="image/x-icon" href="medical.png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <!-- <fieldset id="message">
        <legend><img width="80px" height="80px" src="warning.png"></legend>
        <div>Are You Sure You want to delete?</div>
        <input class="con" type="submit" name="yes" value="YES" id="confirm">
        <input class="con" type="submit" name="no" value="NO" id="refuse">
    </fieldset> -->
<form id="upDel" class="upDel" method="post" action="Deletion.php">
    <label>Select the table you want to delete from </label>
    <select id="select" name="tables">
        <option id="op" name="doc">Doctors</option>
        <option name="pat">Patients</option>
        <option name="adm">Admissions</option>
        <option name="prov">Provinces</option>
    </select>
    <br>
    <label for="in">Enter ID:</label>
    <input class="input" type="number" name="id" id="in" required>

    <button class="b1" name="del">Delete</button>

    <!-- <div class="confirmation">
<fieldset class="message">
        <legend><img width:"80px" height="80px" src="warning.png"></legend>
        <div>Are You Sure You want to delete?</div>
        <input type="submit" name="yes" value="YES" id="confirm">
        <input type="submit" name="no" value="NO" id="refuse">
    </fieldset>
</div> -->
</form>

<?php
    if(isset($_POST['Update'])){
        $id = key($_POST['Update']);
        echo $id;
        //echo key($_POST['Update']);
        $query = "DELETE FROM doctors
                        WHERE doctor_id = $id";
        $result = sqlsrv_query($conn, $query);
        if($result == true){
            echo "Successfully, Data Is Deleted ^^.";
        }else{
            print_r(sqlsrv_errors());
    }
}
    // echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Deleted Successfully</div>";
    
    include 'connectionValidation.php';
    if(isset($_POST['del'])){
        $id = $_POST['id'];
        $select = "";
        $table = $_POST['tables'];
        $query="";
        if($table === 'Doctors'){
            $select = "SELECT * FROM doctors
                        where doctor_id = $id";
        }else if($table === 'Patients'){
            $select = "SELECT * FROM patient
                        where patient_id = $id";
        }else if($table === 'Admissions'){
            $select = "SELECT * FROM admission
            where patient_id = $id";
        }else{
            $select = "SELECT * FROM provinces
            where province_id = $id";
        }
        $exec = sqlsrv_query($conn, $select);
        if(sqlsrv_has_rows($exec)){
            if($table === 'Doctors'){
                $insert = "SELECT * FROM doctors where doctor_id = $id;";
                $result = sqlsrv_query($conn, $insert);
                if(sqlsrv_has_rows($result)){
                    echo "<h4>Are You Sure You Want To Delete That Row?</h4><p>If you want to delete it, press yes from the last column. Be sure that you don't want this as you won't be able to return it again.</p>";
                    echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>first name</th>
                        <th>last name</th>
                        <th>specialty</th>
                        <th>Delete</th>
                    </tr>";
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['doctor_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['specialty'] . "</td>";
                        echo "<td>" . '<form method="post" action="Deletion.php"><button type="submit" id="updateButton" name="Update['.$row['doctor_id'].']">YES</button></form>'. "</td>";
                        echo "</tr>";
                    }
                echo "</table>";
                }
            }else if($table === 'Patients'){
                    $query = "DELETE FROM patient
                    WHERE patient_id = $id";
            }else if($table === 'Admissions'){
                    $query = "DELETE FROM admission
                                WHERE patient_id = $id";
            }else{
                    $query = "DELETE FROM provinces
                    WHERE province_id = $id";
            }
            // $result = sqlsrv_query($conn, $query);
            // if($result == true){
            //         echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Deleted Successfully</div>";
            // }else{
            //         echo "Error deletion data: ";
            //         print_r(sqlsrv_errors());
            //     }
            }else{
            echo "<br><div style='background-color:#ffcccc; border-radius:20px;display:inline-block; margin:30px 20px 10px 50px ;padding:7px'>
            Error!! This ID doesn't exist in this table... Please insert existing one.</div>";
        }   
    }
?>

<footer style="background-color: #4A55A2; border-radius: 20px; margin-left: 20px; margin-right: 20px ;margin-top: 200px;">
    <p style="text-align: center; color:ghostwhite;">Developed with all &heartsuit; by Aya Osama</p>
</footer>

</body>
</html>

