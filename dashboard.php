<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fli Desk - Advanced Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js for advanced graphing -->
</head>
<body>

<!-- Sidebar -->
<div class="d-flex" id="wrapper">
    <div class="bg-dark text-white" id="sidebar-wrapper">
        <div class="sidebar-heading">Fli Desk</div>
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
            <a href="user-profile.php" class="list-group-item list-group-item-action bg-dark text-white">Profile</a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Analytics</a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">AI Insights</a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Reports</a>
            <a href="php/logout.php" class="list-group-item list-group-item-action bg-danger text-white">Logout</a>
        </div>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid p-4">
            <h1 class="mt-4">Welcome, <?php echo $_SESSION['email']; ?>!</h1>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Real-Time Social Media Analytics</div>
                        <div class="card-body">
                            <canvas id="socialMediaChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Real-Time Web Traffic</div>
                        <div class="card-body">
                            <canvas id="webTrafficChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
    <form action="php/export-report.php" method="POST">
        <button type="submit" class="btn btn-primary">Export Report as PDF</button>
    </form>
    
</div>
<div class="card mt-4">
    <div class="card-header">AI-Powered Insights</div>
    <div class="card-body">
        <p id="ai-insights">Loading AI insights...</p>
    </div>
</div>
<script>
function displayAIInsights() {
    fetch('/public/gemini-insights.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.summary) {
                document.getElementById('ai-insights').innerText = data.summary;
            } else {
                document.getElementById('ai-insights').innerText = "No AI insights available.";
            }
        })
        .catch(error => {
            console.error('Error fetching AI insights:', error);
            document.getElementById('ai-insights').innerText = "Error loading AI insights.";
        });
}

// Load AI insights when the page is ready
document.addEventListener('DOMContentLoaded', displayAIInsights);
</script>


        </div>
        <!-- Notification Button -->
<button type="button" class="btn btn-secondary position-relative" id="notificationsButton">
    Notifications
    <span class="badge badge-danger position-absolute top-0 start-100 translate-middle">3</span>
</button>

<!-- Notification Modal -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationsModalLabel">Notifications</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="notificationsContent">
        <!-- Notifications will be dynamically loaded here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// AJAX to fetch notifications
document.getElementById('notificationsButton').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/fetch-notifications.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('notificationsContent').innerHTML = this.responseText;
        }
    };
    xhr.send();
});
</script>

    </div>
</div>

<script src="/assets/js/charts.js"></script>
</body>
</html>
