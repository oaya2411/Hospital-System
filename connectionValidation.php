<?php
    $serverName = "OSHOO";
    $connInfo = array("Database" => "hospital", "UID" => "", "PWD" => "");
    $conn = sqlsrv_connect($serverName, $connInfo);
    if($conn === false){
        echo "Connecting failed!!";
        die (print_r(sqlsrv_errors(), true));
    }
?>

