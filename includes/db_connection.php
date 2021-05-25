 <?php

$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "myintern_app";

$connection = mysqli_connect($sname, $uname, $password, $db_name );

if (!$connection) {
    echo "Connection Failed!";
}