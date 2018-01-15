<?php 

// Require login credentials for localhost hostname, username, password, and database 
require_once 'login.php';

// Open connection to mysql
$conn = mysqli_connect($hn, $un, $pw, $db);

// Check if connection was valid
if ($conn->connect_error){
    die($conn->connect_error);
}

// Read in values from signup.php POST
if(isset($_POST['first-name']) && 
   isset($_POST['last-name']) && 
   isset($_POST['email']) &&
   isset($_POST['password'])
){
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Make query to insert new user info into database roomietest, table users

    $query = "INSERT INTO users (fName, lName, email, pwd) VALUES
        ('$firstName','$lastName','$email','$password')";
    mysqli_query($conn, $query);

    if (!$conn) {
        echo "INSERT failed: ". $conn->error;
    }
    
}

// Close mysql connection
mysqli_close($conn);

// Go to group.php page to login or create a group
header('Location: groups.php');



/*echo 'First Name: '.$firstName. '<br>';
echo 'Last Name: '.$lastName. '<br>';
echo 'Email: '.$email. '<br>';
echo 'Password: '.$password. '<br>';*/





?>
