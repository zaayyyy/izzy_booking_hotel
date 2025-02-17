<?php
$servername = "localhost"; 
$username = "root"; 
$pass = ""; 
$db = "booking_hotel_izzy"; 

$con = mysqli_connect($servername, $username, $pass, $db);

if (!$con) {
    die("Koneksi gagal" . mysqli_connect_error());
}

function filteration($data){
    foreach($data as $key => $value){
        $data[$key] = trim($value);
        $data[$key] = stripslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}
function select($sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql)){

        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if (mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("querry tidak bisa di eksekusi - Select");
            
        }
    }
    else{
        die("querry tidak bisa di siapkan - Select");
    }
}
?>