
<html>
   <head>
      <meta charset="UTF-8">
      <title>Delete Data</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" type="image/x-icon" href="medical.png">
      <link rel="stylesheet" href="patient.css">
</head>
<body>
   <form method="post" action="Deletion.php">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="tables" value="<?php echo $table; ?>">
      <div class="confirmation">
         <fieldset class="message">
            <legend><img width:"80px" height="80px" src="warning.png"></legend>
            <div>Are You Sure You want to delete?</div>
            <input class="con" type="submit" name="yes" value="YES" id="confirm">
            <input class="con" type="submit" name="no" value="NO" id="refuse">
         </fieldset>
      </div>
   </form>
   <!-- second_page.php -->
<?php
   // include 'connectionValidation.php';
   // if ($_SERVER["REQUEST_METHOD"] == "POST") {
   //    $table = $_POST['tables'];
   //    $id = $_POST['id'];
   //    echo $table . " " . $id;
   //    if($table === 'Doctors'){
   //       $query = "DELETE FROM doctors
   //                   WHERE doctor_id = $id";
   //       }else if($table === 'Patients'){
   //          $query = "DELETE FROM patient
   //          WHERE patient_id = $id";
   //    }else if($table === 'Admissions'){
   //          $query = "DELETE FROM admission
   //                      WHERE patient_id = $id";
   //    }else{
   //          $query = "DELETE FROM provinces
   //          WHERE province_id = $id";
   //    }
   //    $result = sqlsrv_query($conn, $query);
   //    if($result == true){
   //          echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Deleted Successfully</div>";
   //    }else{
   //          echo "Error deletion data: ";
   //          print_r(sqlsrv_errors());
   //       }
   // }


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $table = $_POST['tables'];
//    $id = $_POST['id'];
//    $tab = $table."_id";
//    echo $table . " " . $id . " ". $tab;
//    $ta = "SELECT * FROM $table where $id = $tab";
//    if(sqlsrv_has_rows($ta)){
//       echo "<h3>Doctors Table</h3>";
//       echo "<table>
//       <tr>
//          <th>ID</th>
//          <th>first name</th>
//          <th>last name</th>
//          <th>specialty</th>
//          <th>UPDATE</th>
//       </tr>";
//       while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
//             echo "<tr>";
//             echo "<td>" . $row['doctor_id'] . "</td>";
//             echo "<td>" . "<input type='textbox' class='tableData' name='firstName".$row["doctor_id"]."' value=" . $row['first_name'] ." ></input>" . "</td>";
//             echo "<td>" . "<input type='textbox' class='tableData' name='lastName".$row['doctor_id']."' value=" . $row['last_name'] .">" . "</td>";
//             echo "<td>" . "<input type='textbox' class='tableData' name='spec".$row['doctor_id']."' value=" . $row['specialty'] .">" . "</td>";
//             echo "<td>" . '<input type="submit" id="updateButton" name="Update['.$row['doctor_id'].']" value="Update">'. "</td>";
//             echo "</tr>";
//          }
//       echo "</table>";
//    if(isset($_POST['tables']) && isset($_POST['id'])){
//       $table = $_POST['tables'];
//       $id = $_POST['id'];
//       echo $table . " " . $id;
//       if(isset($_POST['yes'])){
//             include 'Deletion.php';
//             if($table === 'Doctors'){
//                $query = "DELETE FROM doctors
//                            WHERE doctor_id = $id";
//                }else if($table === 'Patients'){
//                   $query = "DELETE FROM patient
//                   WHERE patient_id = $id";
//             }else if($table === 'Admissions'){
//                   $query = "DELETE FROM admission
//                               WHERE patient_id = $id";
//             }else{
//                   $query = "DELETE FROM provinces
//                   WHERE province_id = $id";
//             }
//             $result = sqlsrv_query($conn, $query);
//             if($result == true){
//                   echo "<div style='border-radius:20px;height:30px;width:400px;padding:8px;margin:20px;display:inline-block; background-color:#c2f0c2;'>Data Deleted Successfully</div>";
//             }else{
//                   echo "Error deletion data: ";
//                   print_r(sqlsrv_errors());
//                }
//          }

//       //Rest of your code for data deletion
//    }

//    // You can access the values of other input fields similarly
//    // Now, you can use these values as needed
   
//    if(isset($_POST['no'])){
//       echo "Thanks For Confirmation.";
//    }
// }
// } else {
//     // Handle the case where there is no POST data
//    echo "No data received.";
// }

?>

<!-- <style>
   body{
      margin:0;
      padding:0;
      background: ghostwhite;
      color: #3664b6;
      font-family: "Leelawadee UI";
      font-size:large;
   }
   .message{
      margin:200px 100px 0px 500px;
      width: 250px;
      height: 150px;
      padding-left:70px;
      align-items:center;


   }
</style> -->
</body>
</html>

