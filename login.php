<?php 

// require config file
require_once 'config.php';

// Define variables and initialize
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    // Check if email is empty
    if(empty(trim($_POST['email']))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST['email']);
    }
    
    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter your password";
    } else {
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare statement
        
        $sql = "SELECT email, user_password FROM users WHERE email = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            // bind variables to the prepared statement as a parameter
            
            mysqli_stmt_bind_param($stmt, 's', $param_email);
            
            // set parameters
            $param_email = $email;
            
            // Attempt to execute prepared statement
            if (mysqli_stmt_execute($stmt)) {
                //store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists 
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variable
                    mysqli_stmt_bind_result($stmt, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            
                            $sql = "SELECT user_id, fName, lName FROM users WHERE email = '$email'";
                            $result = mysqli_query($link, $sql);
                            $row = $result->num_rows;
                            if ($row == 1) {
                                $a = mysqli_fetch_assoc($result);
                                $userID = $a["user_id"];
                                $firstname = $a["fName"];
                                $lastname = $a["lName"];
                            }
                            
                            session_start();
                            $_SESSION['user_id'] = $userID;
                            $_SESSION['first_name'] = $firstname;
                            $_SESSION['last_name'] = $lastname;
                            $_SESSION['email'] = $email;
                            header("location: groups.php");
                        } else {
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                    
                } else {
                    $email_err = "No account found with that email";
                }
                
                
            } else {
                echo 'Oops!. Something went wrong. Please try again later';
            }
            
        } else {
            echo "Statement was not prepared.";
        }
        
        
    } // if email & password errors are empty
    
    
} // if Server Request is POST



?>


<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div class="form-wrapper">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <h2>Login</h2>
            <div class="form-group">
                <label for="email">Email<sup>*</sup></label>
                <input type="email" class="form-control" name="email"><span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password<sup>*</sup></label>
                <input type="password" class="form-control" name="password"><span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <div>
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            </div>
        </form>
    </div>
</body>

</html>
