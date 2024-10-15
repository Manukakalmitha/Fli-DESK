<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fli Desk - User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">User Profile</h2>
    <form action="update-profile.php" method="POST">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" value="<?php echo $_SESSION['email']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="theme">Theme</label>
            <select class="form-control" id="theme" name="theme">
                <option value="light" <?php if ($_SESSION['theme'] == 'light') echo 'selected'; ?>>Light</option>
                <option value="dark" <?php if ($_SESSION['theme'] == 'dark') echo 'selected'; ?>>Dark</option>
            </select>
        </div>

        <div class="form-group">
            <label for="notifications">Receive Email Notifications</label>
            <select class="form-control" id="notifications" name="notifications">
                <option value="1" <?php if ($_SESSION['notifications'] == 1) echo 'selected'; ?>>Yes</option>
                <option value="0" <?php if ($_SESSION['notifications'] == 0) echo 'selected'; ?>>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

</body>
</html>
