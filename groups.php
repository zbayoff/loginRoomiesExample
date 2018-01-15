




<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Create or Join a Group</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div class="group-wrapper">
        <div id="create-group-wrapper" class="form-wrapper">
            <form method="post" action="postprocessgroups.php">
                <h2>Create Group</h2>
                <div class="form-group">
                    <label for="group-name">Group Name</label>
                    <input type="text" class="form-control" name="group-name" required>
                </div>
                <div class="form-group">
                    <label for="group-password">Group Password</label>
                    <input type="password" class="form-control" name="group-password" required>
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
                    <label for="group-name">Group Name</label>
                    <input type="text" class="form-control" name="group-name-join" required>
                </div>
                <div class="form-group">
                    <label for="group-password">Group Password</label>
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
