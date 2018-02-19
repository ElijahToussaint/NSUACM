<?php
require('config.php');
unset($_SESSION['username']);
header('Location: index.php');
$success='You have successfully logged out!';
?>
