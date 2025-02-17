<?php
require('inc/essentials_izzy.php');
require('inc/koneksi_db_izzy.php');
session_start();
session_regenerate_id(true);
if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'==true])){
    redirect('dashboard_izzy.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php require('inc/links_izzy.php'); ?>
    <style>
    div.login-form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
    }
    </style>
</head>

<body class="bg-light">
    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none: text-center"
                        placeholder="nama si admin">
                </div>
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control shadow-none text-center"
                        placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    <?php

        if(isset($_POST['login'])){
            $frm_data = filteration($_POST);

            $querry = "SELECT * FROM admin_izzy Where username_admin_izzy=? AND password_admin_izzy = ?";
            $values = [$frm_data['admin_name'],$frm_data['admin_pass']];

            $res = select($querry,$values,"ss");
            if ($res->num_rows==1){
                $row = mysqli_fetch_assoc($res);
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $row['id_admin_izzy'];
                redirect('dashboard_izzy.php');
            }
            else{
                alert('error','Login failed - Invalid');
            }
       }
    ?>

    <?php require('inc/script_izzy.php'); ?>
</body>

</html>