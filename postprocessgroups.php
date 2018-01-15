<?php 

// Require login credentials for localhost hostname, username, password, and database 
require_once 'login.php';

// Open connection to mysql
$conn = mysqli_connect($hn, $un, $pw, $db);

// Check if connection was valid
if ($conn->connect_error){
    die($conn->connect_error);
}

// CREATE GROUP
// Read in values from group.php POST
if(isset($_POST['group-name']) && 
   isset($_POST['group-password'])  
){
    $groupName = $_POST['group-name'];
    $groupPassword = $_POST['group-password'];

    // Make query to insert new user info into database roomietest, table users

    $query = "INSERT INTO groups (group_name, group_pwd) VALUES
        ('$groupName','$groupPassword')";
    mysqli_query($conn, $query);

    if (!$conn) {
        echo "INSERT failed: ". $conn->error;
    }
    
}

// Close mysql connection
mysqli_close($conn);

// Go to group.php page to login or create a group
//header('Location: groups.php');



/*echo 'First Name: '.$firstName. '<br>';
echo 'Last Name: '.$lastName. '<br>';
echo 'Email: '.$email. '<br>';
echo 'Password: '.$password. '<br>';*/





?>
