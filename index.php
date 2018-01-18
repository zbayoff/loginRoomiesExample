<?php 


session_start();
// If session variable not set, redirect to login page
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("location: register.php");
}

// require config file
require_once 'config.php';


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
    <h1>Hi, <strong><?php echo $_SESSION['first_name']; ?></strong></h1>
    <h3>Welcome to <?php echo $_SESSION['group_name']; ?><span> which is also <?php echo $_SESSION['group_id']; ?></span></h3>
</body>
</html>