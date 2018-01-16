<?php 

// initialize session
session_start();

// Is session variable not set, redirect to login page
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("location: register.php");
}



// require config file
require_once 'config.php';

// Define variables and initialize

$groupname = $grouppassword = "";
$groupname_err = $grouppassword_err = "";



// Processing form data when form is submitted

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    // Validate Group Name
    if (empty(trim($_POST['group-name']))) {
        $groupname_err = "Please enter your group name.";
    } else {
        // Prepare select statement
        $sql = "SELECT group_id FROM groups WHERE group_name = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_groupname);
            
            // Set parameters
            $param_groupname = trim($_POST['group-name']);
            
            // Attempt to execute prepared statement
            if(mysqli_stmt_execute($stmt)) {
                //Store result
                mysqli_stmt_store_result($stmt);
                $groupname = trim($_POST['group-name']);
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    } // else (input group name not empty)
    
    // Validate grouppassword
    if (empty(trim($_POST['group-password']))) {
        $grouppassword_err = "Please enter your group password.";
    } else if (strlen(trim($_POST['group-password'])) < 6) {
        $grouppassword_err = "Password must have at least 6 characters.";
    }
    else {
        $grouppassword = trim($_POST['group-password']);
        
    } // else (input group password not empty)
    
    // Check input errors before inserting in database
    if(empty($groupname_err) && empty($grouppassword_err)) {
        
        // Prepare an INSERT statement
        $sql = "INSERT INTO groups (group_name, group_password) VALUES
        (?, ?)";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            //Bind variables to the prepared statement as parameters
            
            mysqli_stmt_bind_param($stmt, 'ss', $param_groupname, $param_grouppassword);
            
            
            // Set parameters
            $param_groupname = $groupname;
            $param_grouppassword = password_hash($grouppassword, PASSWORD_DEFAULT);
            // Creates password hash
            
            // Attempt to execute prepared statement
            if(mysqli_stmt_execute($stmt)) {
                
                //header("location: login.php");
                
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // create new query to select users ID and store it.
        $email = $_SESSION['email'];
        
        echo 'The email to store is: ' . $email;
        echo '<br>';
        $sql = "SELECT user_id FROM users WHERE email = '$email'";
        $login = mysqli_query($link, $sql);
        
        $row = $login->num_rows;
        echo 'That row is: ' . $row;
        
        if ($row == 1) {
            $userID = mysqli_fetch_assoc($login);
            $userIDtoGroup = $userID['user_id'];
            $sql = "INSERT INTO user2Group (user_id) VALUES ('$userIDtoGroup')";
            $login = mysqli_query($link, $sql);
        }
        
        
    } // Check input errors if statement
    
    // Close connection
        mysqli_close($link);
    
    
} // if $_SERVER REQUEST METHOD ==  POST

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Create or Join a Group</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <h1>Hi, <strong><?php echo $_SESSION['first-name']; ?></strong></h1>
    <div class="group-wrapper">
        <div id="create-group-wrapper" class="form-wrapper">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h2>Create Group</h2>
                <div class="form-group">
                    <label for="group-name">Group Name<sup>*</sup></label>
                    <input type="text" class="form-control" name="group-name" required><span class="help-block"><?php echo $groupname_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="group-password">Group Password<sup>*</sup></label>
                    <input type="password" class="form-control" name="group-password" required><span class="help-block"><?php echo $grouppassword_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Create Group">
                </div>
            </form>
        </div>

        <div id="join-group-wrapper" class="form-wrapper">
            <form method="post" action="loginGroup.php">
                <h2>Join Group</h2>
                <div class="form-group">
                    <label for="group-name">Group Name<sup>*</sup></label>
                    <input type="text" class="form-control" name="group-name-join" required>
                </div>
                <div class="form-group">
                    <label for="group-password">Group Password<sup>*</sup></label>
                    <input type="password" class="form-control" name="group-password-join" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Join Group">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
