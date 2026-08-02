document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('dashboardRevenueChart');
    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    var labels = JSON.parse(canvas.dataset.labels || '[]');
    var values = JSON.parse(canvas.dataset.values || '[]');

    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#5a5c69';

    new Chart(canvas.getContext('2d'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '未稅淨銷售額',
                data: values,
                lineTension: 0.25,
                backgroundColor: 'rgba(78, 115, 223, 0.10)',
                borderColor: '#4e73df',
                pointRadius: 3,
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#ffffff',
                pointHoverRadius: 5,
                pointHoverBackgroundColor: '#4e73df',
                pointBorderWidth: 2,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            tooltips: {
                callbacks: {
                    label: function (item) {
                        return '$' + Number(item.yLabel || 0).toLocaleString('zh-TW', { maximumFractionDigits: 2 });
                    }
                }
            },
            scales: {
                xAxes: [{ gridLines: { display: false }, ticks: { maxTicksLimit: 12 } }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function (value) { return '$' + Number(value).toLocaleString('zh-TW'); }
                    },
                    gridLines: { color: 'rgba(0, 0, 0, .06)' }
                }]
            }
        }
    });
});
