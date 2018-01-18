<?php 

// initialize session
session_start();

// If session variable not set, redirect to login page
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("location: register.php");
}



// require config file
require_once 'config.php';

// Define variables and initialize
$groupname = $grouppassword = "";
$groupname_err = $grouppassword_err = $groupnamejoin_err = $grouppasswordjoin_err = $groupnametojoin = $grouppasswordtojoin = "";


// Processing form data when form Create Group is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    // switch statements to execute based on which form was submitted.
    switch ($_POST['group-forms']){
        case 'create-group':
            // Validate and execute statements
            
            // Validate Group Name
            if (empty(trim($_POST['group-name']))) {
                $groupname_err = "Please enter your group name.";
            } 
            else {
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
            } 
            else if (strlen(trim($_POST['group-password'])) < 6) {
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
                        $groupID = mysqli_insert_id($link);
                        $_SESSION['group_name'] = $groupname;
                        $_SESSION['group_id'] = $groupID;
                        header("location: index.php");

                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }

                // Close statement
                mysqli_stmt_close($stmt);

                // Create variable from SESSION for logged in usersID
                $userID = $_SESSION['user_id'];
                

                // Create query to insert user_id from users and group_id from groups into user2group
                $sql = "INSERT INTO user2group (user_id, group_id) VALUES ('$userID', '$groupID')";
                $result = mysqli_query($link, $sql);

            } // Check input errors if statement

            // Close connection
                mysqli_close($link);

            break;
            
        case 'join-group':
            // Validate and execute statements
             // Check if group-name-join is empty
            if (empty(trim($_POST['group-name-join']))) {
                $groupnamejoin_err = "Please enter the group name you want to join.";
            } else {
                // Prepare select statement
                $groupnametojoin = trim($_POST['group-name-join']);
            } // else (input group name to join not empty)
                
            // check if group-join-password is empty
            if (empty(trim($_POST['group-password-join']))) {
                $grouppasswordjoin_err = "Please enter the group password.";
            } else {
                $grouppasswordtojoin = trim($_POST['group-password-join']);
            }
            
            // Validate credentials
            // query select statement from user2group table to check whether the user belongs to their inputted group.
            // if they belong, error message they are already joined to the group
            // if they don't belong, insert their user_id to their inputted group in user2group

            if (empty($groupnamejoin_err_err) && empty($grouppasswordjoin_err_err)) {
                
                // Query groups TABLE to grab group_id from inputted group_name.
                $sql = "SELECT group_name, group_password FROM groups WHERE group_name = ?";

                // Prepared statement
                if ($stmt = mysqli_prepare($link, $sql)){

                    //Bind variables to prepared statement
                    mysqli_stmt_bind_param($stmt, "s", $param_groupnametojoin);
                    
                    // set parameters
                    $param_groupnametojoin = $groupnametojoin;
                    
                    // attempt to execute prepared statement
                    if (mysqli_stmt_execute($stmt)) {
                        // store result
                        mysqli_stmt_store_result($stmt);
                        
                        // check if groupname exists,if yes, then verify password
                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            
                            // bind results
                            mysqli_stmt_bind_result($stmt, $groupnametojoin, $hashed_grouppassword);
                            
                            if(mysqli_stmt_fetch($stmt)) {
                                if(password_verify($grouppasswordtojoin, $hashed_grouppassword)) {
                                    // password is correct, so user should be added to new group in user2group
                                    $_SESSION['group_name'] = $groupnametojoin;
                                    header("location: index.php");
                                } else {
                                    $grouppasswordjoin_err = 'The group password you entered was not valid.';
                                }
                            }
                            
                        } else {
                            $groupnamejoin_err = 'No account found with that group name.';
                        }
                        
                    } else {
                        echo "Oops! Something went wrong. Please try again.";
                    } // execute statement

                } // prepare if statement
                
                
                // close stmt
                mysqli_stmt_close($stmt);
                
                // Create variable from SESSION for logged in usersID
                $userID = $_SESSION['user_id'];
                
                $sql = "SELECT group_id FROM groups WHERE group_name = '$groupnametojoin'";
                $result = mysqli_query($link, $sql);
                $row = $result->num_rows;
                
                if ($row == 1) {
                    $a = mysqli_fetch_assoc($result);
                    $groupID= $a["group_id"];
                }
                
                // Create query to insert user_id from users and group_id from groups into user2group
                $sql = "INSERT INTO user2group (user_id, group_id) VALUES ('$userID', '$groupID')";
                $result = mysqli_query($link, $sql);
                
                if ($result) {
                    $_SESSION['user_id'] = $userID;
                    $_SESSION['group_id'] = $groupID;
                }
                
            
            } //check if error variables are empty
            
            mysqli_close($link);
            
            break;
            
        case 'launch-group':
            // Validate and execute statements
            
            break;
            
// Processing form data when form Join Group is submitted
// When user enters the group name and password they want to join, they are logging in to that group.
    
        } // switch statement for different group forms
}  // if $_SERVER REQUEST METHOD ==  POST for Group form submittal

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
    <h1>Hi, <strong><?php echo $_SESSION['first_name']; ?></strong></h1>
    <div class="group-wrapper">
        <div id="create-group-wrapper" class="form-wrapper">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h2>Create Group</h2>
                <input type="hidden" name="group-forms" value="create-group">
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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h2>Join Group</h2>
                <input type="hidden" name="group-forms" value="join-group">
                <div class="form-group">
                    <label for="group-name">Group Name<sup>*</sup></label>
                    <input type="text" class="form-control" name="group-name-join" required><span class="help-block"><?php echo $groupnamejoin_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="group-password">Group Password<sup>*</sup></label>
                    <input type="password" class="form-control" name="group-password-join" required><span class="help-block"><?php echo $grouppasswordjoin_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Join Group">
                </div>
            </form>
        </div>
        <div id="group-wrapper" class="form-wrapper">
            <form method="post" action="">
                <h2>Launch Group</h2>
                <input type="hidden" name="group-forms" value="launch-group">
                <div class="form-group">
                    <label for="group-name">Group Name<sup>*</sup></label>
                    <input type="text" class="form-control" name="group-name-launch" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Launch Group">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
