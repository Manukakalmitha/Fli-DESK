// Social Media Chart
var ctx = document.getElementById('socialMediaChart').getContext('2d');
var socialMediaChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Followers',
            data: [100, 200, 300, 400, 500, 600],
            borderColor: '#007bff',
            fill: false
        }, {
            label: 'Engagement',
            data: [50, 150, 250, 350, 450, 550],
            borderColor: '#28a745',
            fill: false
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Social Media Performance'
        }
    }
});

// Web Traffic Chart
var ctx2 = document.getElementById('webTrafficChart').getContext('2d');
var webTrafficChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Visitors',
            data: [3000, 4000, 5000, 6000, 7000, 8000],
            backgroundColor: '#ff6384'
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Website Traffic Overview'
        }
    }
});
