<?php

include 'connection.php';

$number = count($_POST["company"]);
if ($number > 0){
    for($i = 0; $i < $number; $i++){
        if(trim($_POST["company"][$i]) != ''){
        #$sql = 'INSERT INTO internship VALEUS('".mysqli_real_escape_string($connect, $_POST["company"][$i]."')';
        mysqli_query($connect, $sql);
        }
    }
    echo 'Data Inserted';
}
else{
    echo "Enter Name";
}
?>