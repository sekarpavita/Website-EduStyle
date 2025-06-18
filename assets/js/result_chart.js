document.addEventListener('DOMContentLoaded', function() {
    if (window.learningStyleData) {
        const visualScore = window.learningStyleData.visual;
        const auditoriScore = window.learningStyleData.auditori;
        const kinestetikScore = window.learningStyleData.kinestetik;

        var ctx = document.getElementById('myPieChart').getContext('2d');

        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Visual', 'Auditori', 'Kinestetik'],
                datasets: [{
                    label: 'Gaya Belajar',
                    data: [visualScore, auditoriScore, kinestetikScore],
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
    } else {
        console.error("Error: learningStyleData not found. Chart cannot be rendered.");
        const chartContainer = document.querySelector('div[style*="width: 40%"]');
        if (chartContainer) {
            chartContainer.innerHTML = '<p style="text-align: center; color: red;">Gagal memuat grafik. Data tidak tersedia.</p>';
        }
    }
});