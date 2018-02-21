<?php
require('config.php');
unset($_SESSION['username']);
header('Location: index');
$success='You have successfully logged out!';
?>
