<?php
// This function fetches AI insights from Gemini API using cURL
function fetchGeminiAIInsights($data) {
    $apiKey = 'AIzaSyCs2j9o4g68zF2CoS5H7vmRQguQ57_m_FA';  // Replace with your actual API key
    $url = 'http://localhost:3000/public/gemini-insights.php';  // Replace with the actual API endpoint

    // Prepare data to send
    $postData = json_encode($data);

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute the API call
    $response = curl_exec($ch);
    curl_close($ch);

    // Return the API response
    return json_decode($response, true);
}

// Example usage of the function
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $analyticsData = [
        'followers' => 5000,
        'engagement' => 350,
        'web_traffic' => 10000
    ];

    $insights = fetchGeminiAIInsights($analyticsData);
    echo json_encode($insights);
}
?>
