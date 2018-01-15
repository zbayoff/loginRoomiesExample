<?php 

// require config file
require_once 'config.php';

// Define variables and initialize

$username = $password = $confirm_password = $firstname = $lastname = $email = "";
$firstname_err = $lastname_err = $email_err = $passwrod_err = $confirm_password_err = "";

// Processing form data when form is submitted

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    // Validate First Name
    if (empty(trim($_POST['first-name']))) {
        $firstname_err = "Please enter your first name.";
    } else {
        // Prepare select statement
        $sql = "SELECT user_id FROM users WHERE fName = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_firstname);
            
            // Set parameters
            $param_firstname = trim($_POST['first-name']);
            
            // Attempt to execute prepared statement
            
            if(mysqli_stmt_execute($stmt)) {
                //Store result
                mysqli_stmt_store_result($stmt);
                $firstname = trim($_POST['first-name']);
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate last name
    
    
    
    
} // if $_SERVER REQUEST METHOD ==  POST



?>





<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div class="form-wrapper">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="first-name">First Name<sup>*</sup></label>
                <input type="text" class="form-control" name="first-name"><span class="help-block"><?php echo $firstname_err; ?></span>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" class="form-control" name="last-name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create Account">
            </div>
        </form>
    </div>
</body>

</html>
