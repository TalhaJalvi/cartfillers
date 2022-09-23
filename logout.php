<?php
session_start();
//Writing it is necessary when dealing with logout ang login etc
session_destroy();
//Destroying our session
header('location:index.php');
//redirecting to index.php main page
?>