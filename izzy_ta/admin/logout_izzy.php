<?php

require('inc/essentials_izzy.php');

session_start();
session_destroy();
redirect('index_admin_izzy.php');

?>