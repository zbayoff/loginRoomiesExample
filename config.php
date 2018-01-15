<?php 

/*Database credentials.Running MySQL server with default setting (user root and password root)*/
$hn = 'localhost';
$db = 'roomietest';
$un = 'root';
$pw = 'root';

/* Attempt to connect to MySQL database */
$link = mysqli_connect($hn, $un, $pw, $db);

/* Check connection */
if ($link === false){
    die ("ERROR: Could not connect. " . mysqli_connect_error());
}


?>