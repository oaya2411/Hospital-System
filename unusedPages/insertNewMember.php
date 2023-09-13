<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Member</title>
    <link rel="stylesheet" href="patient.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="icon" type="image/x-icon" href="medical.png">
</head>
<body>
<?php
    include 'connectionValidation.php';
    if(isset($_POST['insert1'])){
        $first_name = $_POST['fName'];
        $last_name = $_POST['lName'];
        $specialty = $_POST['sp'];
        $insert = "INSERT INTO doctors( first_name,last_name ,specialty)
                                VALUES (?,?,?)";
        $params = array( $first_name, $last_name, $specialty);
        $query1 = sqlsrv_prepare($conn, $insert, $params);
        if(sqlsrv_execute($query1) === TRUE){
            echo "<p style='text-align:center'><br>Data Inserted successfully &heartsuit;</p>";
        } else {
            echo "<br>Error inserting data: ";
            print_r(sqlsrv_errors());
        }
    }

    if(isset($_POST['doc'])){
        echo'<form id="f" class="form" method="post" action="insertNewMember.php">
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
?>

<script>
body{
    background-image:'search.png';
}
</script>
</body>

</html>
