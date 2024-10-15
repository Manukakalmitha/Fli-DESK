function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var id_token = googleUser.getAuthResponse().id_token;

    // Send the ID token to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'redirect.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.responseText === 'success') {
            window.location.href = 'http://localhost:3002/dashboard.php';
        } else {
            document.getElementById('status').innerText = 'Login failed. Please try again.';
        }
    };
    xhr.send('idtoken=' + id_token);
}
