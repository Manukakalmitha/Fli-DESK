<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit();
}

// Assume connection to database is established here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $theme = $_POST['theme'];
    $notifications = $_POST['notifications'];

    // Update user preferences in the database
    $query = "UPDATE users SET theme='$theme', notifications='$notifications' WHERE id=".$_SESSION['userid'];
    if (mysqli_query($conn, $query)) {
        // Update session variables to reflect changes
        $_SESSION['theme'] = $theme;
        $_SESSION['notifications'] = $notifications;

        // Redirect to profile page with success message
        header("Location: user-profile.php?status=success");
    } else {
        // Handle update failure
        header("Location: user-profile.php?status=error");
    }
}
?>
