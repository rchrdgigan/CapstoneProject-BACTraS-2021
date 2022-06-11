<?php
session_start();
session_destroy();
header('location:../merchant.php');
?>