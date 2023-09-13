<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = 'Omkar@123';
$DATABASE = 'signupforms';

// Establish a database connection
$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

// Check if the connection was successful
if (!$con) {
    die(mysqli_error($con));
}
?>
