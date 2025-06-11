var ctx = document.getElementById('myPieChart').getContext('2d');

var myPieChart = new Chart(ctx, {
    type: 'pie', 
    data: {
        labels: ['Visual', 'Auditori', 'Kinestetik'], 
        datasets: [{
            label: 'Gaya Belajar',
            data: [45, 30, 25], 
            backgroundColor: ['#ff6b4a', '#ffb800', '#00b67a'], 
            borderColor: ['#ffffff', '#ffffff', '#ffffff'], 
            borderWidth: 2
        }]
    },
    options: {
        responsive: true, 
        plugins: {
            legend: {
                position: 'top', 
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + '%'; 
                    }
                }
            }
        }
    }
});
