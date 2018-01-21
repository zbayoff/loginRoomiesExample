<?php 


session_start();
// If session variable not set, redirect to login page
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("location: register.php");
}

// require config file
require_once 'config.php';

// define and initialize variables
$groupname = "";

$groupname = $_SESSION['group_name'];
$currentUserfName = $_SESSION['first_name'];
$currentUserlName = $_SESSION['last_name'];
$currentUserEmail = $_SESSION['email'];
$userID = $_SESSION['user_id'];

$fNames = [];
$lNames = [];
$emails = [];
$userIDS = [];
$usersTableArray = [];


// query to output all users associated with the current group

    
    $sql = "SELECT users.user_id, fName, lName, email, group_name FROM user2group
            JOIN users on users.user_id = user2group.user_id
            JOIN groups on groups.group_id = user2group.group_id 
            WHERE groups.group_name = '$groupname'";

    $result = mysqli_query($link, $sql);

        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                
                $usersTableArray[$row['user_id']] = $row['fName'];
                
                $fNames[] = $row['fName'];
                $lNames[] = $row['lName'];
                $emails[] = $row['email'];
                $userIDS[] = $row['user_id'];
                
                /*echo "user_id: " . $row['user_id'] . "First Name: " . $row['fName'] . "Last Name: " . $row['lName'] . "Email: " . $row['email'] . "Group Name: " . $row['group_name'];*/
            }
        }

    mysqli_close($link);







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
    <nav>
        <a href="groups.php">Groups</a>
    </nav>
    <div>
        <a href="logout.php">Log Out</a>
    </div>
    <h1>Hi, <strong><?php echo $_SESSION['first_name']; ?></strong></h1>
    <h3>Welcome to
        <?php echo $_SESSION['group_name']; ?>
    </h3>

    <div>
        <form class="form-inline">
            <div class="form-group">
                <label class="mr-2" for="roomie-dashboard-select">Showing: </label>
                <select id="roomie-dashboard-select" class="form-control">
                    <?php  
                    
                        foreach($usersTableArray as $key=>$value) {
                                echo "<option value= '$key'>" . $value . "</option>";
                        }
                    
                    ?>
                </select>
            </div>
        </form>
    </div>

</body>

</html>
