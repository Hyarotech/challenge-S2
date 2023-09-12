<div>
    <div>
        <canvas  width="400" height="100" aria-label="Hello ARIA World" role="img" id="myChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');


    //cicle
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Users', 'Categories', 'Pages'],
            datasets: [{
                label: '# of y',
                data: [<?= $totalUsers ?>, <?= $totalCategories ?>, <?= $totalPages ?>],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


