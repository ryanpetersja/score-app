<?php
    session_start();
    $title = "Logout";

    $_SESSION['logged-in'] = false;
    $_SESSION['user'] = "";
    header("location: index.php");
?>