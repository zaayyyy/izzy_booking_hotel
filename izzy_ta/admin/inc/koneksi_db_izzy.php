<?php
$servername = "localhost"; 
$username   = "root"; 
$pass       = ""; 
$db         = "booking_hotel_izzy"; 

$con = mysqli_connect($servername, $username, $pass, $db);

if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!function_exists('filteration')) {
    function filteration($data) {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            $data[$key] = stripslashes($data[$key]);
            $data[$key] = strip_tags($data[$key]);
            $data[$key] = htmlspecialchars($data[$key]);
        }
        return $data;
    }
}


if (!function_exists('select')) {
    function select($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query tidak bisa dieksekusi - Select");
            }
        } else {
            die("Query tidak bisa disiapkan - Select");
        }
    }
}

?>