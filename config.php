<?php
// Establishing Connection with Server by passing server_name, user_id, password, and table as a parameter
$mysqli = mysqli_connect('localhost','root','','nsu_acm') or die(mysqli_error());
//start a new session
session_start();
?>
