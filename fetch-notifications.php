<?php
session_start();
// Fetch user notifications from the database
// Assume connection to database is established

$userId = $_SESSION['userid'];
$query = "SELECT * FROM notifications WHERE user_id = $userId ORDER BY created_at DESC LIMIT 10";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="alert alert-info">' . $row['message'] . ' - ' . $row['created_at'] . '</div>';
    }
} else {
    echo '<p>No new notifications.</p>';
}
?>
