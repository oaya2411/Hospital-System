
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Provinces</title>
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
<!-- Add New Province -->
<form class="addNew" action='provs.php' method='post'>
    <button style="background-color:ghostwhite;border-style:none;cursor:pointer" type="submit" name="prov" id="addButton"><img style="background-color:ghostwhite;" title="Add New Province" height="50px" weight="50px" src="images/plus.png"></button>
</form>

<!-- Display All Data -->
<form class="form1" method="post" action="provs.php">
    <div class="button-container" onmouseover="animateButton(this)" onmouseout="resetButton(this)">
        <button type="submit" name="sub" class="image-container">
            <img title="Display Province Info" id="docPic" src="images/building.png">
        </button>
        <div class="TextArea">
            Display The Data Of Provinces By Clicking On Doctor Image ^^.
        </div>
    </div>
</form>

<!-- search for provinces -->
<form method="post" action="valid.php"> 
    <input class="input" type="number" id="search" name="prov" placeholder="SEARCH BY ID">
        <img src="images/search.png" height="25px" width="25px"id="icon"></img>
    </input>
</form>


<?php include 'connectionValidation.php';?>

<?php
    if(isset($_POST['insert'])){
        $name = $_POST['name'];
        $repetition = "select count($name)";
        $insert = "INSERT INTO provinces(province_name) VALUES (?) 
                    ";
        $params = array($name);
        $query1 = sqlsrv_prepare($conn, $insert, $params);
        if(sqlsrv_execute($query1)){
            echo "
                <p style='text-align:center'><br>Data Inserted successfully &heartsuit;</p>";
        } else {
            echo "<br><div style='background-color:#ffcccc; border-radius:20px; margin:auto ;padding:3px'>Error inserting data: This province name is already existing.. Please insert new one...</div>";
        }
    }

    if(isset($_POST['prov'])){
        echo '<style>
                .form1 {
                    display: none; /* Make the content invisible */
                    height:0;
                    width:0;
                }
            </style>';
        echo'<form id="f" class="form" method="post" action="provs.php">
                <fieldset class="field">

                    <legend><h1>Insert New Province</h1></legend>

                    <br> 

                    <label class="label" for="prov_name">Province Name</label>
                    <input class="input type="text" id="prov_name" name="name" required> <span></span>
                    
                    <br>

                    <button class="b1" name="insert"  type="submit" value="Submit">Submit Info</button>

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
        $query = "DELETE FROM provinces
                    WHERE province_id = $id";
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
        echo '<form action="provs.php" method="post"><div id="confirmMessage">';
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
        $provinceName = $_POST["province_name$id"];
        $search = "SELECT * from provinces where province_name = '$provinceName'";
        $exe = sqlsrv_query($conn, $search);
        if(sqlsrv_has_rows($exe)){           
            echo "<p style=' text-align:center; '>This Province Name Exist, Please Update It To Unique One.</p>";
        }else{
            $query = "UPDATE provinces
                set province_name = '$provinceName'
                where province_id = $id";
            $result = sqlsrv_query($conn, $query);
            if($result == true){
                echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Updated Successfully</div>";
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
        $insert = "SELECT * FROM provinces where province_id = $id;";
            $result = sqlsrv_query($conn, $insert);
            if(sqlsrv_has_rows($result)){
                echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Province Name</th>
                    <th>UPDATE</th>
                </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo '<form method="post" action="provs.php">';
                    echo "<td>" . $row['province_id'] . "</td>";
                    echo "<td>" . "<input type='textbox' class='tableData' name='province_name".$row["province_id"]."' value=" . $row['province_name'] ." ></input>" . "</td>";
                    echo "<td>" . '<input type="submit" id="updateButton" name="Update['.$row['province_id'].']" value="Update"></form>'. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "<P style='margin:10px;'>Update the data you want by clicking on the field you want to update on.<br>NOTE:Editing ID Isn't allowed...</P>";
    }
}
    
    //Display The Data In Table
    if(isset($_POST['sub'])){
            echo '<style>
                    .form1 {
                        display: none; /* Make the content invisible */
                        height:0;
                        width:0;
                    }
                    
                </style>';
            $insert = "SELECT * FROM provinces";
            $result = sqlsrv_query($conn, $insert);
            if(sqlsrv_has_rows($result)){
                echo "<h3>Doctors Table</h3>";
                echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Province Name</th>
                    <th>Option</th>
                </tr>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    echo "<tr>";
                    echo "<td>" . $row['province_id'] . "</td>";
                    echo "<td>" . $row['province_name'] . "</td>";
                    echo "<td>" . '<form method="post" action="provs.php"><button type="submit" id="deleteButton" class="basket" name="update['.$row['province_id'].']"><img title="Update Data" height="50px" width="50px" src="images/edit.png"></button>';
                    echo '<button type="submit" id="deleteButton" class="basket" name="delete['.$row['province_id'].']"><img title="Delete" height="50px" width="50px" src="images/delete.png"></button></form>'. "</td>";
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

