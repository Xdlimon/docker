<?php
$chartData = $data['chartData'];
$birthYearCounts = $chartData['birthYearCounts'];
$ageDistribution = $chartData['ageDistribution'];
$genderCounts = $chartData['genderCounts'];

// Конвертируем массивы в формат JSON для передачи в JavaScript
$years = json_encode(array_keys($birthYearCounts));
$counts = json_encode(array_values($birthYearCounts));
$ageLabels = json_encode(array_keys($ageDistribution));
$ageCounts = json_encode(array_values($ageDistribution));
$genderLabels = json_encode(array_keys($genderCounts));
$genderData = json_encode(array_values($genderCounts));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 80%; margin: auto;">
        <h2>Users per Birth Year</h2>
        <canvas id="birthYearChart"></canvas>
    </div>
    <div style="width: 80%; margin: auto;">
        <h2>Age Distribution</h2>
        <canvas id="ageDistributionChart"></canvas>
    </div>
    <div style="width: 80%; margin: auto;">
        <h2>Gender Composition</h2>
        <canvas id="genderChart"></canvas>
    </div>

    <script>
        const birthYearLabels = <?php echo $years; ?>;
        const birthYearData = <?php echo $counts; ?>;
        const ageLabels = <?php echo $ageLabels; ?>;
        const ageData = <?php echo $ageCounts; ?>;
        const genderLabels = <?php echo $genderLabels; ?>;
        const genderData = <?php echo $genderData; ?>;

        new Chart(document.getElementById('birthYearChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: birthYearLabels,
                datasets: [{
                    label: 'Users per Birth Year',
                    data: birthYearData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        new Chart(document.getElementById('ageDistributionChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ageLabels,
                datasets: [{
                    label: 'Age Distribution',
                    data: ageData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        new Chart(document.getElementById('genderChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Gender Composition',
                    data: genderData,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>
